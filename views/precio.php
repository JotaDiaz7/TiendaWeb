<?php if ($datesDesc) {
    $precioOriginal = $precio;
    $precio = calcular_descuento($datesDesc, $precioOriginal);
?>
    <span class="precio"><?= $precio ?>€</span>
    <span class="precioOriginal"><?= $precioOriginal ?>€</span>
<?php } else { ?>
    <span class="precio"><?= $precio ?>€</span>
<?php } ?>