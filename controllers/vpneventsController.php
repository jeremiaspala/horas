<?php
require_once 'models/vpnevents.php';

class VpnEventsController
{
    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new VpnEvents();
    }

    public function Index()
    {
        $eventos = $this->model->Listar();
        require_once 'views/vpnevents/index.php';
    }

    public function editar()
    {
        $e = new stdClass();
        $e->id = 0;
        $e->event_time = null;
        $e->connect_time = null;
        $e->event_type = 'up';
        $e->user = '';
        $e->service = '';
        $e->interface = '';
        $e->caller_id = null;
        $e->remote_addr = null;
        $e->local_addr = null;
        $e->uptime_sec = null;
        $e->router_id = '';
        $e->session_key = null;

        if (isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $e = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/vpnevents/editar.php';
    }

    public function Guardar()
    {
        $data = new stdClass();
        $data->id           = (int)($_POST['id'] ?? 0);
        $data->event_time   = $_POST['event_time'] ?? null;
        $data->connect_time = $_POST['connect_time'] ?? null;
        $data->event_type   = $_POST['event_type'] ?? 'up';
        $data->user         = $_POST['user'] ?? '';
        $data->service      = $_POST['service'] ?? '';
        $data->interface    = $_POST['interface'] ?? '';
        $data->caller_id    = $_POST['caller_id'] ?? null;
        $data->remote_addr  = $_POST['remote_addr'] ?? null;
        $data->local_addr   = $_POST['local_addr'] ?? null;
        $data->uptime_sec   = ($_POST['uptime_sec'] !== '' ? (int)$_POST['uptime_sec'] : null);
        $data->router_id    = $_POST['router_id'] ?? '';
        $data->session_key  = $_POST['session_key'] ?? null;

        if ($data->id > 0) {
            $this->model->Actualizar($data);
        } else {
            $this->model->Registrar($data);
        }
        header('Location: '. base_url."vpnevents/index");
    }

    public function Eliminar()
    {
        $id = (int)($_REQUEST['id'] ?? 0);
        if ($id > 0) $this->model->Eliminar($id);
        header('Location: '. base_url."vpnevents/index");
    }
}
