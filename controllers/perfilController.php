<?php

class PerfilController{
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        require_once 'views/perfil/index.php';
        require_once 'views/layout/footer.php';
    }
}
