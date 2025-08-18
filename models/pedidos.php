<?php

class Pedidos{
    private $pdo;
    public $usuario_id;
    public $provincia;
    public $localidad;
    public $direccion;
    public $telefono;
    public $extras;
    public $costo;
    public $estado;
    public $fecha;
    public $hora;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex;
        }
    }
    //Get All
    public function  getAll(){
        try{
                $stm = $this->pdo->prepare("select p.id, p.usuario_id, p.provincia, p.localidad, p.direccion, p.cp, p.telefono, p.extras, p.fecha, u.nombre, u.apellidos, u.email, u.celular, u.imagen from pedidos as p
inner join usuarios as u on p.usuario_id = u.id");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAllLineas($id){
        $query = "select u.apellidos, u.nombre, u.email, u.celular, pe.cp, pe.direccion, pe.estado, pe.localidad, pe.provincia, pe.fecha, pe.telefono, p.id, p.numero, p.imagen, p.kgmt, p.largo, p.precio, p.oferta, lp.unidades, c.color, lp.pedidos_id from lineas_pedidos as lp 
                    inner join colores as c on lp .color = c.id 
                    inner join productos as p on lp.producto_id = p.id 
                    inner join pedidos as pe on pe.id  = lp.pedidos_id 
                    inner join usuarios as u on pe.usuario_id = u.id 
                    where pedidos_id = ?
                    order by lp.pedidos_id";
        try{
                $stm = $this->pdo->prepare($query);
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //get uno solo
    public function setPedido(Pedidos $pedido){
        try{
            $query = "insert into pedidos(usuario_id, provincia, localidad, direccion, cp, telefono, extras, costo) values(?, ?, ?, ?, ?, ?, ?, ?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $pedido->usuario_id,
                        $pedido->provincia,
                        $pedido->localidad,
                        $pedido->direccion,
                        $pedido->cp,
                        $pedido->telefono,
                        $pedido->extras,
                        $pedido->costo
                    ));
                return $this->pdo->lastInsertId();
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Obtener último registro
    public function  getLast(){
        try{
                $stm = $this->pdo->prepare("Select last_insert_id as pedido from pedidos");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Eliminar uno
    
    

}
