<?php
// api/index.php — Mikrotik VPN event sink (PPP on-up / on-down)
// Usa Database::StartUp() para $pdo (PDO).
// Acepta JSON POST o query/form. Auth por X-Auth-Token o ?token=....
// Escribe raw a vpn_events y mantiene estado en vpn_sessions.
// Logea todo en api/vpn_api.log.

declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

// ------------------ CONFIG ------------------
const LOG_FILE = __DIR__ . '/vpn_api.log';     // asegurar permisos (www-data/apache/nginx)
const EXPECTED_TOKEN = '';                     // opcional: poné tu token si querés validar exacto

// ------------------ Helpers ------------------
function log_line(string $msg, array $ctx = []): void {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $line = date('c') . ' [' . $ip . '] ' . $msg;
    if ($ctx) $line .= ' | ' . json_encode($ctx, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    $line .= PHP_EOL;
    @file_put_contents(LOG_FILE, $line, FILE_APPEND);
}
function out_json(int $code, array $payload): void {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    exit;
}
function uptime_to_seconds(?string $s): ?int {
    if ($s === null || $s === '') return null;
    $map = ['w'=>604800,'d'=>86400,'h'=>3600,'m'=>60,'s'=>1];
    $sec = 0;
    if (preg_match_all('/(\d+)([wdhms])/', $s, $m, PREG_SET_ORDER)) {
        foreach ($m as $p) $sec += (int)$p[1] * $map[$p[2]];
        return $sec;
    }
    if (ctype_digit($s)) return (int)$s;
    return null;
}

// ------------------ Auth ------------------
$headers = function_exists('getallheaders') ? getallheaders() : [];
$token = $headers['X-Auth-Token'] ?? ($_REQUEST['token'] ?? '');
if ($token === '') {
    log_line('401 missing token');
    out_json(401, ['ok'=>false,'error'=>'missing token']);
}
if (EXPECTED_TOKEN !== '' && $token !== EXPECTED_TOKEN) {
    log_line('401 unauthorized (bad token)');
    out_json(401, ['ok'=>false,'error'=>'unauthorized']);
}

// ------------------ Parse body ------------------
$raw = file_get_contents('php://input') ?: '';
$ctype = $_SERVER['CONTENT_TYPE'] ?? '';
$data = null;
if (stripos($ctype, 'application/json') !== false) {
    $data = json_decode($raw, true);
}
if (!is_array($data) || !$data) {
    // fallback a form/query
    $data = $_POST ?: $_GET;
}
if (isset($data['ping'])) {
    out_json(200, ['ok'=>true,'pong'=>1]);
}

// Normalizar campos esperados
$event_type = $data['event_type'] ?? null; // 'up'|'down'
$user       = $data['user']       ?? null;
$service    = $data['service']    ?? null;
$interface  = $data['interface']  ?? null; // ppp-in-X
$caller_id  = $data['caller_id']  ?? null;
$remote_addr= $data['remote_addr']?? null;
$local_addr = $data['local_addr'] ?? null;
$router_id  = $data['router_id']  ?? null;
$session_key= $data['session_key']?? $interface;
$uptime_sec = $data['uptime_sec'] ?? null;
$uptime_str = $data['uptime']     ?? null;

if ($uptime_sec === null && $uptime_str !== null) {
    $uptime_sec = uptime_to_seconds($uptime_str);
}

foreach (['event_type','user','service','interface','router_id'] as $k) {
    if (empty($$k)) {
        log_line('422 missing field', ['field'=>$k]);
        out_json(422, ['ok'=>false,'error'=>"missing field: $k"]);
    }
}

// connect_time: si no viene, lo derivamos
$connect_time = $data['connect_time'] ?? null;
if (!$connect_time) {
    if ($event_type === 'down' && $uptime_sec !== null) {
        $connect_time = date('Y-m-d H:i:s', time() - (int)$uptime_sec);
    } else {
        $connect_time = date('Y-m-d H:i:s');
    }
}

// ------------------ DB ------------------
try {
    $pdo = Database::StartUp();                // TU bootstrap, ya lo usabas
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Throwable $e) {
    log_line('500 db connect error', ['err'=>$e->getMessage()]);
    out_json(500, ['ok'=>false,'error'=>'db connect error']);
}

// ------------------ vpn_events (raw) ------------------
try {
    // Ajustá columnas si tu tabla difiere (vos ya estabas usando connect_time).
    $sql = "INSERT INTO vpn_events
        (connect_time, event_type, user, service, interface, caller_id, remote_addr, local_addr, uptime_sec, router_id, session_key)
        VALUES (:connect_time, :event_type, :user, :service, :interface, :caller_id, :remote_addr, :local_addr, :uptime_sec, :router_id, :session_key)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':connect_time' => $connect_time,
        ':event_type'   => $event_type,
        ':user'         => $user,
        ':service'      => $service,
        ':interface'    => $interface,
        ':caller_id'    => $caller_id,
        ':remote_addr'  => $remote_addr,
        ':local_addr'   => $local_addr,
        ':uptime_sec'   => $uptime_sec,
        ':router_id'    => $router_id,
        ':session_key'  => $session_key,
    ]);
} catch (Throwable $e) {
    log_line('500 insert vpn_events failed', ['err'=>$e->getMessage()]);
    out_json(500, ['ok'=>false,'error'=>'insert vpn_events failed']);
}

