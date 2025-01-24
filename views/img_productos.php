<div id="imgWrap">
    <div id="img1" class="imgProduct alignCenter show">
        <img src="/media/productos/<?= $dates['img1']; ?>" alt="<?= $dates['nombre']; ?>" title="<?= $dates['nombre']; ?>">
    </div>
    <?php if (!empty($dates['img2'])) { ?>
        <div id="img2" class="imgProduct alignCenter <?php if (empty($dates['img3'])) { ?> showP <?php } else { ?> showIn <?php } ?>">
            <img src="/media/productos/<?= $dates['img2']; ?>" alt="<?= $dates['nombre']; ?>" title="<?= $dates['nombre']; ?>">
        </div>
    <?php }
    if (!empty($dates['img3'])) { ?>
        <div id="img3" class="imgProduct alignCenter showOut">
            <img src="/media/productos/<?= $dates['img3']; ?>" alt="<?= $dates['nombre']; ?>" title="<?= $dates['nombre']; ?>">
        </div>
    <?php }
    if (!empty($dates['img4'])) { ?>
        <div id="img4" class="imgProduct alignCenter showOn">
            <img src="/media/productos/<?= $dates['img4']; ?>" alt="<?= $dates['nombre']; ?>" title="<?= $dates['nombre']; ?>">
        </div>
    <?php } ?>
</div>