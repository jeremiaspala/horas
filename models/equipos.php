<?php

class Equipos{
    private $pdo;
    public $id;
    public $nombre;
    public $tipo_id;
    public $usuarios;
    public $ip;
    public $mac;
    public $sector_id;
    public $coordenadas;
    public $descripcion;
    public $reparacion;
    public $ssh;
    public $vnc;
    public $rdp;
    public $http;
    public $https;
    public $telnet;
    public $winbox;
    private $fecha;
    
    function __construct() {
        try{
            $this->pdo = Database::StartUp();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function getAll() {
        try{
                $stm = $this->pdo->prepare("select equipos.id, equipos.nombre, equipos.tipo_id, equipos.usuarios, equipos.ip, equipos.mac, "
                        . "equipos.sector_id, equipos.coordenadas, equipos.descripcion, equipos.reparacion, equipos.ssh, equipos.vnc, "
                        . "equipos.rdp, equipos.http, equipos.https, equipos.telnet, equipos.winbox, equipos.fecha,"
                        . " sectores.sector, tipos_equipos.tipo from equipos inner join sectores on sectores.id  = equipos.sector_id inner join tipos_equipos on tipos_equipos.id = equipos.tipo_id ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getAllTemp() {
        try{
                $stm = $this->pdo->prepare("select * from tempdhcp");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getOne($id) {
        try{
                $stm = $this->pdo->prepare("select * from equipos where id = ?");
                $stm->execute(array($id));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function getOneByIp($ip) {
        try{
                $stm = $this->pdo->prepare("select * from equipos where ip = ?");
                $stm->execute(array($ip));
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function setEquipo(Equipos $equipo){
         try{
            $query = "INSERT INTO equipos(nombre, tipo_id, usuarios, ip, mac, sector_id, coordenadas"
                    . ", descripcion, reparacion, ssh, vnc, rdp, http, https, telnet, winbox)"
                    . "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $equipo->nombre,
                        $equipo->tipo_id,
                        $equipo->usuarios,
                        $equipo->ip,
                        $equipo->mac,
                        $equipo->sector_id,
                        $equipo->coordenadas,
                        $equipo->descripcion,
                        $equipo->reparacion,
                        $equipo->ssh,
                        $equipo->vnc,
                        $equipo->rdp,
                        $equipo->http,
                        $equipo->https,
                        $equipo->telnet,
                        $equipo->winbox
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function setTemp(Equipos $equipo){
         try{
            $query = "INSERT INTO equipos(nombre, ip, mac)"
                    . "values(?,?,?)";
            $this->pdo->prepare($query)->execute(
                    array(
                        $equipo->nombre,
                        $equipo->ip,
                        $equipo->mac
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function updateTemp(Equipos $equipo) {
        try{
            $query = "UPDATE equipos SET nombre=?, ip=?, mac=? WHERE ip=?;";
            $this->pdo->prepare($query)->execute(
                    array(
                        $equipo->nombre,
                        $equipo->ip,
                        $equipo->mac,
                        $equipo->ip,
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function updateEquipo(Equipos $equipo) {
        try{
            $query = "UPDATE equipos SET nombre=?, tipo_id=?, usuarios=?, ip=?, mac=?, sector_id=?, "
                    . "coordenadas=?, descripcion=?, reparacion=?, ssh=?, vnc=?, "
                    . "rdp=?, http=?, https=?, telnet=?, "
                    . "winbox=? WHERE id=?;";
            $this->pdo->prepare($query)->execute(
                    array(
                        $equipo->nombre,
                        $equipo->tipo_id,
                        $equipo->usuarios,
                        $equipo->ip,
                        $equipo->mac,
                        $equipo->sector_id,
                        $equipo->coordenadas,
                        $equipo->descripcion,
                        $equipo->reparacion,
                        $equipo->ssh,
                        $equipo->vnc,
                        $equipo->rdp,
                        $equipo->http,
                        $equipo->https,
                        $equipo->telnet,
                        $equipo->winbox,
                        $equipo->id
                    ));
                return true;
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }
    public function delete($id){
        try{
            $query = "delete from equipos where id = ?";
            $this->pdo->prepare($query)->execute(array($id));
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
}