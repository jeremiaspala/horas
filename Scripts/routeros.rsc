# Ajustes
:local URL "http://192.168.122.1/horas/api.php";
:local TOKEN "TOKEN_SECRETO_LARGO";
:local ROUTER_ID [/system identity get name];

# Función para POST JSON (evita guardar archivo)
:global postJSON do={
    :local url ($URL);
    :local json ($1);
    /tool fetch url=$url http-method=post keep-result=no http-header-field="Content-Type: application/json" http-header-field="X-Auth-Token: $TOKEN" http-data=$json;
};

# ---- PERFIL PPP ----
/ppp profile
add name=logdb only-one=yes use-compression=yes use-encryption=required \
    on-up={
        :local ifname $"interface";
        :local uname  $"user";
        :local svc    $"service";

        :local rem   [/ppp active get [/ppp active find where interface=$ifname] address];
        :local call  [/ppp active get [/ppp active find where interface=$ifname] caller-id];
        :local laddr [/ppp active get [/ppp active find where interface=$ifname] local-address];

        :local payload ("{\"event_type\":\"up\",\"user\":\"$uname\",\"service\":\"$svc\",\"interface\":\"$ifname\",\"caller_id\":\"$call\",\"remote_addr\":\"$rem\",\"local_addr\":\"$laddr\",\"router_id\":\"$ROUTER_ID\",\"session_key\":\"$ifname\"}");
        $postJSON $payload;
    } \
    on-down={
        :local ifname $"interface";
        :local uname  $"user";
        :local svc    $"service";
        :local upstr  $"uptime";

        :local rem   [/ppp active get [/ppp active find where interface=$ifname] address];
        :local call  [/ppp active get [/ppp active find where interface=$ifname] caller-id];
        :local laddr [/ppp active get [/ppp active find where interface=$ifname] local-address];

        # Pasar uptime a segundos (formato 1w2d3h4m5s etc.)
        :local secs 0;
        :local u $upstr;
        :do { :set secs ($secs + [:tonum [:pick $u 0 [:find $u "w"]]] * 604800); :set u [:pick $u ([:find $u "w"]+1) [:len $u]]; } on-error={}
        :do { :set secs ($secs + [:tonum [:pick $u 0 [:find $u "d"]]] * 86400);  :set u [:pick $u ([:find $u "d"]+1) [:len $u]]; } on-error={}
        :do { :set secs ($secs + [:tonum [:pick $u 0 [:find $u "h"]]] * 3600);  :set u [:pick $u ([:find $u "h"]+1) [:len $u]]; } on-error={}
        :do { :set secs ($secs + [:tonum [:pick $u 0 [:find $u "m"]]] * 60);    :set u [:pick $u ([:find $u "m"]+1) [:len $u]]; } on-error={}
        :do { :set secs ($secs + [:tonum [:pick $u 0 [:find $u "s"]]]); } on-error={}

        :local payload ("{\"event_type\":\"down\",\"user\":\"$uname\",\"service\":\"$svc\",\"interface\":\"$ifname\",\"caller_id\":\"$call\",\"remote_addr\":\"$rem\",\"local_addr\":\"$laddr\",\"uptime_sec\":$secs,\"router_id\":\"$ROUTER_ID\",\"session_key\":\"$ifname\"}");
        $postJSON $payload;
    }

# Asigná el perfil al servidor L2TP/PPTP/SSTP o a los usuarios
# Ejemplos:
#/interface l2tp-server server set enabled=yes default-profile=logdb use-ipsec=yes
#/ppp secret set [find] profile=logdb
