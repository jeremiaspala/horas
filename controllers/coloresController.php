<?php
    require_once 'models/colores.php';

class coloresController{
    
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $cat = new Colores();
        $categoria = $cat->getAll();
        require_once 'views/colores/index.php';
        require_once 'views/layout/footer.php';
    }
    
    public function nuevo(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/colores/nuevo.php';
        require_once 'views/layout/footer.php';
    }
    
    public function salvar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $color = filter_var($_REQUEST['color'], FILTER_SANITIZE_STRING);
        $precio = filter_var($_REQUEST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
        if(!empty($color) && !empty($precio)){
            $e = new Colores();
            $e->color = $color;
            $e->precio = $precio;
            $ok = $e->setColor($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."colores/index");
    }
    //Editar
    public function editar(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        if(isset($_REQUEST['id'])){
            $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $em = new Colores();
            $datos = $em->getColor($id);
            foreach ($datos as $a):
                $color = $a['color'];
                $precio = $a['precio'];
            endforeach;
            require_once 'views/colores/editar.php';
            require_once 'views/layout/footer.php';
        }
    }
    //Actualizar
    public function actualizar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $color = filter_var($_REQUEST['color'], FILTER_SANITIZE_STRING);
        $precio = filter_var($_REQUEST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($color) && !empty($id)){
            $e = new Colores();
            $e->color = $color;
            $e->precio = $precio;
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
        header("Location:".base_url."colores/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Colores();
            $res = $e->delete($id);
            if($res == true){
                echo "ok";
            }else{
                return "no";
            }
        }
    }
}
