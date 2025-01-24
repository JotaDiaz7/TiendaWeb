<?php if ($categorias) {
    foreach ($categorias as $categoria) {
?>
        <option value="<?= $categoria["categoria"] ?>"><?= $categoria["categoria"] ?></option>

<?php }
} ?>