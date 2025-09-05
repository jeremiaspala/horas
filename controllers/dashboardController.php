<?php

require_once 'models/horas.php';
require_once 'models/vpnevents.php';
require_once 'models/personas.php';

class DashboardController {

    public function index() {
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        $a = new VpnEvents();
        $vp = $a->UsuariosConectadosAhora();
        $tpuh = $a->TopUsuariosMes(4);
        $la = $a->ListarLast();
        require_once 'views/dashboard/index.php';
        require_once 'views/layout/footer.php';
    }

}
