<?php if ($categorias) {
    foreach ($categorias as $categoria) {
?>
    <li><a href="/tienda/<?= $categoria["categoria"] ?>"><?= $categoria["categoria"] ?></a></li>
<?php }
} ?>