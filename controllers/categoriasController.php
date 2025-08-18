<?php
    require_once 'models/categorias.php';

class categoriasController{
    
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $cat = new Categorias();
        $categoria = $cat->getAll();
        require_once 'views/categorias/index.php';
        require_once 'views/layout/footer.php';
    }
    
    public function nuevo(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/categorias/nuevo.php';
        require_once 'views/layout/footer.php';
    }
    
    public function salvar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        if(!empty($nombre)){
            $e = new Categorias();
            $e->nombre = $nombre;
            $ok = $e->setCategoria($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."categorias/index");
    }
    //Editar
    public function editar(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        if(isset($_REQUEST['id'])){
            $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $em = new Categorias();
            $datos = $em->getCategoria($id);
            foreach ($datos as $a):
                $nombre = $a['nombre'];
            endforeach;
            require_once 'views/categorias/editar.php';
            require_once 'views/layout/footer.php';
        }
    }
    //Actualizar
    public function actualizar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($nombre) && !empty($id)){
            $e = new Categorias();
            $e->nombre = $nombre;
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
        header("Location:".base_url."categorias/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Categorias();
            $res = $e->delete($id);
            if($res == true){
                echo "ok";
            }else{
                return "no";
            }
        }
    }
}
