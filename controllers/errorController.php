<?php

class errorController{
	
	public function index(){
            Utils::isIdentity();
            require_once 'views/layout/header.php';
            echo "<center><h1>404</h1><br/><b>Ups!!!</b> Módulo Inexistente!!<br/>Si necesitas una función nueva no dudas en avisarme: <a href=\"mailto:jeremiaspalazzesi@gmail.com\">Jeremías Palazzesi</a></center>";
            require_once 'views/layout/footer.php';
	}
	
}