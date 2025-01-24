<?php
function botones_categorias($con)
{
    require_once __DIR__ . '/../../models/categorias_models.php';
    $model = new CategoriasModel;
    $categorias = $model -> getCategorias($con, "", );
    include __DIR__ . '/../../views/boton_categorias.php';
}

function footer_categorias($con)
{
    require_once __DIR__ . '/../../models/categorias_models.php';
    $model = new CategoriasModel;
    $categorias = $model -> getCategorias($con, "", );
    include __DIR__ . '/../../views/footer_categorias.php';
}

function opciones_categorias($con, $padre)
{
    require_once __DIR__ . '/../../models/categorias_models.php';
    $model = new CategoriasModel;
    $categorias = $model -> getCategorias($con, $padre);
    include __DIR__ . '/../../views/options_categorias.php';
}

function listar_categorias($con, $inicio, $num, $paginaActual)
{
    require_once __DIR__ . '/../../models/categorias_models.php';
    $model = new CategoriasModel;
    $categorias = $model -> listarCategorias($con, $inicio, $num);
    $pagina = $paginaActual = null ? 1 : $paginaActual;
    include __DIR__ . '/../../views/tabla_categorias.php';
}

function contarCat($con)
{
    require_once '../models/categorias_models.php';
    $model = new CategoriasModel;
    $num = $model -> contar($con);
    return $num;
}