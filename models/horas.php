<?php

class Horas{
    private $pdo;
    public $persona_id;
    public $descripcion;
    public $horas;
    public $liquidado;
    //constructor
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    //trae todo
    public function getAllSLiq($persona_id){
        try{
                $stm = $this->pdo->prepare("select * from horas where persona_id = ? and liquidado = 0 order by id desc");
                $stm->execute(array(
                    $persona_id
                ));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAll($persona_id){
        try{
                $stm = $this->pdo->prepare("select * from horas where persona_id = ? and liquidado = 0 order by id desc");
                $stm->execute(array(
                    $persona_id
                ));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getSumaNoLiqll($persona_id){
        try{
                $stm = $this->pdo->prepare("select SUM(horas) as suma from horas where persona_id = ? and liquidado = 0");
                $stm->execute(array(
                    $persona_id
                ));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAllLiq($persona_id){
        try{
                $stm = $this->pdo->prepare("select * from horas where persona_id = ? and liquidado = 1 order by id desc");
                $stm->execute(array(
                    $persona_id
                ));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function set(Horas $horas){
        try{
            $query = "INSERT INTO horas(persona_id, descripcion, horas, liquidado, created_at)"
                    . "values(?,?,?,0, current_timestamp())";
            $this->pdo->prepare($query)->execute(
                    array(
                        $horas->persona_id,
                        $horas->descripcion,
                        $horas->horas
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    
    public function update(Horas $horas){
            try{
                $query = "update horas set persona_id = ?, descripcion = ?, horas = ?, liquidado = 0, created_at = current_timestamp()) where id = ?";
                $this->pdo->prepare($query)->execute(
                    array(
                        $horas->persona_id,
                        $horas->descripcion,
                        $horas->horas,
                        $horas->id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    
    public function get($id){
        try{
                $stm = $this->pdo->prepare("select * from horas where id = ? ");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function setLiquidado($id, $liquidacion){
            try{
                $query = "update horas set liquidado = 1, liquidacion = ? where id=?";
                $this->pdo->prepare($query)->execute(
                    array(
                        $liquidacion, 
                        $id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id, $persona_id){
        try{
            $query = "delete from horas where id = ? and persona_id = ?";
            $this->pdo->prepare($query)->execute(array($id, $persona_id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}