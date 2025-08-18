<?php

class Lineas_Pedidos{
    private $pdo;
    public $producto_id;
    public $pedidos_id;
    public $unidades;
    public $color;
            
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    //Agregar línea
    public function setLinea(Lineas_Pedidos $linea){
        try{
            $query = "insert into lineas_pedidos(producto_id, pedidos_id, unidades, color) values(?,?,?,?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $linea->producto_id,
                        $linea->pedidos_id,
                        $linea->unidades,
                        $linea->color
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getLineas($id){
            try{
                $stm = $this->pdo->prepare("Select * from lineas_pedidos where pedidos_id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}