<div id="detailsWrap">
    <h1 id="titleProduct"><?= $dates['nombre']; ?></h1>
    <div class="detailWrap">
        <?php consultar_precio($con, $id, $dates['precio']) ?>
    </div>
    <div class="detailWrap">
        <?php if ($calzado) { ?>
            <h3>Talla</h3>
            <div id="sizeWrap" class="d-flex">
                <?php
                $nombre = formatearNombre($dates['nombre']);
                foreach ($stocks as $stock) {
                ?>
                    <span class="buttonSizeWrap <?php if ($stock['talla'] == $talla) { ?> selectedSize<?php  } ?>">
                        <a data-stock="<?= $stock['stock']; ?>" href="/producto/<?= $id ?>/<?= $nombre ?>/talla-<?= $stock['talla']; ?>"
                            class="buttonSize alignCenter">
                            <?= $stock['talla']; ?>
                        </a>
                    </span>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php if (empty($stocks) || $stockTalla > 0) { 
        ?>
        <form id="productForm" method="post">
            <input type="hidden" name="id" id="idProduct" value="<?= $id ?>">
            <input type="hidden" name="talla" id="sizeProduct" value="<?= $talla ?>">
            <input type="submit" name="submitProduct" id="submitProduct" class="button" value="Añadir al carrito">
        </form>
    <?php } else { ?>
        <div class="detailWrap">
            <p>Lo sentimos, pero en este momento no tenemos existencias de este producto.</p>
        </div>
    <?php } ?>
    <div id="info" class="detailWrap">
        <h3 class="d-flex space-beetwen">Detalles del producto</h3>
        <div id="listInfo">
            <?= $dates['descripcion']; ?>
        </div>
    </div>
</div>