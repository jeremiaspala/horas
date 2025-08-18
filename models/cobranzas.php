<?php

class cobranzas{
    private $pdo;
    public $id;
    public $empresa_id;
    public $persona_id;
    public $email;
    public $monto;
    public $tipo_pago;
    public $dia_pago;
    public $mes_pago;
    public $fecha_fin;
    public $ultimo_pago;
    
    
    function __construct() {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
     //todas
    function getAll() {
         try{
                $stm = $this->pdo->prepare("Select * from programacion");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Una
    function get($id) {
         try{
                $stm = $this->pdo->prepare("Select * from programacion where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Salvar una
    function set(Personas $persona){
        try{
            $query = "insert into programacion(nombre, apellidos, dni, celular, email, fecha_nac, created_at) "
                    . "values(?,?,?,?,?,?, now())";
            $this->pdo->prepare($query)->execute(
                    array(
                        $persona->nombre,
                        $persona->apellidos,
                        $persona->dni,
                        $persona->celular,
                        $persona->email,
                        $persona->fecha_nac
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
     //borrar Una
    function delete($id){
        try{
            $query = "delete from programacion where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    function update(Personas $persona){
        try{
            $query = "update programacion set nombre= ?, apellidos = ?, dni = ?, celular = ?, email = ?, fecha_nac = ? where id = ?";
            $this->pdo->prepare($query)->execute(
                    array(
                       $persona->nombre,
                        $persona->apellidos,
                        $persona->dni,
                        $persona->celular,
                        $persona->email,
                        $persona->fecha_nac,
                        $persona->id
                    ));
            return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}