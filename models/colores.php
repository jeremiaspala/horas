<?php

class Colores{
    private $pdo;
    public $id;
    public $color;
    public $precio;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function setColor(Colores $colores){
            try{
            $query = "insert into colores(color, precio) "
                    . "values(?, ?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $colores->color,
                        $colores->precio
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from colores where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function update(Colores $colores){
            try{
            $query = "update colores set color = ?, precio = ? where id=?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $colores->color,
                        $colores->precio,
                        $colores->id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAll(){
            try{
                $stm = $this->pdo->prepare("Select * from colores");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getColor($id){
        try{
                $stm = $this->pdo->prepare("select * from colores where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}
