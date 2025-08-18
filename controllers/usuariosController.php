<?php

    require_once 'models/usuarios.php';

class UsuariosController{
    
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $u = new Usuarios();
        $usuarios = $u->getAllUsuarios();
        require_once 'views/usuarios/index.php';
        require_once 'views/layout/footer.php';
    }
    public function actualizar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $apellidos = filter_var($_REQUEST['apellidos'], FILTER_SANITIZE_STRING);
        $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
        $password = md5(filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING));
        $rol = filter_var($_REQUEST['rol'], FILTER_SANITIZE_STRING);
        $celular = filter_var($_REQUEST['celular'], FILTER_SANITIZE_STRING);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($nombre) && !empty($email) && !empty($password) && !empty($rol) && !empty($id)){
            $u = new Usuarios();
            $u->id = $id;
            $u->nombre = $nombre;
            $u->apellidos = $apellidos;
            $u->email = $email;
            $u->password = $password;
            $u->rol = $rol;
            $u->celular = $celular;
            $ok = $u->update($u);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location:".base_url."usuarios/index");
    }
    public function password() {
        Utils::isIdentity();
        Utils::isAdmin();
        $pass1 = trim(filter_var($_REQUEST['pass1'], FILTER_SANITIZE_STRING));
        $pass2 = trim(filter_var($_REQUEST['pass2'], FILTER_SANITIZE_STRING));
        $id = trim(filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT));
        if(!empty($pass1) && !empty($pass2)){
         if (preg_match('`[a-z]`',$pass1)){
             if (preg_match('`[0-9]`',$pass1)){
                 if (preg_match('`[a-z]`',$pass2)){
                    if (preg_match('`[0-9]`',$pass2)){
                        //Si cumple las condiciones
                        $u = new Usuarios();
                        $u->id = $id;
                        $u->password = md5($pass1);
                        $ok = $u->setPassword($u);
                        if($ok == true){
                            $_SESSION['password'] = "ok";
                        }else{
                            $_SESSION['password']="no";
                        }
                    }else{
                        $_SESSION['password']="no";
                    }
                } else {
                $_SESSION['password']="no";    
                }
             }else{
                 $_SESSION['password']="no";
             }
         }else{
             $_SESSION['password']="no";
         }
        }else{
            $_SESSION['password']="no";
        }
        header("Location:".base_url."usuarios/index");
    }
    public function conversion() {
        Utils::isIdentity();
        Utils::isAdmin();
        $pass1 = trim(filter_var($_REQUEST['pass1'], FILTER_SANITIZE_STRING));
        $pass2 = trim(filter_var($_REQUEST['pass2'], FILTER_SANITIZE_STRING));
        $id = trim(filter_var($_SESSION['id_conversion'], FILTER_SANITIZE_NUMBER_INT));
        if(!empty($pass1) && !empty($pass2)){
         if (preg_match('`[a-z]`',$pass1)){
             if (preg_match('`[0-9]`',$pass1)){
                 if (preg_match('`[a-z]`',$pass2)){
                    if (preg_match('`[0-9]`',$pass2)){
                        //Si cumple las condiciones
                        if(isset($_SESSION['id_conversion'])&& isset($_SESSION['email_conversion'])){
                        $u = new Usuarios();
                        $u->persona_id = $_SESSION['id_conversion'];
                        $u->password = md5($pass1);
                        $u->email = $_SESSION['email_conversion'];
                        $ok = $u->setUsuario($u);
                        if($ok == true){
                            $_SESSION['conversion'] = "ok";
                        }else{
                            $_SESSION['conversion']="no";
                        }         
                        }

                    }else{
                        $_SESSION['conversion']="no";
                    }
                } else {
                $_SESSION['conversion']="no";    
                }
             }else{
                 $_SESSION['conversion']="no";
             }
         }else{
             $_SESSION['conversion']="no";
         }
        }else{
            $_SESSION['conversion']="no";
        }
        header("Location:".base_url."usuarios/index");
    }
    //función para habilitar o deshbilitar según estado
    public function habilita(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $u = new Usuarios();
            $resp = $u->setHabilitado($id);
            return $resp;
        }
    }

    //function Login
    public function login(){
        $usuario = trim(filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL));
        $password = trim(filter_var($_REQUEST['pass'], FILTER_SANITIZE_STRING));
        if(!empty($usuario) && !empty($password)){
            $u = new Usuarios();
            $u->email = $usuario;
            $u->password = md5($password);
            $datos = $u->getLogin($u);
            foreach ($datos as $d):
                $email = $d['email'];
                $pass = $d['password'];
            endforeach;
            if($email && $pass){
                $_SESSION['usuario'] =$d['email'];
                $_SESSION['password']=$d['password'];
                header("Location:".base_url."dashboard/index");
            }else{
                header("Location:".base_url."login/index");
            }
        }
    }
    //Editar Usuario
    public function editar(){
        Utils::isIdentity();
        Utils::isAdmin();
        if(!empty($_REQUEST['id'])){
            $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            require_once 'views/layout/header.php';
            $u = new Usuarios();
            $usuario = $u->getUsuario($id);
            foreach ($usuario as $us):
                $nombre = $us['nombre'];
                $apellidos = $us['apellidos'];
                $email = $us['email'];
                $password = $us['password'];
                $celular = $us['celular'];
                $imagen = $us['imagen'];
                $rol = $us['rol'];
            endforeach;
            require_once 'views/usuarios/editar.php';
            require_once 'views/layout/footer.php';
        }
    }
    //Nuevo
    public function nuevo(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/usuarios/nuevo.php';
        require_once 'views/layout/footer.php';
    }
    //Guardar
    public function guardar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $apellidos = filter_var($_REQUEST['apellidos'], FILTER_SANITIZE_STRING);
        $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
        $password = md5(filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING));
        $rol = filter_var($_REQUEST['rol'], FILTER_SANITIZE_STRING);
        $celular = filter_var($_REQUEST['celular'], FILTER_SANITIZE_STRING);
        if(!empty($nombre) && !empty($email) && !empty($password) && !empty($rol)){
            $u = new Usuarios();
            $u->nombre = $nombre;
            $u->apellidos = $apellidos;
            $u->email = $email;
            $u->password = $password;
            $u->rol = $rol;
            $u->celular = $celular;
            $ok = $u->setUsuario($u);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location:".base_url."usuarios/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Usuarios();
            $res = $e->delete($id);
            if($res == true){
                echo "ok";
            }else{
                echo "no";
            }
            //header("Location: ".base_url."usuarios/index");
        }
    }
    
}

