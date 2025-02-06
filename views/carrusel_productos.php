<section class="container">
    <h2 class="subTitle"><?= $titulo ?></h2>
    <div class=" carrusel">
        <div class=" <?php if(count($dates) > 4){ ?> productosCarrusel <?php } ?>">
            <?php include 'producto_card.php' ?>
        </div>
    </div>
    <div class="tabla"></div>
</section>