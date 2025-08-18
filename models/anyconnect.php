<?php

class Anyconnect{
    
    private $pdo;
    public $usuario;
    public $ipvpn;
    public $ippublica;
    public $login;
    public $logintext;
    public $duracion;
    public $inactividad;
    public $created_at;
    public $updated_at;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function getAll() {
        try{
                $stm = $this->pdo->prepare("select * from anyconnect where id IN(select Max(id) from anyconnect group by logintext) and updated_at  >= NOW() - INTERVAL 10 MINUTE;");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function get($usuario) {
        try{
                $stm = $this->pdo->prepare("select * from anyconnect where id IN(select Max(id) from anyconnect group by logintext) and updated_at  >= NOW() - INTERVAL 10 MINUTE and usuario = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}