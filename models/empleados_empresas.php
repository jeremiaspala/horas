<?php

class Empleados_empresas{
    private $pdo;
    public $id;
    public $empresa_id;
    public $persona_id;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        
    }
    public function getAllbyGroup($empresa_id){
         try{
                $stm = $this->pdo->prepare("select s.nombre as nombre, s.email as email, s.apellidos as apellidos, mh.id as id, h.nombre  as empresa_nombre, mh.empresa_id , mh.persona_id from empleados_empresas mh
                inner join empresas h on 
                mh.empresa_id = h.id
                inner join personas s on
                s.id = mh.persona_id 
                where empresa_id =?");
                $stm->execute(array($empresa_id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAll(){
         try{
                $stm = $this->pdo->prepare("select * from empleados_empresas ee 
inner join personas p on persona_id =p.id ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
public function set(Empleados_empresas $miembros){
            try{
            $query = "insert into empleados_empresas(empresa_id, persona_id, created_at) "
                    . "values(?, ?, now())";
            $this->pdo->prepare($query)->execute(
                    array(
                        $miembros->empresa_id,
                        $miembros->persona_id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from empleados_empresas where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function update(Empleados_empresas $miembros){
            try{
            $query = "update empleados_empresas set empresa_id = ?, persona_id = ? where id=?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $miembros->empresa_id,
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
                $stm = $this->pdo->prepare("select * from empleados_empresas where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}
