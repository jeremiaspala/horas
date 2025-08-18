<?php

define("RUTA", "uploads/images/");

class ImagenController {

    public function get() {
        Utils::isIdentity();
        $archivo = filter_var($_REQUEST['im'], FILTER_SANITIZE_STRING);
        /*Método de decrypt
        $nombre = Utils::desencriptar($archivo);
        
        //Mostrar
        $imagen = file_get_contents(PATH . $nombre);  
        $img_base64 = chunk_split(base64_encode($imagen));
        return $img_base64;
        /* para mostrarla:

          echo " < img src =\"data:image/jpeg;base64,$img_base64\" />"; // en $img_base64 esta la imagen en base 64
         */
        if(file_exists(RUTA.$archivo)){
        header("Content-type: image/jpg");
        include("uploads/images/".$archivo);
        }else{
            echo "file no found!";
        }
    }

}
