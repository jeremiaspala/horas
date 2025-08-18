<?php

require_once 'models/personas.php';

class PersonasController {

    //Show All
    public function index() {
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        $p = new Personas();
        $pers = $p->getAll();
        require_once 'views/personas/index.php';
        require_once 'views/layout/footer.php';
    }

    public function nuevo() {
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/personas/nuevo.php';
        require_once 'views/layout/footer.php';
    }

    public function editar() {
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if (!empty($id)) {
            require_once 'views/layout/header.php';
            $p = new Personas();
            $pers = $p->get($id);
            foreach ($pers as $r):
                $nombre = $r['nombre'];
                $apellidos = $r['apellidos'];
                $dni = $r['dni'];
                $celular = $r['celular'];
                $email = $r['email'];
                $fecha_nac = $r['fecha_nac'];
            endforeach;
            require_once 'views/personas/editar.php';
            require_once 'views/layout/footer.php';
        } else {
            header("Location: " . base_url . "personas/index");
        }
    }

    //Guardar Form
    public function salvar() {
        Utils::isIdentity();
        Utils::isAdmin();
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $apellidos = filter_var($_REQUEST['apellidos'], FILTER_SANITIZE_STRING);
        $dni = filter_var($_REQUEST['dni'], FILTER_SANITIZE_NUMBER_INT);
        $celular = filter_var($_REQUEST['celular'], FILTER_SANITIZE_STRING);
        $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
        $fecha_nac = filter_var($_REQUEST['fecha_nac'], FILTER_SANITIZE_STRING);
        if (!empty($nombre) && !empty($apellidos) && !empty($email)) {
            $e = new Personas();
            $e->nombre = $nombre;
            $e->apellidos = $apellidos;
            $e->dni = $dni;
            $e->celular = $celular;
            $e->email = $email;
            $e->fecha_nac = $fecha_nac;
            $ok = $e->set($e);
            if ($ok == 1) {
                $_SESSION['registro'] = "ok";
            } else {
                $_SESSION['registro'] = "no";
            }
        } else {
            $_SESSION['registro'] = "no";
        }
        header("Location: " . base_url . "personas/index");
    }

    //Actualizar
    public function actualizar() {
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_var($_REQUEST['nombre'], FILTER_SANITIZE_STRING);
        $apellidos = filter_var($_REQUEST['apellidos'], FILTER_SANITIZE_STRING);
        $dni = filter_var($_REQUEST['dni'], FILTER_SANITIZE_NUMBER_INT);
        $celular = filter_var($_REQUEST['celular'], FILTER_SANITIZE_STRING);
        $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
        $fecha_nac = filter_var($_REQUEST['fecha_nac'], FILTER_SANITIZE_STRING);
        if (!empty($nombre) && !empty($apellidos) && !empty($email) && !empty($id)) {
            $e = new Personas();
            $e->nombre = $nombre;
            $e->apellidos = $apellidos;
            $e->dni = $dni;
            $e->celular = $celular;
            $e->email = $email;
            $e->fecha_nac = $fecha_nac;
            $e->id = $id;
            $ok = $e->update($e);
            if ($ok == 1) {
                $_SESSION['registro'] = "ok";
            } else {
                $_SESSION['registro'] = "no";
            }
        } else {
            $_SESSION['registro'] = "no";
        }
        header("Location:" . base_url . "personas/index");
    }

    //Eliminar
    public function eliminar() {
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if (!empty($id)) {
            $e = new Personas();
            $res = $e->delete($id);
            if ($res == true) {
                $_SESSION['delete'] = "ok";
            } else {
                $_SESSION['delete'] = "no";
            }
            header("Location: " . base_url . "personas/index");
        }
    }

}
