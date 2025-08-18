# =========================
# L2TP/IPsec Road Warriors
# =========================

# Pool de direcciones para clientes VPN
/ip/pool/add name=l2tp_pool ranges=10.10.10.10-10.10.10.250

# Profile para clientes (sin script, vos ya lo manejás aparte)
/ppp/profile/add name=vpnpanel-l2tp-profile \
    local-address=10.10.10.1 \
    remote-address=l2tp_pool \
    dns-server=8.8.8.8,1.1.1.1 \
    only-one=yes change-tcp-mss=yes use-compression=yes

# Activar servidor L2TP con IPsec obligatorio
/interface/l2tp-server/server/set enabled=yes use-ipsec=required \
    ipsec-secret="milanesa" \
    default-profile=vpnpanel-l2tp-profile \
    authentication=mschap1,mschap2 \
    keepalive-timeout=30 max-mru=1450 max-mtu=1450

# Crear usuarios L2TP (ejemplo)
/ppp/secret/add name=jere service=l2tp password="1234" profile=vpnpanel-l2tp-profile
# /ppp/secret/add name=otro service=l2tp password="clave" profile=vpnpanel-l2tp-profile

# Firewall: habilitar puertos necesarios desde WAN
/ip/firewall/filter/add chain=input action=accept protocol=udp dst-port=500,4500,1701 out-interface=ether1 comment="L2TP/IPsec"
/ip/firewall/filter/add chain=input action=accept protocol=ipsec-esp out-interface=ether1 comment="IPsec ESP"
/ip/firewall/filter/add chain=input action=accept protocol=ipsec-ah out-interface=ether1 comment="IPsec AH (opcional)"

# NAT: evitar NAT para tráfico IPsec y hacer masquerade hacia internet
/ip/firewall/nat/add chain=srcnat action=accept ipsec-policy=in,ipsec comment="No NAT para tráfico IPsec"
/ip/firewall/nat/add chain=srcnat action=masquerade out-interface=ether1 comment="NAT a Internet"
