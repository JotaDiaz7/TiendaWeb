<?php
function buscar_usuario($con, $buscar)
{
    require_once '../models/usuarios_models.php';
    $model = new UsuariosModel;
    $usuarios = $model -> buscarUsuario($con, $buscar);
    include '../views/tabla_usuarios.php';
}

function consultar_usuario($con, $id)
{
    require_once '../models/usuarios_models.php';
    $model = new UsuariosModel;
    $dates = $model -> getUsuario($con, $id);
    include '../views/data_usuario.php';
}

function listar_usuarios($con, $order, $inicio, $num)
{
    require_once '../models/usuarios_models.php';
    $model = new UsuariosModel;
    $usuarios = $model -> listarUsuarios($con, $order, $inicio, $num);
    include '../views/tabla_usuarios.php';
}

function contar($con)
{
    require_once '../models/usuarios_models.php';
    $model = new UsuariosModel;
    $num = $model -> contar($con);
    return $num;
}