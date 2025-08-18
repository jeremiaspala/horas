<?php
    require_once 'models/equipos_historia.php';

class historiaController{
    
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $cat = new historia();
        $categoria = $cat->getAll();
        require_once 'views/equipos_historia/index.php';
        require_once 'views/layout/footer.php';
    }
    
    public function nuevo(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/equipos_historia/nuevo.php';
        require_once 'views/layout/footer.php';
    }
    
    public function salvar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $tipo = filter_var($_REQUEST['tipo'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        
        if(!empty($tipo) && !empty($descripcion)){
            $e = new Tipos_Equipos();
            $e->tipo = $tipo;
            $e->descripcion = $descripcion;
            $ok = $e->setTipo($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."equipos_historia/index");
    }
    //Editar
    public function editar(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        if(isset($_REQUEST['id'])){
            $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $em = new Tipos_Equipos();
            $datos = $em->getTipo($id);
            foreach ($datos as $a):
                $tipo = $a['tipo'];
                $descripcion = $a['descripcion'];
            endforeach;
            require_once 'views/equipos_historia/editar.php';
            require_once 'views/layout/footer.php';
        }
    }
    //Actualizar
    public function actualizar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $tipo = filter_var($_REQUEST['tipo'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($tipo) && !empty($id)){
            $e = new Tipos_Equipos();
            $e->tipo = $tipo;
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
        header("Location:".base_url."equipos_historia/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Tipos_Equipos();
            $res = $e->delete($id);
            if($res == true){
                echo "ok";
            }else{
                return "no";
            }
        }
    }
}
