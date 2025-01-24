<form id="update" method="post" class="formMain d-flex space-between align-center">
    <div class="rowForm d-flex">
        <label for="importe">Importe*</label>
        <input type="number" id="importe" name="importe" class="inputForm" value="<?= $dates["importe"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="tipo">Tipo*</label>
        <select name="tipo" id="tipo" class="inputForm">
            <option value="e" <?= isset($dates['tipo']) && $dates['tipo'] === '€' ? 'selected' : '' ?>>€</option>
            <option value="%" <?= isset($dates['tipo']) && $dates['tipo'] === '%' ? 'selected' : '' ?>>%</option>
        </select>
    </div>
    <div class="rowForm d-flex">
        <label for="fechaInicio">Fecha inicio*</label>
        <input type="date" id="fechaInicio" name="fechaInicio" class="inputForm" value="<?= $dates["fecha_inicio"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="fechaFin">Fecha fin*</label>
        <input type="date" id="fechaFin" name="fechaFin" class="inputForm" value="<?= $dates["fecha_fin"] ?>">
    </div>
    <input type="hidden" name="nombre" value="<?= $dates["nombre"] ?>">
    <div class="rowSubmit d-flex space-end">
        <input type="submit" name="submit" id="submitUpdateDesc" value="Guardar" class="button">
    </div>
</form>