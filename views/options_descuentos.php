<?php if ($dates) {
    foreach ($dates as $descuento) {
?>
        <option value="<?= $descuento["nombre"] ?>"><?= $descuento["nombre"] ?></option>

<?php }
} ?>