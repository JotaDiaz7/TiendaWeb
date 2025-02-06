<?php
session_start();

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo del pedido
require '../../models/pedidos_models.php';
$model = new PedidosModel;

//Creamos id, comprobando que no exista
$found = true;

while ($found) {
    $id = crearIdPedido();
    $check = $model->comprobarId($con, $id);

    if (!$check) {
        $found = false;
    }
}

//Obtenemos el id del usuario
$usuarioId = htmlspecialchars(trim($_POST["usuario"] ?? $_GET["usuario"] ));

//Incluímos el modelo de usuario
require '../../models/usuarios_models.php';
$modelU = new UsuariosModel;

//Vamos a obtener los datos del usuario para obtener la dirección, ciudad y provincia
$usuario = $modelU->getUsuario($con, $usuarioId);

//Obtenemos el método de pago
$metodoPago = htmlspecialchars(trim($_POST["metodoPago"] ?? $_GET["metodoPago"]));

//Vamos a crear la fecha y la hora de registro 
$fechaReg = date('Y-m-d');
date_default_timezone_set('Europe/Madrid');
$hora = date('H:i');

//Por último, obtenemos el importe
$importe = filter_var($_POST["importe"] ?? $_GET["importe"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

//Registramos el pedido
$model->registro($con, $id, $usuarioId, $metodoPago, $usuario["direccion"], $usuario["ciudad"], $usuario["provincia"], $fechaReg, $hora, $importe);

//Incluímos el modelo de Carrito
require '../../models/carrito_models.php';
$modelC = new CarritoModel;

//Además, incluímos el modelo de Producto y Descuento para saber si el producto en el momento de registrarse tenía algún descuento
require '../../models/productos_models.php';
$modelP = new ProductosModel;
require '../../models/descuentos_models.php';
$modelD = new DescuentosModel;

//Por último, incluímos el modelo Prod_nums para poder disminuir el stock
require '../../models/prod_nums_models.php';
$modelPN = new ProdNumsModel;

//Ahora vamos a registrar todos los productos que hay en el pedido en linea_producto
//Y al mismo tiempo, vamos a eliminar los productos de la bbdd
foreach ($_SESSION["carrito"] as $item) {
    //Calculamos el precio final del producto
    $producto = $modelP->getProducto($con, $item["producto"]);
    $precio = $producto["precio"];
    $datesDesc = $modelD->getDescuentoProducto($con, $item["producto"]);
    $precio = !empty($datesDesc) ? calcular_descuento($datesDesc, $precio) : $precio;

    //Lo registramos en la bbdd
    $model->registroLineaPedido($con, $id, $item["producto"], $item["talla"], $item["cantidad"], $precio);
    //Le bajamos el stock
    $modelPN->disminuirStock($con, $item["producto"], $item["talla"], $item["cantidad"]);
    //Le aumentamos las ventas
    $modelP->aumentarVentas($con, $item["producto"], $item["cantidad"]);
    //Lo eliminamos del carrito en la bbdd
    $modelC->eliminarProducto($con, $usuarioId, $item["producto"], $item["talla"]);
}

//Eliminamos el carrito
unset($_SESSION["carrito"]);

// Cerrar la conexión
$con = null;

echo json_encode($id);
exit;
