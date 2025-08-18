<?php

class Precintos{
    private $pdo;
    public $id;
    public $tipo;
    public $transportista;
    public $dni;
    public $tractor;
    public $acoplado;
    public $contenedor;
    public $precinto_linea;
    public $precinto_aduana;
    public $vigilador;
    public $observaciones;
    public $foto1;
    public $foto2;
    public $foto3;
    public $foto4;
    public $created_at;
    public $created_updated;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function getAll() {
        try{
                $stm = $this->pdo->prepare("select * from precintos limit 1000");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function ultimos5() {
        try{
                $stm = $this->pdo->prepare("select * from precintos order by id desc limit 5;");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    
    public function getAllBetween($fecha1, $fecha2) {
        try{
                $stm = $this->pdo->prepare("select * from precintos");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function get($id) {
        try{
                $stm = $this->pdo->prepare("select * from precintos where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function countPrecintos($tipo) {
        try{
                $stm = $this->pdo->prepare("select count(*) as cant from precintos where tipo = ?");
                $stm->execute(array($tipo));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function set(Precintos $precinto){
         try{
            $query = "INSERT INTO precintos(tipo, transportista, dni, tractor, acoplado, contenedor, precinto_linea"
                    . ", precinto_aduana, vigilador, observaciones, foto1, foto2, foto3, foto4)"
                    . "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $precinto->tipo,
                        $precinto->transportista,
                        $precinto->dni,
                        $precinto->tractor,
                        $precinto->acoplado,
                        $precinto->contenedor,
                        $precinto->precinto_linea,
                        $precinto->precinto_aduana,
                        $precinto->vigilador,
                        $precinto->observaciones,
                        $precinto->foto1,
                        $precinto->foto2,
                        $precinto->foto3,
                        $precinto->foto4
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from precintos where id = ?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
}