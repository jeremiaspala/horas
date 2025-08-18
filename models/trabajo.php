<?php

class Trabajo{
    private $pdo;
    public $id;
    public $trabajo;
    public $valor;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function set(Trabajo $trabajo){
            try{
            $query = "insert into trabajos(trabajo, valor) "
                    . "values(?, ?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $trabajo->trabajo,
                        $trabajo->valor
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from trabajo where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function update(Trabajo $trabajo){
            try{
            $query = "update trabajos set trabajo = ?, valor = ? where id=?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $trabajo->trabajo,
                        $trabajo->valor,
                        $trabajo->id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAll(){
            try{
                $stm = $this->pdo->prepare("Select * from trabajos");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function get($id){
        try{
                $stm = $this->pdo->prepare("select * from trabajos where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }

}
