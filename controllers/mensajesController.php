<?php

class MensajesController{
    public function index() {
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/mensajes/index.php';
        require_once 'views/layout/footer.php';
    }
}

