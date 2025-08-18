<?php
    require_once 'models/horas.php';
    require_once 'models/personas.php';

class horasController{
    
    public function mis(){
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        $p = new Personas();
        $per = $p->getEmail($identity['email']);
        foreach ($per as $pe):
            $persona_id = $pe['id'];
        endforeach;
        $cat = new Horas();
        $categoria = $cat->getAll($persona_id);
        $sumar = $cat->getSumaNoLiqll($persona_id);
        require_once 'views/horas/mis.php';
        require_once 'views/layout/footer.php';
    }

    public function salvar(){
        Utils::isIdentity();
        $identity= Utils::getIdentity();
        $p = new Personas();
        $per = $p->getEmail($identity['email']);
        foreach ($per as $pe):
            $persona_id = $pe['id'];
        endforeach;
        
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        $hora = filter_var($_REQUEST['hora'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
        if(!empty($hora) && !empty($descripcion)){
            $e = new Horas();
            $e->horas = $hora;
            $e->descripcion = $descripcion;
            $e->persona_id = $persona_id;
            $ok = $e->set($e);      
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."horas/mis");
    }
    public function eliminar(){
        Utils::isIdentity();
        $identity= Utils::getIdentity();
        $p = new Personas();
        $per = $p->getEmail($identity['email']);
        foreach ($per as $pe):
            $persona_id = $pe['id'];
        endforeach;
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id) && !empty($persona_id)){
            $e = new Horas();
            $res = $e->delete($id, $persona_id);
            if($res == true){
                echo "ok";
            }else{
                echo "no";
            }
            //header("Location: ".base_url."usuarios/index");
        }
    }
}