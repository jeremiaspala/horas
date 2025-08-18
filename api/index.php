<?php
// config
$DB_HOST="localhost"; $DB_NAME="nerdadas_horas"; $DB_USER="appcomp"; $DB_PASS="appcomp";
$TOKEN = "TOKEN_SECRETO_LARGO";

// auth
$hdrs = getallheaders();
$provided = $hdrs["X-Auth-Token"] ?? ($_GET["token"] ?? "");
if ($provided !== $TOKEN) { http_response_code(401); echo "Unauthorized"; exit; }

// body
$body = file_get_contents("php://input");
$data = json_decode($body, true);
if (!$data) { http_response_code(400); echo "Bad JSON"; exit; }

$required = ["event_type","user","service","interface","router_id"];
foreach ($required as $k) if (!isset($data[$k])) { http_response_code(422); echo "Missing $k"; exit; }

// db
$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";
$pdo = new PDO($dsn, $DB_USER, $DB_PASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

$sql = "INSERT INTO vpn_events (event_type,user,service,interface,caller_id,remote_addr,local_addr,uptime_sec,router_id,session_key)
        VALUES (:event_type,:user,:service,:interface,:caller_id,:remote_addr,:local_addr,:uptime_sec,:router_id,:session_key)";
$stm = $pdo->prepare($sql);
$stm->execute([
  ":event_type"  => $data["event_type"],
  ":user"        => $data["user"],
  ":service"     => $data["service"],
  ":interface"   => $data["interface"],
  ":caller_id"   => $data["caller_id"] ?? null,
  ":remote_addr" => $data["remote_addr"] ?? null,
  ":local_addr"  => $data["local_addr"] ?? null,
  ":uptime_sec"  => $data["uptime_sec"] ?? null,
  ":router_id"   => $data["router_id"],
  ":session_key" => $data["session_key"] ?? null
]);

header("Content-Type: application/json");
echo json_encode(["ok"=>true]);
