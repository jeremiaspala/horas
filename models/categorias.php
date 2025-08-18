<?php

class Categorias{
    private $pdo;
    public $id;
    public $nombre;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function setCategoria(Categorias $categorias){
            try{
            $query = "insert into categorias(nombre) "
                    . "values(?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $categorias->nombre
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from categorias where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function update(Categorias $categorias){
            try{
            $query = "update categorias set nombre = ? where id=?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $categorias->nombre,
                        $categorias->id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAll(){
            try{
                $stm = $this->pdo->prepare("Select * from categorias");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getCategoria($id){
        try{
                $stm = $this->pdo->prepare("select * from categorias where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}
