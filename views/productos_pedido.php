<?php
foreach ($lineas as $item) {
    $nombre = formatearNombre($item['nombre']);
    $talla = $item['talla'] > 1 ? "/talla-" . $item['talla'] : ""; //Si la talla es mayor a uno es calzado
?>
    <li class="product d-flex">
        <a href="/producto/<?= $item['id'] ?>/<?= $nombre ?><?= $talla ?>" class="imgProdCar d-flex">
            <img src="/media/productos/<?= $item['img1']; ?>">
        </a>
        <div class="infoProd d-flex">
            <h4><a href="/producto/<?= $item['id'] ?>/<?= $nombre ?><?= $talla ?>" class="titleProd"><?= $item['nombre']; ?></a></h4>
            <div class="sizeProd"><?php if ($item['talla'] > 0) { ?> Talla: <?= $item['talla']; ?> <?php } ?></div>
            <div class="d-flex priceProdWrap">
                <div class="priceProd"><?= $item['precio']; ?>€</div>
                <div class="cantProd"><?= $item['cantidad']; ?></div>
            </div>
        </div>
    </li>
<?php } ?>