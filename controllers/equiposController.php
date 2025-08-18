<?php

require_once 'models/equipos.php';
require_once 'models/tipos_equipos.php';
require_once 'models/sectores.php';

class EquiposController{

    public function index(){
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        $e = new Equipos();
        $equipo = $e->getAll();
        require_once 'views/equipos/index.php';
        require_once 'views/layout/footer.php';
        
    }
    public function nuevo(){
        Utils::isIdentity();
        $t = new Tipos_Equipos();
        $tipos = $t->getAll();
        $s = new Sectores();
        $sectores = $s->getAll();
        require_once 'views/layout/header.php';
        require_once 'views/equipos/nuevo.php';
        require_once 'views/layout/footer.php';
        
    }
    public function editar(){
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        $combose = "";
        $combote = "";
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $e = new Equipos();
        $equipo = $e->getOne($id);
        function devuelveCheck($var){
            if($var==1){
                return ' checked="true"';
            }
        }
        foreach ($equipo as $r):
            $id = $r['id'];
            $nombre = $r['nombre'];
            $tipo_id  = $r['tipo_id'];
            $usuarios = $r['usuarios'];
            $ip = $r['ip'];
            $mac = $r['mac'];
            $sector_id = $r['sector_id'];
            $coordenadas = $r['coordenadas'];
            $descripcion = $r['descripcion'];
            $reparacion = devuelveCheck($r['reparacion']);
            $ssh = devuelveCheck($r['ssh']);
            $vnc = devuelveCheck($r['vnc']);
            $rdp = devuelveCheck($r['rdp']);
            $http = devuelveCheck($r['http']);
            $https = devuelveCheck($r['https']);
            $telnet = devuelveCheck($r['telnet']);
            $winbox = devuelveCheck($r['winbox']);
        endforeach;
        //traigo el combo de Tipos de equipos
        $te = new Tipos_Equipos();
        $tieq = $te->getAll();
        foreach ($tieq as $s):
            if($s['id']==$tipo_id){ $selecte = 'selected="true"';}else{$selecte = '';}
            $combote .= '<option value="'.$s['id'].'" '.$selecte.'>'.$s['tipo'].'</option>';
        endforeach;
        //traigo el combo de sectores
        $se = new Sectores();
        $sect = $se->getAll();
        foreach ($sect as $t):
            if($t['id']==$sector_id){ $selecse = 'selected="true"';}else{$selecse = '';}
            $combose .= '<option value="'.$t['id'].'" '.$selecse.'>'.$t['sector'].'</option>';
        endforeach;
        require_once 'views/equipos/editar.php';
        require_once 'views/layout/footer.php';
        
    }
    public function salvar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $tipo_id = filter_var($_REQUEST['tipo'], FILTER_SANITIZE_NUMBER_INT);
        $usuarios = filter_var($_REQUEST['usuarios'], FILTER_SANITIZE_STRING);
        $ip = filter_var($_REQUEST['ip'], FILTER_SANITIZE_STRING);
        $mac = filter_var($_REQUEST['mac'], FILTER_SANITIZE_STRING);
        $sector_id = filter_var($_REQUEST['sector'], FILTER_SANITIZE_NUMBER_INT);
        $coordenadas = filter_var($_REQUEST['end'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        if(isset($_REQUEST['reparacion'])){ $reparacion = 1;}else{$reparacion = 0;}
        if(isset($_REQUEST['ssh'])){ $ssh = 1;}else{$ssh = 0;}
        if(isset($_REQUEST['vnc'])){ $vnc = 1;}else{$vnc = 0;}
        if(isset($_REQUEST['rdp'])){ $rdp = 1;}else{$rdp = 0;}
        if(isset($_REQUEST['http'])){ $http = 1;}else{$http = 0;}
        if(isset($_REQUEST['https'])){ $https = 1;}else{$https = 0;}
        if(isset($_REQUEST['telnet'])){ $telnet = 1;}else{$telnet = 0;}
        if(isset($_REQUEST['winbox'])){ $winbox = 1;}else{$winbox = 0;}
        if(!empty($nombre) && !empty($tipo_id) &&!empty($sector_id)){
            $e = new Equipos();
            $e->nombre = $nombre;
            $e->tipo_id = $tipo_id;
            $e->usuarios = $usuarios;
            $e->ip = $ip;
            $e->mac = $mac;
            $e->sector_id = $sector_id;
            $e->coordenadas = $coordenadas;
            $e->descripcion = $descripcion;
            $e->reparacion = $reparacion;
            $e->ssh = $ssh;
            $e->vnc = $vnc;
            $e->rdp = $rdp;
            $e->http = $http;
            $e->https = $https;
            $e->telnet = $telnet;
            $e->winbox = $winbox;
            $ok = $e->setEquipo($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."equipos/index");
    }
    public function actualizar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $tipo_id = filter_var($_REQUEST['tipo'], FILTER_SANITIZE_NUMBER_INT);
        $usuarios = filter_var($_REQUEST['usuarios'], FILTER_SANITIZE_STRING);
        $ip = filter_var($_REQUEST['ip'], FILTER_SANITIZE_STRING);
        $mac = filter_var($_REQUEST['mac'], FILTER_SANITIZE_STRING);
        $sector_id = filter_var($_REQUEST['sector'], FILTER_SANITIZE_NUMBER_INT);
        $coordenadas = filter_var($_REQUEST['end'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(isset($_REQUEST['reparacion'])){ $reparacion = 1;}else{$reparacion = 0;}
        if(isset($_REQUEST['ssh'])){ $ssh = 1;}else{$ssh = 0;}
        if(isset($_REQUEST['vnc'])){ $vnc = 1;}else{$vnc = 0;}
        if(isset($_REQUEST['rdp'])){ $rdp = 1;}else{$rdp = 0;}
        if(isset($_REQUEST['http'])){ $http = 1;}else{$http = 0;}
        if(isset($_REQUEST['https'])){ $https = 1;}else{$https = 0;}
        if(isset($_REQUEST['telnet'])){ $telnet = 1;}else{$telnet = 0;}
        if(isset($_REQUEST['winbox'])){ $winbox = 1;}else{$winbox = 0;}
        if(!empty($nombre) && !empty($tipo_id) &&!empty($sector_id)){
            $e = new Equipos();
            $e->nombre = $nombre;
            $e->tipo_id = $tipo_id;
            $e->usuarios = $usuarios;
            $e->ip = $ip;
            $e->mac = $mac;
            $e->sector_id = $sector_id;
            $e->coordenadas = $coordenadas;
            $e->descripcion = $descripcion;
            $e->reparacion = $reparacion;
            $e->ssh = $ssh;
            $e->vnc = $vnc;
            $e->rdp = $rdp;
            $e->http = $http;
            $e->https = $https;
            $e->telnet = $telnet;
            $e->winbox = $winbox;
            $e->id = $id;
            $ok = $e->updateEquipo($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."equipos/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Equipos();
            $res = $e->delete($id);
            if($res == true){
                echo "ok";
            }else{
                echo "no";
            }
            //header("Location: ".base_url."usuarios/index");
        }
    }
    public function completarIP(){
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        $t = new Equipos();
        $temp = $t->getAllTemp();
        foreach ($temp as $r):
            echo $r['nombre']." ".$r['ip']." ".$r['mac']."<br/>";
            #variable update = 0
            $u = 0;
            #bucle tabla equipos actual
            $e = new Equipos();
            $eq = $e->getAll();
            foreach($eq as $s):
            if($r['ip']==$s['ip'] and $r['mac']){
                    echo "<p>IP DHCP ".$r['ip']." IP guardada: ".$s['ip']."</p>";
                    $t->nombre = $s['nombre'];
                    $t->ip = $s['ip'];
                    $t->mac = $r['mac'];
                    $ok = $t->updateTemp($t);
                    echo "<B>UPDATE: </B>".$ok." ";
                    $u=1;
                }
            #fin bucle equipos
            #    
            endforeach;
            /*#if variable update = 0{
            if($u == 0){
                $t->nombre = $r['nombre'];
                $t->ip = $r['ip'];
                $t->mac = $r['mac'];
                $ok = $t->setTemp($t);
                echo "<B>INSERT: </B>".$ok." ";
                echo "Equipo Guardado! ".$r['ip']." ".$r['mac'];
            }
            #}*/
        endforeach;
        require_once 'views/layout/footer.php';
    }
}