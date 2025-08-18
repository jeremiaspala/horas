<?php
class ApiTokens
{
    private $pdo;

    // Variables por cada campo de la tabla api_tokens
    public $id;
    public $name;
    public $token;
    public $enabled;
    public $created_at;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM api_tokens ORDER BY created_at DESC, id DESC");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM api_tokens WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM api_tokens WHERE id = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE api_tokens SET
                        name = ?,
                        token = ?,
                        enabled = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)->execute(array(
                $data->name,
                $data->token,
                $data->enabled,
                $data->id
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar($data)
    {
        try {
            $sql = "INSERT INTO api_tokens (name, token, enabled) VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)->execute(array(
                $data->name,
                $data->token,
                $data->enabled
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
