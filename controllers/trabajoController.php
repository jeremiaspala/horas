<?php
    require_once 'models/trabajo.php';
    require_once 'models/empleados_trabajo.php';
    require_once 'models/personas.php';

class trabajoController{
    
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $cat = new Trabajo();
        $categoria = $cat->getAll();
        require_once 'views/trabajo/index.php';
        require_once 'views/layout/footer.php';
    }
    
    public function nuevo(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/trabajo/nuevo.php';
        require_once 'views/layout/footer.php';
    }
    
    public function salvar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $trabajo = filter_var($_REQUEST['trabajo'], FILTER_SANITIZE_STRING);
        $valor = filter_var($_REQUEST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
        if(!empty($trabajo) && !empty($valor)){
            $e = new Trabajo();
            $e->trabajo = $trabajo;
            $e->valor = $valor;
            $ok = $e->set($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."trabajo/index");
    }
    //Editar
    public function editar(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        if(isset($_REQUEST['id'])){
            $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $em = new Trabajo();
            $datos = $em->get($id);
            foreach ($datos as $a):
                $trabajo = $a['trabajo'];
                $valor = $a['valor'];
            endforeach;
            require_once 'views/trabajo/editar.php';
            require_once 'views/layout/footer.php';
        }
    }
    //Actualizar
    public function actualizar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $trabajo = filter_var($_REQUEST['trabajo'], FILTER_SANITIZE_STRING);
        $valor = filter_var($_REQUEST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($trabajo) && !empty($id) && !empty($valor)){
            $e = new Trabajo();
            $e->trabajo = $trabajo;
            $e->valor = $valor;
            $e->id = $id;
            $ok = $e->update($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location:".base_url."trabajo/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Trabajo();
            $res = $e->delete($id);
            if($res == true){
                echo "ok";
            }else{
                return "no";
            }
        }
    }
        public function agregar() {
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_STRING);
        require_once 'views/layout/header.php';
        $s = new Personas();
        $switch = $s->getAll();
        $m = new Empleados_trabajo();
        $mi = $m->getAllbyGroup($id);
        require_once 'views/trabajo/agregar.php';
        require_once 'views/layout/footer.php';
    }
    public function sumar() {
        Utils::isIdentity();
        Utils::isAdmin();
        $persona_id= filter_var($_REQUEST['persona_id'], FILTER_SANITIZE_NUMBER_INT);
        $trabajo_id = filter_var($_REQUEST['trabajo_id'], FILTER_SANITIZE_NUMBER_INT);
        if (!empty($persona_id) && !empty($trabajo_id)) {
            $mh = new Empleados_trabajo();
            $mh->persona_id = $persona_id;
            $mh->trabajo_id = $trabajo_id;
            $ok = $mh->set($mh);
            if ($ok == true) {
                echo "ok";
            } else {
                echo "no";
            }
        }
    }

    public function devolver() {
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $m = new Empleados_trabajo();
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
            $e = new Empleados_trabajo();
            $res = $e->delete($id);
            if ($res == true) {
                echo "ok";
            } else {
                return "no";
            }
        }
    }
}
