<?php if ($categorias) {
    foreach ($categorias as $categoria) {
?>
        <option value="<?= $categoria["id"] ?>"><?= $categoria["nombre"] ?></option>

<?php }
} ?>