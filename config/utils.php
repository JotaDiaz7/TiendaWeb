<?php
function crearIdUsuario($nombre)
{
    $count = 1;
    $nums = "";

    while ($count <= 3) {
        $num = strval(rand(1, 9));
        $nums .= $num;
        $count++;
    }

    if ($nums[2] <= 3) {
        $ultimaLetra = "A";
    } else if ($nums[2] <= 6) {
        $ultimaLetra = "B";
    } else {
        $ultimaLetra = "C";
    }

    $letra = isset($nombre[4]) ? $nombre[4] : "C";

    if ($letra == " ") {
        $letra = "D";
    }

    $letras = $nombre[0] . $nombre[2] . $letra;
    $id = strtoupper($letras) . $nums . $ultimaLetra;
    return $id;
}

function validarEmail($correo)
{
    $posicion_arroba = strpos($correo, "@");
    $posicion_punto = strpos($correo, ".", $posicion_arroba);

    if (!$posicion_arroba || !$posicion_punto) {
        $error = "No es una dirección de email válida: ";

        if (!$posicion_arroba) {
            $error .= "Le falta el caracter arroba. ";
        }
        if (!$posicion_punto) {
            $error .= "El dominio no es válido.";
        }
        echo json_encode($error);
        exit;
    }
}

function validarTexto($text, $campo)
{
    $text = trim($text);

    if (!preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/', $text)) {
        echo json_encode("Formato campo " . $campo . " incorrecto.");
        exit;
    }
}

function validarPassword($password)
{
    $password = trim($password);

    if (!preg_match('/^.{8,}$/', $password)) {
        echo json_encode('password');
        exit;
    }
}

function validarMovil($tel)
{
    $tel = trim($tel);

    if (!preg_match('/^[1-9]{1}[0-9]{8}$/', $tel)) {
        echo json_encode('movil');
        exit;
    }
}

//Vamos a hacer una función para crear el id del producto
function crearIdProducto($nombre)
{
    $count = 1;
    $nums = "";

    while ($count <= 5) {
        $num = strval(rand(1, 9));
        $nums .= $num;
        $count++;
    }

    $letra = isset($nombre[4]) ? $nombre[4] : "C";

    if ($letra == " ") {
        $letra = "D";
    }

    $letras = $nombre[0] . $nombre[2] . $letra;
    $id = strtoupper($letras) . $nums;
    return $id;
}

//Vamos a hacer una función para validar el precio del artículo
function validarPrecio($precio)
{
    $precio = trim($precio);

    if (!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $precio) || floatval($precio) < 1) {
        echo json_encode('precio');
        exit;
    }
}

//Vamos a hacer una función para validar la talla y el stock
function validarNum($num, $campo)
{
    $num = trim($num);

    if (!preg_match('/^\d{1,2}$/', $num)) {
        echo json_encode("Formato " . $campo . " incorrecto.");
        exit;
    }
}

//Vamos a crear una función para formatear los nombres de las url
function formatearNombre($texto)
{
    $texto = strtolower($texto);

    $texto = str_replace(
        ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'ü', 'ä', 'ö', 'ë', 'ï', 'â', 'ê', 'î', 'ô', 'û'],
        ['a', 'e', 'i', 'o', 'u', 'n', 'u', 'a', 'o', 'e', 'i', 'a', 'e', 'i', 'o', 'u'],
        $texto
    );

    $texto = preg_replace('/[\s\-]+/', '-', $texto);

    $texto = trim($texto, '-');

    return $texto;
}

function calcular_descuento($dates, $precio)
{
    if(!empty($dates)){
        $precioOriginal = $precio;

        if ($dates["tipo"] == "e") {
            $precio = $precioOriginal - $dates["importe"];
        } else {
            $descuento = ($precioOriginal * $dates["importe"]) / 100;
            $precio = $precioOriginal - $descuento;
        }
        $precio = $precio < 0 ? 0 : number_format($precio, 2, '.', '');    
    }

    return $precio;
}

//Vamos a crearnos una función para crear id de características
function crearIdCaract($texto)
{
    $texto = strtolower($texto);

    $texto = str_replace(
        ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'ü', 'ä', 'ö', 'ë', 'ï', 'â', 'ê', 'î', 'ô', 'û', 'ç'],
        ['a', 'e', 'i', 'o', 'u', 'n', 'u', 'a', 'o', 'e', 'i', 'a', 'e', 'i', 'o', 'u', 'c'],
        $texto
    );

    $texto = preg_replace('/[^a-z0-9]/', '', $texto);

    return $texto;
}