<?php

class Liquidacion{
    private $pdo;
    public $liquidacion;
    public $persona_id;
    public $trabajo_id;
    public $horas;
    public $valor;

    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    //todas
    function getAll() {
         try{
                $stm = $this->pdo->prepare("select * from liquidacion l inner join personas p on p.id = l.persona_id inner join trabajos t on t.id = l.trabajo_id ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    function getAllPersona($persona_id) {
         try{
                $stm = $this->pdo->prepare("SELECT l.liquidacion as liquidacion, l.created_at as created_at, l.updated_at as updated_at, l.id as id, l.persona_id as persona_id , "
                        . "l.trabajo_id as trabajo_id , l.horas as horas, l.valor as valor, p.nombre as nombre, "
                        . "p.apellidos as apellidos, p.email as email, p.dni as dni, p.celular as celular, t.trabajo from liquidacion l "
                        . "inner join personas p on p.id = l.persona_id inner join trabajos t on l.id = t.id where persona_id = ?");
                $stm->execute(array($persona_id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
        //traer una
    function getLiq($liquidacion){
        try{
                $stm = $this->pdo->prepare("SELECT l.id as id, l.persona_id as persona_id , "
                        . "l.trabajo_id as trabajo_id , l.horas as horas, l.valor as valor, p.nombre as nombre, "
                        . "p.apellidos as apellidos from liquidacion l inner join personas p on p.id = l.persona_id "
                        . "where liquidacion = ?");
                $stm->execute(array($liquidacion));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //traer una
    function get($id){
        try{
                $stm = $this->pdo->prepare("select * from liquidacion where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Salvar una
    function set(Liquidacion $liquidacion){
        try{
            $query = "insert into liquidacion(liquidacion, persona_id, trabajo_id, horas, valor, created_at) "
                    . "values(?,?,?,?,?, current_timestamp())";
            $this->pdo->prepare($query)->execute(
                    array(
                        $liquidacion->liquidacion,
                        $liquidacion->persona_id,
                        $liquidacion->trabajo_id,
                        $liquidacion->horas,
                        $liquidacion->valor
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //borrar Una
    function delete($id){
        try{
            $query = "delete from liquidacion where id = ?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    function udpate(Liquidacion $liquidacion){
        try{
            $query = "update liquidacion set liquidacion= ?, persona_id = ?, trabajo_id = ?, horas = ?, valor = ? where id = ?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $liquidacion->liquidacion,
                        $liquidacion->persona_id,
                        $liquidacion->trabajo_id,
                        $liquidacion->horas,
                        $liquidacion->valor, 
                        $liquidacion->id
                    ));
            return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}