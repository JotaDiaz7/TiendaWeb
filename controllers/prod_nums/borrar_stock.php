<?php
session_start();

if ((isset($_GET["producto"]) && empty($_GET["producto"]))
|| (isset($_GET["talla"]) && empty($_GET["talla"]))
) {
    header("Location: /");
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de prod_nums
require '../../models/prod_nums_models.php';
$model = new ProdNumsModel;

$id = htmlspecialchars(trim($_GET["producto"]));
$talla = htmlspecialchars(trim($_GET["talla"]));

//Actualizamos los datos
$result = $model->borrarStock($con, $id, $talla);

// Cerrar la conexión
$con = null;

if ($result) {
    header("Location: /admin/stock/".$id);
}
exit;