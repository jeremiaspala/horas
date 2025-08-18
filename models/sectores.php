<?php

class Sectores{
    private $pdo;
    public $id;
    public $sector;
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
                $stm = $this->pdo->prepare("select * from sectores");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
public function setColor(Sectores $sectores){
            try{
            $query = "insert into sectores(sector, descripcion) "
                    . "values(?, ?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $sectores->sector,
                        $sectores->descripcion
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from sectores where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function update(Sectores $sectores){
            try{
            $query = "update sectores set sector = ?, descripcion = ? where id=?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $sectores->sector,
                        $sectores->descripcion,
                        $sectores->id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getColor($id){
        try{
                $stm = $this->pdo->prepare("select * from sectores where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}
