<?php if (!isset($_GET["buscar"])) { 
        $totalPag = ceil($totalItems / $numItemsPag); 
    ?>
    <div class="paginacion itemsCenter">
        <?php
        for ($i = 1; $i <= $totalPag; $i++) {
            if ($pagina == $i) {
        ?> <a class="currentPag"><?= $i ?></a>
            <?php } else { ?>
                <a href='<?= $urlA ?>?pagina=<?= $i . $orderUrl ?>'><?= $i ?></a>
        <?php
            }
        }
        ?>
    </div>
<?php } ?>