<?php
require_once 'models/personas.php';
require_once 'models/horas.php';
require_once 'models/trabajo.php';
require_once 'models/empleados_trabajo.php';
require_once 'models/liquidacion.php';

class LiquidacionController {

    public function index() {
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $cat = new Liquidacion();
        $categoria = $cat->getAll();
        require_once 'views/liquidacion/index.php';
        require_once 'views/layout/footer.php';
    }

    public function nuevo() {
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $cat = new Trabajo();
        $categoria = $cat->getAll();
        require_once 'views/liquidacion/nuevo.php';
        require_once 'views/layout/footer.php';
    }

    public function mis() {
        Utils::isIdentity();
        require_once 'views/layout/header.php';
        $p = new Personas();
        $per = $p->getEmail($identity['email']);
        foreach ($per as $pe):
            $persona_id = $pe['id'];
        endforeach;
        $cat = new Liquidacion();
        $liq = $cat->getAllPersona($persona_id);
        require_once 'views/liquidacion/mis.php';
        require_once 'views/layout/footer.php';
    }

    public function cboempleados() {
        Utils::isIdentity();
        Utils::isAdmin();
        $trabajo_id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if ($trabajo_id > 0) {
            $e = new Empleados_trabajo();
            $em = $e->getAllbyGroup($trabajo_id);
            echo '<option value="0">Seleccione una persona</option>';
            foreach ($em as $r):
                ?>
                <option value="<?= $r['persona_id'] ?>"><?= $r['nombre'] . " " . $r['apellido'] ?></option>
                <?php
            endforeach;
        }
    }

    public function invoice() {
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $l = new Liquidacion();
        $liq = $l->getAll();
        require_once 'views/liquidacion/invoice.php';
        require_once 'views/layout/footer.php';
    }

    public function lista() {
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $liquidacion = filter_var($_REQUEST['l'], FILTER_SANITIZE_STRING);
        if (!empty($liquidacion)) {
            $liq = new Liquidacion();
            $li = $liq->getLiq($liquidacion);
            var_dump($li);
        }
        require_once 'views/layout/footer.php';
    }

    public function tblhoras() {
        Utils::isIdentity();
        Utils::isAdmin();
        $persona_id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if ($persona_id > 0) {
            $cat = new Horas();
            $categoria = $cat->getAll($persona_id);
            $sumar = $cat->getSumaNoLiqll($persona_id);
            foreach ($categoria as $c):
                ?>
                <tr id="h<?= $c['id'] ?>">
                    <td><input type="hidden" name="liq_hora[]" value="<?= $c['id'] ?>"><input type="hidden" name="horas[]" value="<?= $c['horas'] ?>"><?= $c['horas'] ?></td>
                                <td><?= $c['created_at'] ?></td>
                                <td><?= $c['descripcion'] ?></td>
                                <td class="text-center"><a onclick="$('#h<?= $c['id'] ?>').remove();"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <?php
                            endforeach;
                        }
                    }

                    public function liquidar() {
                        Utils::isIdentity();
                        Utils::isAdmin();
                        $liquidacion = md5(date('m-d-Y h:i:s a', time())); //*
                        $persona_id = filter_var($_REQUEST['persona_id'], FILTER_SANITIZE_NUMBER_INT); //*
                        $trabajo_id = filter_var($_REQUEST['trabajo_id'], FILTER_SANITIZE_NUMBER_INT); //*
                        $horas = $_REQUEST['liq_hora'];
                        $total_horas = null;
                        $total_valor = null;
                        $valor_horas = null; //*
                        //Traer valor de hora
                        if (!empty($_REQUEST['liq_hora'])) {
                            $t = new Trabajo();
                            $tra = $t->get($trabajo_id);
                            foreach ($tra as $f):
                                $valor_horas = $f['valor'];
                            endforeach;
                            foreach ($_REQUEST['liq_hora'] as $h):
                                $z = new Horas();
                                $zora = $z->get(intval($h));
                                foreach ($zora as $x):
                                    $total_horas = $total_horas + $x['horas'];
                                endforeach;
                            endforeach;

                            $valor_horas = $total_horas * $valor_horas;

                            if (!empty($liquidacion) && !empty($persona_id) && !empty($trabajo_id) && !empty($total_horas) && !empty($valor_horas)) {
                                $l = new Liquidacion();
                                $l->liquidacion = $liquidacion;
                                $l->persona_id = $persona_id;
                                $l->trabajo_id = $trabajo_id;
                                $l->horas = $total_horas;
                                $l->valor = $valor_horas;
                                $ok = $l->set($l);
                                foreach ($_REQUEST['liq_hora'] as $d):
                                    $h = new Horas();
                                    $ok .= $h->setLiquidado(intval($d), $liquidacion);
                                endforeach;
                                header("Location: " . base_url . "liquidacion/index");
                            } else {
                                $_SESSION['registro'] = "no";
                                header("Location: " . base_url . "liquidacion/index");
                            }
                        } else {
                            $_SESSION['registro'] = "no";
                            header("Location: " . base_url . "liquidacion/index");
                        }
                    }

                }
                