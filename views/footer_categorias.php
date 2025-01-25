<?php if ($categorias) {
    foreach ($categorias as $categoria) {
?>
    <li><a href="/tienda/<?= $categoria["id"] ?>"><?= $categoria["nombre"] ?></a></li>
<?php }
} ?>