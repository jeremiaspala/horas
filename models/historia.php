<?php

class Historia{
    private $pdo;
    public $usuario_id;
    public $accion;
    public $extra;
    public $ip;
    public $fecha;
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function setHistoria(Historia $historia){
        try{
            $query = "insert into historia(usuario_id, accion, extra, ip) "
                    . "values(?,?,?,?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $historia->usuario_id,
                        $historia->accion,
                        $historia->extra,
                        $historia->ip
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAll(){
          try{
                $stm = $this->pdo->prepare("select h.id as id, h.usuario_id as usuario_id, h.accion as accion, h.extra as extra, h.ip as ip, h.fecha as fecha, u.email as email from historia h inner join usuarios u on h.usuario_id = u.id order by id desc;");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAllbyId($id){
          try{
                $stm = $this->pdo->prepare("select * from historia where usuario_id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}