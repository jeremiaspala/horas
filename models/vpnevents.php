<?php
class VpnEvents
{
    private $pdo;

    // Variables por cada campo de la tabla vpn_events
    public $id;
    public $event_time;
    public $connect_time;
    public $event_type;
    public $user;
    public $service;
    public $interface;
    public $caller_id;
    public $remote_addr;
    public $local_addr;
    public $uptime_sec;
    public $router_id;
    public $session_key;

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
            $stm = $this->pdo->prepare("SELECT * FROM vpn_events ORDER BY event_time DESC");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM vpn_events WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM vpn_events WHERE id = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE vpn_events SET
                        event_time = ?,
                        connect_time = ?,
                        event_type = ?,
                        `user` = ?,
                        service = ?,
                        `interface` = ?,
                        caller_id = ?,
                        remote_addr = ?,
                        local_addr = ?,
                        uptime_sec = ?,
                        router_id = ?,
                        session_key = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)->execute(array(
                $data->event_time,
                $data->connect_time,
                $data->event_type,
                $data->user,
                $data->service,
                $data->interface,
                $data->caller_id,
                $data->remote_addr,
                $data->local_addr,
                $data->uptime_sec,
                $data->router_id,
                $data->session_key,
                $data->id
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar($data)
    {
        try {
            $sql = "INSERT INTO vpn_events
                        (event_time, connect_time, event_type, `user`, service, `interface`, caller_id, remote_addr, local_addr, uptime_sec, router_id, session_key)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)->execute(array(
                $data->event_time,
                $data->connect_time,
                $data->event_type,
                $data->user,
                $data->service,
                $data->interface,
                $data->caller_id,
                $data->remote_addr,
                $data->local_addr,
                $data->uptime_sec,
                $data->router_id,
                $data->session_key
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
