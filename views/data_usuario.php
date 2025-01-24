<form id="updateForm" method="post" class="formMain d-flex space-between align-center">
    <div class="rowForm d-flex">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" maxlength="50" class="inputForm" value="<?= $dates["nombre"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" maxlength="100" class="inputForm" value="<?= $dates["apellidos"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" maxlength="100" class="inputForm" value="<?= $dates["email"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="movil">Móvil</label>
        <input type="tel" name="movil" id="movil" class="inputForm" value="<?= $dates["movil"] ?>">
    </div>
    <div class="rowFull d-flex">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" maxlength="500" class="inputForm" value="<?= $dates["direccion"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" maxlength="50" class="inputForm" value="<?= $dates["ciudad"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia" maxlength="50" class="inputForm" value="<?= $dates["provincia"] ?>">
    </div>
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="rowSubmit d-flex space-end">
        <input type="submit" name="submitUpdate" id="submitUpdate" value="Guardar" class="button">
    </div>
</form>