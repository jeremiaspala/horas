<?php

require_once 'models/historia.php';

class HistoriaController{
        public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $e = new Historia();
        $historia = $e->getAll();
        require_once 'views/historia/index.php';
        require_once 'views/layout/footer.php';
        
    }
}