// ------------------ vpn_sessions (apertura/cierre) ------------------
try {
    if ($event_type === 'up') {
        // Abrimos sesión "open"
        $sql = "INSERT INTO vpn_sessions
            (router_id,user,service,interface,caller_id,remote_addr,local_addr,started_at,status)
            VALUES (:router_id,:user,:service,:interface,:caller_id,:remote_addr,:local_addr,:started_at,'open')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':router_id'   => $router_id,
            ':user'        => $user,
            ':service'     => $service,
            ':interface'   => $interface,
            ':caller_id'   => $caller_id,
            ':remote_addr' => $remote_addr,
            ':local_addr'  => $local_addr,
            ':started_at'  => $connect_time,
        ]);
    } else { // down
        $pdo->beginTransaction();

        $sel = $pdo->prepare("SELECT id, started_at
                              FROM vpn_sessions
                              WHERE router_id=:router_id AND user=:user AND interface=:interface AND status='open'
                              ORDER BY started_at DESC LIMIT 1");
        $sel->execute([':router_id'=>$router_id, ':user'=>$user, ':interface'=>$interface]);
        $row = $sel->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $sid = (int)$row['id'];
            $calc_uptime = $uptime_sec ?? max(0, time() - strtotime($row['started_at']));
            $upd = $pdo->prepare("UPDATE vpn_sessions
                                  SET ended_at=NOW(), uptime_sec=:uptime_sec, status='closed',
                                      caller_id=:caller_id, remote_addr=:remote_addr, local_addr=:local_addr
                                  WHERE id=:id");
            $upd->execute([
                ':uptime_sec' => $calc_uptime,
                ':caller_id'  => $caller_id,
                ':remote_addr'=> $remote_addr,
                ':local_addr' => $local_addr,
                ':id'         => $sid,
            ]);
        } else {
            // No hay "open" (se perdió el 'up'): creamos y cerramos usando la estimación
            $est_start = ($uptime_sec !== null)
                ? date('Y-m-d H:i:s', time() - (int)$uptime_sec)
                : date('Y-m-d H:i:s');
            $ins = $pdo->prepare("INSERT INTO vpn_sessions
                                  (router_id,user,service,interface,caller_id,remote_addr,local_addr,started_at,ended_at,uptime_sec,status)
                                  VALUES (:router_id,:user,:service,:interface,:caller_id,:remote_addr,:local_addr,:started_at,NOW(),:uptime_sec,'closed')");
            $ins->execute([
                ':router_id'  => $router_id,
                ':user'       => $user,
                ':service'    => $service,
                ':interface'  => $interface,
                ':caller_id'  => $caller_id,
                ':remote_addr'=> $remote_addr,
                ':local_addr' => $local_addr,
                ':started_at' => $est_start,
                ':uptime_sec' => $uptime_sec,
            ]);
        }

        $pdo->commit();
    }
} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    log_line('500 sessions upsert failed', ['err'=>$e->getMessage()]);
    out_json(500, ['ok'=>false,'error'=>'sessions upsert failed']);
}

// ------------------ OK ------------------
log_line('200 OK', ['event'=>$event_type,'user'=>$user,'iface'=>$interface,'router'=>$router_id]);
out_json(200, ['ok'=>true]);
