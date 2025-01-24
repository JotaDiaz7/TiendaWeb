<?php if ($categorias) {
    foreach ($categorias as $categoria) {
?>
        <button data-cat="<?= $categoria["categoria"] ?>" class="d-flex space-between">
            <?= $categoria["categoria"] ?>
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </g>
            </svg>
        </button>
        <ul data-cat="<?= $categoria["categoria"] ?>">
            <?php $categoriasHijo = $model->getCategorias($con, $categoria["categoria"]) ?>
            <?php if ($categoriasHijo) {
                foreach ($categoriasHijo as $catHijo) {
                    $catUrl = formatearNombre($catHijo["categoria"]);
            ?>
                    <li><a href="/tienda/<?= $catUrl ?>"><?= $catHijo["categoria"] ?></a></li>
            <?php }
            } ?>
            <li><a href="/tienda/<?= $categoria["categoria"] ?>">Ver todo</a></li>
        </ul>

<?php }
} ?>