<?php
require_once 'models/apitokens.php';

class ApiTokensController
{
    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new ApiTokens();
    }

    // Listado con acciones (editar, regenerar token, habilitar/deshabilitar, eliminar)
    public function Index()
    {
        $tokens = $this->model->Listar();
        require_once 'views/layout/header.php';
        require_once 'views/apitokens/index.php';
        require_once 'views/layout/footer.php';
    }

    // Form alta/edición
    public function editar()
    {
        $token = new stdClass();
        $token->id = 0;
        $token->name = '';
        $token->token = '';
        $token->enabled = 1;
        $token->created_at = null;

        if (isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $token = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/layout/header.php';
        require_once 'views/apitokens/editar.php';
        require_once 'views/layout/footer.php';
    }

    // Guardar alta/edición
    public function Guardar()
    {
        $data = new stdClass();
        $data->id      = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $data->name    = trim($_POST['name'] ?? '');
        $data->token   = trim($_POST['token'] ?? '');
        $data->enabled = isset($_POST['enabled']) ? (int)$_POST['enabled'] : 0;

        if ($data->id > 0) {
            $this->model->Actualizar($data);
        } else {
            // si no viene token, generamos uno
            if ($data->token === '') {
                $data->token = bin2hex(random_bytes(32));
            }
            $this->model->Registrar($data);
        }
        header('Location: '. base_url."apitokens/index");
    }

    // Habilitar/deshabilitar
    public function Toggle()
    {
        $id = (int)($_REQUEST['id'] ?? 0);
        if ($id > 0) {
            $row = $this->model->Obtener($id);
            if ($row) {
                $row->enabled = $row->enabled ? 0 : 1;
                $this->model->Actualizar($row);
            }
        }
        // soporte para AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            echo json_encode(['ok' => true]);
            return;
        }
        header('Location: '. base_url."apitokens/index");
    }

    // Regenerar token
    public function Regenerar()
    {
        $id = (int)($_REQUEST['id'] ?? 0);
        if ($id > 0) {
            $row = $this->model->Obtener($id);
            if ($row) {
                $row->token = bin2hex(random_bytes(32));
                $this->model->Actualizar($row);
            }
        }
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            echo json_encode(['ok' => true]);
            return;
        }
        header('Location: '. base_url."apitokens/index");
    }

    public function Eliminar()
    {
        $id = (int)($_REQUEST['id'] ?? 0);
        if ($id > 0) $this->model->Eliminar($id);
        header('Location: '. base_url."apitokens/index");
    }
}
