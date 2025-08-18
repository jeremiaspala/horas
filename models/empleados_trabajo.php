<?php

class Empleados_trabajo{
    private $pdo;
    public $id;
    public $trabajo_id;
    public $persona_id;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        
    }
    public function getAllbyGroup($trabajo_id){
         try{
                $stm = $this->pdo->prepare("select s.nombre as nombre, s.email as email, s.apellidos as apellidos, mh.id as id, h.trabajo  as empresa_nombre, mh.trabajo_id , mh.persona_id from empleados_trabajo mh
                inner join trabajos h on 
                mh.trabajo_id = h.id
                inner join personas s on
                s.id = mh.persona_id 
                where trabajo_id =?");
                $stm->execute(array($trabajo_id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAll(){
         try{
                $stm = $this->pdo->prepare("select * from empleados_trabajo ee 
inner join personas p on persona_id =p.id ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
public function set(Empleados_trabajo $miembros){
            try{
            $query = "insert into empleados_trabajo(trabajo_id, persona_id, created_at) "
                    . "values(?, ?, now())";
            $this->pdo->prepare($query)->execute(
                    array(
                        $miembros->trabajo_id,
                        $miembros->persona_id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from empleados_trabajo where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function update(Empleados_trabajo $miembros){
            try{
            $query = "update empleados_trabajo set trabajo_id = ?, persona_id = ? where id=?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $miembros->trabajo_id,
                        $miembros->persona_id,
                        $miembros->id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function get($id){
        try{
                $stm = $this->pdo->prepare("select * from empleados_trabajo where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}
