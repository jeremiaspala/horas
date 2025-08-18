<?php

class Tipos_Equipos{
    private $pdo;
    public $id;
    public $tipo;
    public $descripcion;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        
    }
    public function getAll(){
         try{
                $stm = $this->pdo->prepare("select * from tipos_equipos");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getTipo($id){
         try{
                $stm = $this->pdo->prepare("select * from tipos_equipos where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from tipos_equipos where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function setTipo(Tipos_Equipos $tipos){
        try{
            $query = "INSERT INTO tipos_equipos(tipo, descripcion) VALUES(?, ?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $tipos->tipo,
                        $tipos->descripcion
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function update(Tipos_Equipos $tipos) {
        try{
            $query = "update tipos_equipos set tipo=? , descripcion=? where id=?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $tipos->tipo,
                        $tipos->descripcion,
                        $tipos->id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}

