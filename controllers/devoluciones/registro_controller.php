<?php
session_start();

if(empty($_POST["checkbox"])){
    echo json_encode("checkbox");
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de devoluciones
require '../../models/devoluciones_models.php';
$model = new DevolucionesModel;

//Creamos id, comprobando que no exista
$found = true;

while ($found) {
    $id = crearIdDevolucion();
    $check = $model->comprobarId($con, $id);

    if (!$check) {
        $found = false;
    }
}

//Obtenemos el id del usuario
$usuarioId = htmlspecialchars(trim($_POST["usuario"]));

//Incluímos el modelo de usuario
require '../../models/usuarios_models.php';
$modelU = new UsuariosModel;

//Vamos a obtener los datos del usuario para obtener la dirección, ciudad y provincia
$usuario = $modelU->getUsuario($con, $usuarioId);

//Atrapamos el pedido
$pedido = htmlspecialchars(trim($_POST["pedido"]));

//Vamos a crear la fecha y la hora de registro 
$fechaReg = date('Y-m-d');
date_default_timezone_set('Europe/Madrid');
$hora = date('H:i');

//Por último, obtenemos el importe
$importe = filter_var($_POST["importe"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

//Registramos la devolucion
$model->registro($con, $id, $pedido, $usuarioId, $usuario["direccion"], $usuario["ciudad"], $usuario["provincia"], $fechaReg, $hora, $importe);

//Incluímos el modelo de Producto para las ventas y el modelo Prod_nums para el stock
require '../../models/productos_models.php';
$modelP = new ProductosModel;
require '../../models/prod_nums_models.php';
$modelPN = new ProdNumsModel;

//Ahora vamos a registrar todos los productos que hay en la variable devolucion en linea_devolucion
foreach ($_SESSION["devolucion"] as $item) {
    //Lo registramos en la bbdd
    $model->registroLineaDevolucion($con, $id, $item["id"], $item["talla"], $item["cantidad"], $item["precio"]);
    //Le aumentamos el stock
    $modelPN->updateStock($con, $item["id"], $item["talla"], $item["cantidad"]);
    //Le bajamos las ventas
    $modelP->disminuirVentas($con, $item["id"], $item["cantidad"]);
}

//Llamamos al model de pedido para cambiarle el estado
require '../../models/pedidos_models.php';
$modelPed = new PedidosModel;

$modelPed -> cambiarEstado($con, $pedido, "Devolución");

//Eliminamos la variable devolucion
unset($_SESSION["devolucion"]);

// Cerrar la conexión
$con = null;

echo json_encode($id);
exit;
