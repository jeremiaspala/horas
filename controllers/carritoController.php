<?php
require_once 'models/productos.php';
class CarritoController{
    public function index(){
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
			$carrito = $_SESSION['carrito'];
		}else{
			$carrito = array();
		}
		var_dump($carrito);
    }
    public function add(){
        if(!empty($_REQUEST['id'])){
            $producto_id = intval(filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT));
            $color_id = intval(filter_var($_REQUEST['color'], FILTER_SANITIZE_NUMBER_INT));
            if(isset($_SESSION['carrito'])){
                $counter = 0;
                foreach ($_SESSION['carrito'] as $indice => $elemento){
                    if($elemento['producto_id'] == $producto_id && $elemento['color']==$color_id){
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $counter++;
                    }
                }
            }
            if(!isset($counter) || $counter == 0 ){
                $p = new Productos();
                $producto = $p->getProducto($producto_id);
                foreach ($producto as $r):
                    $numero = $r['numero'];
                    $descripcion = $r['descripcion'];
                    $kgmt = $r['kgmt'];
                    $imagen = $r['imagen'];
                    $color = filter_var($_REQUEST['color'], FILTER_SANITIZE_STRING);
                endforeach;
                $_SESSION['carrito'][] = array(
                    'producto_id' => $producto_id,
                    'kgmt' => $kgmt,
                    'numero' => $numero,
                    'descripcion' => $descripcion,
                    'unidades' => 1,
                    'producto' => $producto,
                    'imagen' => $imagen,
                    'color' => $color
                );
            }
            header("Location:".base_url."mobile/productos");
           
        }else{
            header("Location:".base_url."mobile/productos");
        }
    }
    public function remove(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
            echo "ok";
            header("Location:".base_url."mobile/carro");
	}
    }
    public function up(){
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			$_SESSION['carrito'][$index]['unidades']++;
		}
		header("Location:".base_url."mobile/carro");
	}
	
	public function down(){
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			$_SESSION['carrito'][$index]['unidades']--;
			
			if($_SESSION['carrito'][$index]['unidades'] == 0){
				unset($_SESSION['carrito'][$index]);
			}
		}
		echo "ok";
                header("Location:".base_url."mobile/carro");
	}
    public function delete(){
        Utils::deleteSession("carrito");
        echo "ok";
        header("Location:".base_url."mobile/carro");
    }
}