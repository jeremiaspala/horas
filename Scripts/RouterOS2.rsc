# Config
:local URL "http://192.168.122.1/horas/api/";
:local TOKEN "5b59457277535624eb3fef15b4ab9e717e61bc6649cc0cda30eecf9335c8b66c";

# -------- on-up ----------
:local ev "up";
:local rname [/system identity get name];
:local ct ("$[/system clock get date] $[/system clock get time]");   # opcional
/tool fetch url=$URL http-method=post keep-result=no http-header-field="Content-Type: application/x-www-form-urlencoded" \
    http-data=("token=$TOKEN&event_type=" . $ev . "&user=$user&service=$service&interface=$interface" \
             . "&caller_id=$caller-id&remote_addr=$remote-address&local_addr=$local-address" \
             . "&ROUTERID=$rname&connect_time=" . [:pick $ct 0 [:len $ct]]);

# -------- on-down ----------
:local evd "down";
:local rname [/system identity get name];
/tool fetch url=$URL http-method=post keep-result=no http-header-field="Content-Type: application/x-www-form-urlencoded" \
    http-data=("token=$TOKEN&event_type=" . $evd . "&user=$user&service=$service&interface=$interface" \
             . "&caller_id=$caller-id&remote_addr=$remote-address&local_addr=$local-address" \
             . "&ROUTERID=$rname&uptime_sec=$uptime");
