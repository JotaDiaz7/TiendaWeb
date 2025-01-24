<?php
session_start();

//Vamos a comprobar si ya se ha logueado o si existe cookie
if (isset($_SESSION["usuario"]) || isset($_COOKIE["usuario"])) {
    $usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"], true);
    $id = $usuario[0];
    $rol = $usuario[1];
    $nombre = $usuario[2];
}
    
function seguridad($sesion, $rolSeguridad, $rolUsuario)
{
    //En caso de que no queramos que vean la página si no está logueado pondremos true en el primer parámetro
    //Además, vamos a comprobar el rol para saber si puede estar en esta página
    if ($sesion && $rolSeguridad > $rolUsuario) {
        header("Location: /");
        exit;
    }
}
