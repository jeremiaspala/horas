<?php
// api/vpn_event.php
include_once '../config/db.php';
        try{
            $pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

function out($code, $msg){ http_response_code($code); echo json_encode(['ok'=>$code<400,'msg'=>$msg]); exit; }

header('Content-Type: application/json');

$token = $_REQUEST['token'] ?? '';
if(!$token) out(401,'missing token');
try{
$stmt = $pdo->prepare("SELECT id FROM api_tokens WHERE token=? AND enabled=1");
$stmt->execute([$token]);
} catch (Exception $ex){
    return $ex->getMessage();
}
if(!$stmt->fetch()) out(403,'invalid token');

$fields = [
  'event_type','user','service','interface','router_id',
  'caller_id','remote_addr','local_addr','uptime_sec','session_key','connect_time'
];

$data = [];
foreach($fields as $f){ $data[$f] = $_REQUEST[$f] ?? null; }

if(!in_array($data['event_type'], ['up','down'], true)) out(422,'bad event_type');

# Si viene connect_time del router lo usamos, sino lo derivamos (down = now - uptime)
if(!$data['connect_time']){
  if($data['event_type']==='down' && ctype_digit((string)$data['uptime_sec'])){
    $stmt = $pdo->query("SELECT NOW() AS now_ts"); $now = $stmt->fetchColumn();
    $data['connect_time'] = date('Y-m-d H:i:s', strtotime($now) - (int)$data['uptime_sec']);
  } else {
    $stmt = $pdo->query("SELECT NOW() AS now_ts"); $data['connect_time'] = $stmt->fetchColumn();
  }
}

$sql = "INSERT INTO vpn_events
(event_time, connect_time, event_type, `user`, `service`, `interface`,
 caller_id, remote_addr, local_addr, uptime_sec, router_id, session_key)
VALUES (NOW(), :connect_time, :event_type, :user, :service, :interface,
        :caller_id, :remote_addr, :local_addr, :uptime_sec, :router_id, :session_key)
ON DUPLICATE KEY UPDATE 
  event_time = VALUES(event_time),
  caller_id  = VALUES(caller_id),
  remote_addr= VALUES(remote_addr),
  local_addr = VALUES(local_addr),
  uptime_sec = VALUES(uptime_sec)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
  ':connect_time'=>$data['connect_time'],
  ':event_type'=>$data['event_type'],
  ':user'=>$data['user'],
  ':service'=>$data['service'],
  ':interface'=>$data['interface'],
  ':caller_id'=>$data['caller_id'],
  ':remote_addr'=>$data['remote_addr'],
  ':local_addr'=>$data['local_addr'],
  ':uptime_sec'=>$data['uptime_sec'],
  ':router_id'=>$data['router_id'],
  ':session_key'=>$data['session_key']
]);

echo json_encode(['ok'=>true]);
