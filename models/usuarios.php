<?php

class Usuarios{
    private $pdo;
    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $password;
    public $rol;
    public $imagen;
    public $celular;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    //Trae todo
    public function getAllUsuarios(){
         try{
                $stm = $this->pdo->prepare("select * from usuarios");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //trae uno solo
    public function getUsuario($id){
         try{
                $stm = $this->pdo->prepare("select * from usuarios where id=?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public static function existeEmail($email){
            try{
                $stm = $this->pdo->prepare("select email from usuarios where email=?");
                $stm->execute(array($email));
                $email = $stm->fetchAll(PDO::FETCH_ASSOC);
                if($email ==null){
                    return false;
                }else{
                    return true;
                }
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //Guarda usuario
    public function setUsuario(Usuarios $usuarios){
        try{
                $stm = $this->pdo->prepare("insert into usuarios(nombre, apellidos, email, password, rol, celular) "
                        . "values(?,?,?, ?, ?, ?)");
                $stm->execute(array(
                    $usuarios->nombre,
                    $usuarios->apellidos,
                    $usuarios->email,
                    $usuarios->password,
                    $usuarios->rol,
                    $usuarios->celular
                ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //actualizar usuario
    public function update(Usuarios $usuarios){
        try{
                $stm = $this->pdo->prepare("update usuarios set nombre = ?, apellidos = ?, email = ?, password=?, rol=?, celular=? where id = ?");
                $stm->execute(array(
                    $usuarios->nombre,
                    $usuarios->apellidos,
                    $usuarios->email,
                    $usuarios->password,
                    $usuarios->rol,
                    $usuarios->celular, 
                    $usuarios->id
                ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
        //Elimina usuario
    public function delete($id){
        try{
            $query = "delete from usuarios where id =?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    //trae uno solo
    public function getLogin(Usuarios $usuarios){
         try{
                $stm = $this->pdo->prepare("select * from usuarios where email =? and password = ?");
                $stm->execute(array($usuarios->email, $usuarios->password));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    //get Estado habilitado
    /*public function getHabilitado($id){
        try{
                $stm = $this->pdo->prepare("select habilitado as hab from usuarios where id = ?");
                $stm->execute(array($id));
                $datos =  $stm->fetchAll(PDO::FETCH_ASSOC);
                foreach ($datos as $d):
                    return $d['hab'];
                endforeach;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }*/
    //Habilitar Usuario
    public function setHabilitado($id){
        $estado = $this->getHabilitado($id);
        if($estado==1){
            $hab = 0;
            try{
            $stm = $this->pdo->prepare($query)->execute(array($hab));
                return 1;
            } catch (Exception $ex) {
                return $ex->getMessage();
            } 
        }else{
            $hab = 1;
          try{
            $stm = $this->pdo->prepare($query)->execute(array($hab));
                return 1;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }  
        }
        
    }
    //update password
    public function setPassword(Usuarios $usuarios){
            try{
            $query = "update usuarios set password = ? where id = ?";
            $this->pdo->prepare($query)->execute(
                    array(
                        $usuarios->password,
                        $usuarios->id
                        ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
}

