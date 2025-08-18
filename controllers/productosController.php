<?php

require_once 'models/productos.php';
require_once 'models/categorias.php';

class ProductosController{
  
    public function index(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $p = new Productos();
        $producto = $p->getAll();
        require_once 'views/productos/index.php';
        require_once 'views/layout/footer.php';

    }
    public function nuevo(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        $c = new Categorias();
        $cat = $c->getAll();
        require_once 'views/productos/nuevo.php';
        require_once 'views/layout/footer.php';
    }
    //Editar
    public function editar(){
        Utils::isIdentity();
        Utils::isAdmin();
        require_once 'views/layout/header.php';
        if(isset($_REQUEST['id'])){
            $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $em = new Productos();
            $datos = $em->getProducto($id);
            foreach ($datos as $a):
                $numero = $a['numero'];
                $descripcion = $a['descripcion'];
                $kgmt = $a['kgmt'];
                $largo = $a['largo'];
                $precio = $a['precio'];
                $stock = $a['stock'];
                $oferta = $a['oferta'];
                $imagen = $a['imagen'];
                $categoria = $a['categoria'];
            endforeach;
            $c = new Categorias();
            $cates = $c->getAll();
            $options ="";
            foreach ($cates as $cat):
                if($cat['nombre'] == $categoria){
                    $select = ' selected="true"';
                }else{
                    $select = '';
                }
                $options .= '<option value="'.$cat['id'].'" '.$select.'>'.$cat['nombre'].'</option>\n';
            endforeach;
        }
        require_once 'views/productos/editar.php';
        require_once 'views/layout/footer.php';
    }
    public function salvar(){
       Utils::isIdentity();
       Utils::isAdmin();
        $numero = filter_var($_REQUEST['numero'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        $kgmt = filter_var($_REQUEST['kgmt'], FILTER_SANITIZE_STRING);
        $largo = filter_var($_REQUEST['largo'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $precio = filter_var($_REQUEST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $stock = filter_var($_REQUEST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $oferta = filter_var($_REQUEST['oferta'], FILTER_SANITIZE_STRING);
        $categoria_id = filter_var($_REQUEST['categoria'], FILTER_SANITIZE_NUMBER_INT);
        
        if(!empty($numero) && !empty($descripcion) &&!empty($precio)){
            if(isset($_FILES['imagen'])){
		$file = $_FILES['imagen'];
		$filename = $file['name'];
		$mimetype = $file['type'];
                if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images', 0777, true);
                    }

                    $imagen =$filename;
                    move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                }
            }
            $e = new Productos();
            $e->numero= $numero;
            $e->descripcion = $descripcion;
            $e->kgmt = $kgmt;
            $e->largo = doubleval($largo);
            $e->precio = doubleval($precio);
            $e->oferta = $oferta;
            $e->categoria_id = $categoria_id;
            $e->imagen = $imagen;
            $ok = $e->setProducto($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."productos/index");
    }
    //Actualizar
    public function actualizar(){
       Utils::isIdentity();
       Utils::isAdmin();
        $numero = filter_var($_REQUEST['numero'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_REQUEST['descripcion'], FILTER_SANITIZE_STRING);
        $kgmt = filter_var($_REQUEST['kgmt'], FILTER_SANITIZE_STRING);
        $largo = filter_var($_REQUEST['largo'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $precio = filter_var($_REQUEST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $stock = filter_var($_REQUEST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $oferta = filter_var($_REQUEST['oferta'], FILTER_SANITIZE_STRING);
        $categoria_id = filter_var($_REQUEST['categoria'], FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($numero) && !empty($descripcion) &&!empty($precio) && !empty($id)){
            if(isset($_FILES['imagen'])){
		$file = $_FILES['imagen'];
		$filename = $file['name'];
		$mimetype = $file['type'];
                if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images', 0777, true);
                    }

                    $imagen =$filename;
                    move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                }
            }
            $e = new Productos();
            $e->numero= $numero;
            $e->descripcion = $descripcion;
            $e->kgmt = $kgmt;
            $e->largo = doubleval($largo);
            $e->precio = doubleval($precio);
            $e->oferta = $oferta;
            $e->categoria_id = $categoria_id;
            $e->imagen = $imagen;
            $ok = $e->update($e);
            if($ok == true){
                $_SESSION['registro'] = "ok";
            }else{
                $_SESSION['registro']="no";
            }
        }else{
            $_SESSION['registro']="no";
        }
        header("Location: ".base_url."productos/index");
    }
    //Eliminar
    public function eliminar(){
        Utils::isIdentity();
        Utils::isAdmin();
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            $e = new Productos();
            $res = $e->eliminar($id);
            if($res == true){
                echo "ok";
            }else{
                echo "no";
            }
        }
    }
}

