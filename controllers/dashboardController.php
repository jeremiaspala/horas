<?php

require_once 'models/horas.php';
require_once 'models/personas.php';

class DashboardController {

    public function index() {
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        if ($identity['rol'] == "admin") {
            require_once 'views/dashboard/index.php';
        } else {
            $p = new Personas();
            $per = $p->getEmail($identity['email']);
            foreach ($per as $pe):
                $persona_id = $pe['id'];
            endforeach;
            $cat = new Horas();
            $categoria = $cat->getAll($persona_id);
            $sumar = $cat->getSumaNoLiqll($persona_id);
            require_once 'views/horas/mis.php';
        }
        require_once 'views/layout/footer.php';
    }

}
