<?php

class Productos{
    private $pdo;
    public $categoria_id;
    public $numero;
    public $descripcion;
    public $kgmt;
    public $largo;
    public $precio;
    public $stock;
    public $oferta;
    public $imagen;
    public $id;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex;
        }
    }
    //Trae todo
    public function getAll(){
        try{
                $stm = $this->pdo->prepare("Select categorias.nombre as categoria, numero, descripcion, kgmt, largo, precio, stock, oferta, imagen, fecha, productos.id as id from productos inner join categorias on categorias.id = productos.categoria_id");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getPrecio($id){
        
    }
    public function getAllbyCat($cat){
            try{
                $stm = $this->pdo->prepare("Select categorias.nombre as categoria, numero, descripcion, kgmt, largo, precio, stock, oferta, imagen, fecha, productos.id as id from productos inner join categorias on categorias.id = productos.categoria_id where categorias.id = ?");
                $stm->execute(array($cat));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    ////trae uno
    public function getProducto($id){
            try{
                $stm = $this->pdo->prepare("Select categorias.nombre as categoria, numero, descripcion, kgmt, largo, precio, stock, oferta, imagen, fecha, productos.id as id from productos inner join categorias on categorias.id = productos.categoria_id where productos.id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Crea uno
    public function setProducto(Productos $producto){
        try{
            $query = "insert into productos(categoria_id, numero, descripcion, kgmt, largo, precio, stock, oferta, imagen) "
                    . "values(?,?,?,?,?,?,?,?,?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $producto->categoria_id,
                        $producto->numero,
                        $producto->descripcion,
                        $producto->kgmt,
                        $producto->largo,
                        $producto->precio,
                        $producto->stock,
                        $producto->oferta,
                        $producto->imagen
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //actualizad
    public function update(Productos $producto) {
        try{
            if($producto->imagen == NULL){
                $query = "update productos set categoria_id = ?, numero = ?, descripcion = ?, kgmt = ?, largo = ?, precio = ?,"
                    . " stock = ?, oferta = ? where id = ?";
                $this->pdo->prepare($query)->execute(
                    array(
                        $producto->categoria_id,
                        $producto->numero,
                        $producto->descripcion,
                        $producto->kgmt,
                        $producto->largo,
                        $producto->precio,
                        $producto->stock,
                        $producto->oferta,
                        $producto->id
                    ));
                return true;
            }else{
                $query = "update productos set categoria_id = ?, numero = ?, descripcion = ?, kgmt = ?, largo = ?, precio = ?,"
                    . " stock = ?, oferta = ?, imagen = ? where id = ?";
                $this->pdo->prepare($query)->execute(
                    array(
                        $producto->categoria_id,
                        $producto->numero,
                        $producto->descripcion,
                        $producto->kgmt,
                        $producto->largo,
                        $producto->precio,
                        $producto->stock,
                        $producto->oferta,
                        $producto->imagen,
                        $producto->id
                    ));
                return true;
            }

            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //elimina uno
    public function eliminar($id){
        try{
            $query = "delete from productos where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    

}
