<?php

require_once 'models/cobranzas.php';
require_once 'models/empresas.php';
require_once 'models/personas.php';
require_once 'models/empleados_empresas.php';

class CobranzasController {

    public function index() {
        Utils::isIdentity();
        require_once 'views/layout/header.php';

        require_once 'views/cobranzas/index.php';
        require_once 'views/layout/footer.php';
    }

    public function nuevo() {
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        $e = new Empresas();
        $cbo_emp = $e->getAllEmpresas();
        foreach ($cbo_emp as $a):
            $comboE = '<option value="' . $a['id'] . '">' . $a['nombre'] . '</option>\n';
        endforeach;
        require_once 'views/cobranzas/nuevo.php';
        require_once 'views/layout/footer.php';
    }

    public function empleados() {
        Utils::isIdentity();
        $id_empresa = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if($id_empresa){
            $p = new Empleados_empresas();
            $cbo_per = $p->getAllbyGroup($id_empresa);
            foreach ($cbo_per as $b):
                echo '<option value="' . $b['id'] . '">' . $b['email'] . '</option>\n';
            endforeach;
        }
    }

}
