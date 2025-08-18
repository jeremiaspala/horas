<?php
    require_once 'models/sectores.php';

class sectoresController{
    
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $cat = new Sectores();
        $categoria = $cat->getAll();
        require_once 'views/sectores/index.php';
        require_once 'views/layout/footer.php';
    }
    
    public function nuevo(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/sectores/nuevo.php';
        require_once 'views/layout/footer.php';
    }
    
    public function salvar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $sector = filter_var($_REQUEST['sector'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        
        if(!empty($sector) && !empty($descripcion)){
            $e = new Sectores();
            $e->sector = $sector;
            $e->descripcion = $descripcion;
            $ok = $e->setColor($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."sectores/index");
    }
    //Editar
    public function editar(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        if(isset($_REQUEST['id'])){
            $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $em = new Sectores();
            $datos = $em->getColor($id);
            foreach ($datos as $a):
                $sector = $a['sector'];
                $descripcion = $a['descripcion'];
            endforeach;
            require_once 'views/sectores/editar.php';
            require_once 'views/layout/footer.php';
        }
    }
    //Actualizar
    public function actualizar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $sector = filter_var($_REQUEST['sector'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($sector) && !empty($id)){
            $e = new Sectores();
            $e->sector = $sector;
            $e->descripcion = $descripcion;
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
        header("Location:".base_url."sectores/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Sectores();
            $res = $e->delete($id);
            if($res == true){
                echo "ok";
            }else{
                return "no";
            }
        }
    }
}
