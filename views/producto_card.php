<?php
if (!empty($dates)) {
    foreach ($dates as $date) {
        $nombre = formatearNombre($date['nombre']);
        $tallaMin = obetener_min_talla($con, $date['id']);
        $tallaMin = $tallaMin > 1 ? "/talla-" . $tallaMin : "";
?>
        <div class="productCard">
            <a href="/producto/<?= $date['id']; ?>/<?= $nombre ?><?= $tallaMin ?>" class="cardWrap">
                <div class="imageWrap">
                    <img src="/media/productos/<?= $date['img1']; ?>" alt="<?= $date['nombre']; ?>" title="<?= $date['nombre']; ?>">
                </div>
                <div class="infoWrap">
                    <h3 class="title"><?= $date['nombre']; ?></h3>
                    <div class="precioWrap itemsCenter">
                        <?php consultar_precio($con, $date["id"], $date['precio'], false) ?>
                    </div>
                </div>
            </a>
        </div>
    <?php }
} else {
    ?>
    <div class="w-100 itemsCenter">
        <?php
        if (isset($_GET["buscar"])) { ?>
            <p>Lo sentimos, pero no hay productos que coincidan con tu búsqueda.</p>
        <?php } else { ?>
            <p>Lo sentimos, pero aun no hay productos registrados para esta categoría.</p>
        <?php } ?>
    </div>
<?php
} ?>