<?php

class Personas {

    private $pdo;
    public $id;
    public $nombre;
    public $apellidos;
    public $dni;
    public $celular;
    public $email;
    public $fecha_nac;
    public $created_at;

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
                $stm = $this->pdo->prepare("Select * from personas");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
     //todas
    function get($id) {
         try{
                $stm = $this->pdo->prepare("Select * from personas where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
     //todas
    function getEmail($email) {
         try{
                $stm = $this->pdo->prepare("Select * from personas where email = ?");
                $stm->execute(array($email));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Salvar una
    function set(Personas $persona){
        try{
            $query = "insert into personas(nombre, apellidos, dni, celular, email, fecha_nac, created_at) "
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
            $query = "delete from personas where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    function update(Personas $persona){
        try{
            $query = "update personas set nombre= ?, apellidos = ?, dni = ?, celular = ?, email = ?, fecha_nac = ? where id = ?";
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
