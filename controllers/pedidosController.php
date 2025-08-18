<?php
require_once 'models/pedidos.php';
require_once 'models/lineas_pedidos.php';
class pedidosController{
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        //Acá instanciamos pedidos y buscamos que onda
        $p = new Pedidos();
        $pedido = $p->getAll();
        require_once 'views/pedidos/index.php';
        require_once 'views/layout/footer.php';
    }
    public function add(){
        require_once 'views/mobile/layout/header.php';
        Utils::isIdentity();
        $identity = Utils::getIdentity();
        $usuario_id = $identity['id'];
        $provincia = filter_var($_REQUEST['provincia'], FILTER_SANITIZE_STRING);
        $localidad = filter_var($_REQUEST['localidad'], FILTER_SANITIZE_STRING);
        $direccion = filter_var($_REQUEST['direccion'], FILTER_SANITIZE_STRING);
        $extras = filter_var($_REQUEST['extras'], FILTER_SANITIZE_STRING);
        $telefono = filter_var($_REQUEST['telefono'], FILTER_SANITIZE_NUMBER_INT);
        $cp = filter_var($_REQUEST['cp'], FILTER_SANITIZE_STRING);
        $stats = Utils::statsCarrito();
        $costo = $stats['costo'];
        if($provincia && $localidad && $direccion && $cp && $telefono){
            //echo "Se comprueban las variables!";
            //echo "Variables: ".$provincia." ".$localidad." ".$direccion." ".$extras." ".$telefono." ".$cp." ".$usuario_id;
            $pe = new Pedidos();
            $pe->usuario_id = $usuario_id;
            $pe->provincia = $provincia;
            $pe->localidad = $localidad;
            $pe->direccion = $direccion;
            $pe->telefono = $telefono;
            $pe->cp = $cp;
            $pe->extras = $extras;
            $pe->costo = $costo;
            $res = $pe->setPedido($pe);
            if($res !=null){
                $this->setLineas($res);
                echo "<br/><h2>Su Solicitud de cotización ha sido envíada</h2><br/><h3>Nos comunicaremos a la brevedad para finalizar el pedido</h3>";
            }else{
                echo "Error al guardar!";
            }
        }else{
            echo "Faltan completar cosas";   
        }        
        require_once 'views/mobile/layout/footer.php';
    }
    public function setLineas($id){
		foreach($_SESSION['carrito'] as $elemento){
			$producto = $elemento['producto_id'];
			$color = $elemento['color'];
                        $unidades = $elemento['unidades'];
                        $li = new Lineas_Pedidos();
                        $li->pedidos_id = $id;
                        $li->producto_id = $producto;
                        $li->unidades = $unidades;
                        $li->color = $color;    
                        $li->setLinea($li);
                }
                unset($_SESSION['carrito']);
    }
}
