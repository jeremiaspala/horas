<?php
require_once 'models/empresas.php';
require_once 'models/personas.php';
require_once 'models/empleados_empresas.php';

class EmpresasController{
    //Show All
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $e = new Empresas();
        $empresa = $e->getAllEmpresas();
        require_once 'views/empresas/index.php';
        require_once 'views/layout/footer.php';
    }
    
    //Nuevo form    
    public function nuevo() {
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/empresas/nuevo.php';
        require_once 'views/layout/footer.php';
    }
    
    //Guardar Form
    public function salvar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $direccion = filter_var($_REQUEST['direccion'], FILTER_SANITIZE_STRING);
        $cuit = filter_var($_REQUEST['cuit'], FILTER_SANITIZE_NUMBER_INT);
        $telefono = filter_var($_REQUEST['telefono'], FILTER_SANITIZE_STRING);
        $condicion = filter_var($_REQUEST['condicionfiscal'], FILTER_SANITIZE_STRING);
        if(!empty($nombre) && !empty($telefono) &&!empty($cuit)){
            $e = new Empresas();
            $e->nombre = $nombre;
            $e->direccion = $direccion;
            $e->cuit = $cuit;
            $e->telefono = $telefono;
            $e->condicionfiscal = $condicion;
            $ok = $e->setEmpresa($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."empresas/index");
    }
   //Actualizar
    public function actualizar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $direccion = filter_var($_REQUEST['direccion'], FILTER_SANITIZE_STRING);
        $cuit = filter_var($_REQUEST['cuit'], FILTER_SANITIZE_NUMBER_INT);
        $telefono = filter_var($_REQUEST['telefono'], FILTER_SANITIZE_STRING);
        $condicion = filter_var($_REQUEST['condicionfiscal'], FILTER_SANITIZE_STRING);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($nombre) && !empty($telefono) &&!empty($cuit)){
            $e = new Empresas();
            $e->nombre = $nombre;
            $e->direccion = $direccion;
            $e->cuit = $cuit;
            $e->telefono = $telefono;
            $e->condicionfiscal = $condicion;
            $e->id = $id;
            $ok = $e->udpateEmpresa($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location:".base_url."empresas/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Empresas();
            $res = $e->deleteEmpresa($id);
            if($res == true){
                $_SESSION['delete'] = "ok";
            }else{
                $_SESSION['delete'] = "no";
            }
            header("Location: ".base_url."empresas/index");
        }
    }
    //Actualizar
    public function editar(){
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        if(isset($_REQUEST['id'])){
            $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $em = new Empresas();
            $datos = $em->getEmpresa($id);
            foreach ($datos as $a):
                $nombre = $a['nombre'];
                $direccion = $a['direccion'];
                $cuit = $a['cuit'];
                $telefono = $a['telefono'];
                $condicionfiscal = $a['condicionfiscal'];
            endforeach;
            switch ($condicionfiscal){
                case "RI":
                    $ri = 'selected="true"';
                    break;
                case "RNI":
                    $rni = 'selected="true"';
                    break;
                case "E":
                    $e = 'selected="true"';
                    break;
                case "CF":
                    $cf = 'selected="true"';
                    break;
            }
            require_once 'views/empresas/editar.php';
            require_once 'views/layout/footer.php';
        }
    }
    
    //Funciones para empleados
    //Agrear equipos
    public function agregar() {
        Utils::isIdentity();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_STRING);
        require_once 'views/layout/header.php';
        $s = new Personas();
        $switch = $s->getAll();
        $m = new Empleados_empresas();
        $mi = $m->getAllbyGroup($id);
        require_once 'views/empresas/agregar.php';
        require_once 'views/layout/footer.php';
    }

    public function sumar() {
        $persona_id= filter_var($_REQUEST['persona_id'], FILTER_SANITIZE_NUMBER_INT);
        $empresa_id = filter_var($_REQUEST['empresa_id'], FILTER_SANITIZE_NUMBER_INT);
        if (!empty($persona_id) && !empty($empresa_id)) {
            $mh = new Empleados_empresas();
            $mh->persona_id = $persona_id;
            $mh->empresa_id = $empresa_id;
            $ok = $mh->set($mh);
            if ($ok == true) {
                echo "ok";
            } else {
                echo "no";
            }
        }
    }

    public function devolver() {
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $m = new Empleados_empresas();
        $mi = $m->getAllbyGroup($id);
        foreach ($mi as $r):
            ?>
            <tr id="cat<?=$r['id']?>">
                    <td><?=$r['nombre']." ".$r['apellidos']?></td>
                    <td><?=$r['email']?></td>
                    <td class="text-center"><a onclick="eliminar(<?=$r['id']?>);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                </tr>
        <?php
        endforeach;
    }
    public function restar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if (!empty($id)) {
            $e = new Empleados_empresas();
            $res = $e->delete($id);
            if ($res == true) {
                echo "ok";
            } else {
                return "no";
            }
        }
    }
}