<?php
require_once 'models/usuarios.php';
require_once 'models/historia.php';

class LoginController {

    public function index() {
        require_once 'views/login/index.php';
    }

    //Recupera password
    public function recupera() {
        require_once 'views/login/recupera.php';
    }

    //Cerrar sesión
    public function salir() {
        $identity = Utils::getIdentity();

        if (isset($_SESSION['identity'])) {
            $h = new Historia();
            $h->usuario_id = $identity['id'];
            $h->accion = "logout";
            $h->extra = "";
            $h->ip = $_SERVER['REMOTE_ADDR'];
            $h->setHistoria($h);
            unset($_SESSION['identity']);
            session_regenerate_id();
            header("Location:" . base_url);
        } else {
            header("Location:" . base_url);
        }
    }

    //Valida el ingreso
    public function login() {
        $email = filter_var($_REQUEST['usuario'], FILTER_SANITIZE_STRING);
        $password = filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING);
        if (!empty($email) && !empty($password)) {
            $u = new Usuarios();
            $u->email = $email;
            $u->password = md5($password);
            $res = $u->getLogin($u);
            foreach ($res as $r):
                $email1 = $r['email'];
                $idhis = $r['id'];
                $password1 = $r['password'];
                $nombre = $r['nombre'];
                $apellido = $r['apellidos'];
                $rol = $r['rol'];
            endforeach;
            if ($res == null) {
                $h = new Historia();
                $h->usuario_id = "0";
                $h->accion = "fail";
                $h->extra = "Email: " . $email . " Password: " . $password . " \n";
                $h->ip = $_SERVER['REMOTE_ADDR'];
                $h->setHistoria($h);
                header("Location:" . base_url . "login/index");
            } else {
                $_SESSION['identity'] = $res;
                $h = new Historia();
                $h->usuario_id = $idhis;
                $h->accion = "login";
                $h->extra = "Email: " . $email;
                $h->ip = $_SERVER['REMOTE_ADDR'];
                $h->setHistoria($h);
                header("Location:" . base_url . "dashboard/index");
            }
        }
    }

    public function cambiar() {
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        require_once 'views/login/cambiar.php';
        require_once 'views/layout/footer.php';
    }

    public function password() {
        Utils::isIdentity();
        $identity = Utils::getIdentity();
        $id = $identity['id'];
        $pass1 = trim(filter_var($_REQUEST['pass1'], FILTER_SANITIZE_STRING));
        $pass2 = trim(filter_var($_REQUEST['pass2'], FILTER_SANITIZE_STRING));
        if (!empty($pass1) && !empty($pass2)) {
            if (preg_match('`[a-z]`', $pass1)) {
                if (preg_match('`[0-9]`', $pass1)) {
                    if (preg_match('`[a-z]`', $pass2)) {
                        if (preg_match('`[0-9]`', $pass2)) {
                            //Si cumple las condiciones
                            $u = new Usuarios();
                            $u->id = $id;
                            $u->password = md5($pass1);
                            $ok = $u->setPassword($u);
                            $h = new Historia();
                            $h->usuario_id = $id;
                            $h->accion = "cambio de password";
                            $h->extra = "";
                            $h->ip = $_SERVER['REMOTE_ADDR'];
                            $h->setHistoria($h);
                            if ($ok == true) {
                                $_SESSION['password'] = "ok";
                            } else {
                                $_SESSION['password'] = "no";
                            }
                        } else {
                            $_SESSION['password'] = "no";
                        }
                    } else {
                        $_SESSION['password'] = "no";
                    }
                } else {
                    $_SESSION['password'] = "no";
                }
            } else {
                $_SESSION['password'] = "no";
            }
        } else {
            $_SESSION['password'] = "no";
        }
        header("Location:" . base_url . "login/listo");
    }

    public function listo() {
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        if ($_SESSION['password'] == "ok") {
            ?><br/><br/>
            <div class="info"><center><h5>Password Actualizada</h5></center></div>    
            <?php
        } else {
            ?><br/><br/>
            <div class="info"><center><h5>Error al actualizar su clave</h5></center></div> 
            <?php
        }
        Utils::deleteSession('password');
        require_once 'views/layout/footer.php';
    }

    public function enviar() {
        header("Location: " . base_url . "login/index");
    }

}
