<?php foreach ($dates as $date) {
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
<?php } ?>