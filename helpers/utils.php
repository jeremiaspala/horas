<?php

class Utils {

    public static function deleteSession($name) {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function getIdentity() {
        foreach ($_SESSION['identity'] as $r):
            return $r;
        endforeach;
    }

    public static function isAdmin() {
            $identidad = Utils::getIdentity();
		if($identidad['rol']=="admin"){
			return true;
		}else{
			header("Location:".base_url."error/index");
		}
    }

    public static function isIdentity() {
        if (!isset($_SESSION['identity'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function showCategorias() {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function statsCarrito() {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['carrito'])) {
            $stats['count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }

        return $stats;
    }

    public static function showStatus($status) {
        $value = 'Pendiente';

        if ($status == 'confirm') {
            $value = 'Pendiente';
        } elseif ($status == 'preparation') {
            $value = 'En preparación';
        } elseif ($status == 'ready') {
            $value = 'Preparado para enviar';
        } elseif ($status = 'sended') {
            $value = 'Enviado';
        }

        return $value;
    }

    public static function HumanSize($Bytes) {
        $Type = array("", "kilo", "mega", "giga", "tera", "peta", "exa", "zetta", "yotta");
        $Index = 0;
        while ($Bytes >= 1024) {
            $Bytes /= 1024;
            $Index++;
        }
        return("" . $Bytes . " " . $Type[$Index] . "bytes");
    }

    public static function encriptar($valor){
        $clave = 'i am vengeance';
        $method = 'aes-256-cbc';
        $iv = base64_decode("C8fBxl1g7EWtYTL1/M8jfstw0=");

        return openssl_encrypt(base64_encode($valor), $method, $clave, false, $iv);
    }

    public static function desencriptar($valor){
        $clave = 'i am vengeance';
        $method = 'aes-256-cbc';
        $iv = base64_decode("C8fBxl1g7EWtYTL1/M8jfstw0=");

        return base64_decode(openssl_decrypt($valor, $method, $clave, false, $iv));
    }
    public static function quitarCaracter($cadena, $caracter){
        $searchString = $caracter;
        $replaceString = "";
        $outputString = str_replace($searchString, $replaceString, $cadena); 
        return $outputString;
    }

}
