<?php

class Empresas{
    private $pdo;
    public $id;
    public $nombre;
    public $direccion;
    public $cuit;
    public $telefono;
    public $condicionfiscal;
    public $fecha;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    //todas
    function getAllEmpresas() {
         try{
                $stm = $this->pdo->prepare("Select * from empresas");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //traer una
    function getEmpresa($id){
        try{
                $stm = $this->pdo->prepare("select * from empresas where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Salvar una
    function setEmpresa(Empresas $empresa){
        try{
            $query = "insert into empresas(nombre, direccion, cuit, telefono, condicionfiscal) "
                    . "values(?,?,?,?,?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $empresa->nombre,
                        $empresa->direccion,
                        $empresa->cuit,
                        $empresa->telefono,
                        $empresa->condicionfiscal
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //borrar Una
    function deleteEmpresa($id){
        try{
            $query = "delete from empresas where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    function udpateEmpresa(Empresas $empresa){
        try{
            $query = "update empresas set nombre= ?, direccion = ?, cuit = ?, telefono = ?, condicionfiscal = ? where id = ?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $empresa->nombre,
                        $empresa->direccion,
                        $empresa->cuit,
                        $empresa->telefono,
                        $empresa->condicionfiscal,
                        $empresa->id
                    ));
            return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}