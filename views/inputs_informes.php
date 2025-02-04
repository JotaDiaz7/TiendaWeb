<div class="filtro itemsCenter">
    <?php if ($informe == 3) { ?>
        <a href="<?= $urlA . "?dato=ASC" . $urlF ?>" class="button">Más antiguos</a>
        <a href="<?= $urlA . "?dato=DESC" . $urlF ?>" class="button">Más recientes</a>
    <?php } else if ($informe == 4 && $tipo == 2) { ?>
        <a href="<?= $urlA . "?dato=ASC" . $urlF ?>" class="button">Menos vendido</a>
        <a href="<?= $urlA . "?dato=DESC" . $urlF ?>" class="button">Más vendido</a>
    <?php } else if ($informe == 1 && $tipo == 3) { ?>
        <div class="estados">
            <ul>
                <li>
                    <?= isset($_GET["dato"]) ? $_GET["dato"] : "---------------" ?>
                </li>
                <li>
                    <a href="<?= $urlA . "?dato=Pendiente" . $urlF ?>">Pendiente</a>
                </li>
                <li>
                    <a href="<?= $urlA . "?dato=Preparando" . $urlF ?>">Preparando</a>
                </li>
                <li>
                    <a href="<?= $urlA . "?dato=Enviado" . $urlF ?>">Enviado</a>
                </li>
                <li>
                    <a href="<?= $urlA . "?dato=Entregado" . $urlF ?>">Entregado</a>
                </li>
                <li>
                    <a href="<?= $urlA . "?dato=Cancelado" . $urlF ?>">Cancelado</a>
                </li>
                <li>
                    <a href="<?= $urlA . "?dato=Devolución" . $urlF ?>">Devolución</a>
                </li>
            </ul>
        </div>
        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </g>
        </svg>
    <?php } ?>

</div>