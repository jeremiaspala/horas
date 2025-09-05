<?php
// controllers/radius.php
require_once 'models/owner.php';
require_once 'models/equipo.php';
require_once 'models/vlan.php';

class radiusController
{
    private owner $owner;
    private equipo $equipo;
    private vlan $vlan;

    public function __construct()
    {
        $this->owner  = new owner();
        $this->equipo = new equipo();
        $this->vlan   = new vlan();
    }

    // GET /radius/index
    public function index()
    {
        $owners = $this->owner->all();
        $vlans  = $this->vlan->all();
        require 'views/layout/header.php';
        require 'views/radius/index.php';
        require 'views/layout/footer.php';
    }

    // GET /radius/apiowners?q=texto
    public function apiowners()
    {
        header('Content-Type: application/json; charset=utf-8');
        $q = isset($_GET['q']) ? (string)$_GET['q'] : '';
        echo json_encode($q !== '' ? $this->owner->search($q) : $this->owner->all());
    }

    // GET /radius/apiequiposbyowner?owner_id=ID
    public function apiequiposbyowner()
    {
        header('Content-Type: application/json; charset=utf-8');
        $owner_id = isset($_GET['owner_id']) ? (int)$_GET['owner_id'] : 0;
        echo json_encode($this->equipo->by_owner($owner_id));
    }

    // GET /radius/apiownershow?id=ID
    public function apiownershow()
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        echo json_encode($this->owner->find($id));
    }

    // GET /radius/apiequiposhow?id=ID
    public function apiequiposhow()
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        echo json_encode($this->equipo->find($id));
    }

    // POST /radius/storeowner
    public function storeowner()
    {
        $this->owner->create($_POST);
        $base = $GLOBALS['base_url'] ?? '/';
        header('Location: '.$base.'radius/index');
        exit;
    }

    // POST /radius/storeequipo
    public function storeequipo()
    {
        $this->equipo->create($_POST);
        $base = $GLOBALS['base_url'] ?? '/';
        header('Location: '.$base.'radius/index');
        exit;
    }
}
