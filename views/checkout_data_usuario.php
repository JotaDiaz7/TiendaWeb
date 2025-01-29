<form id="updateForm" method="post" class="formMain d-flex">
    <div class="rowForm">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="inputForm" value="<?= $dates['nombre'] ?>">
    </div>
    <div class="rowForm">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" class="inputForm" value="<?= $dates['apellidos'] ?>">
    </div>
    <div class="rowForm">
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" class="inputForm" value="<?= $dates['email'] ?>">
    </div>
    <div class="rowForm">
        <label for="movil">Móvil</label>
        <input type="tel" name="movil" id="movil" class="inputForm" value="<?= $dates['movil'] ?>">
    </div>
    <div class="rowFull">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" class="inputForm" value="<?= $dates['direccion'] ?>">
    </div>
    <div class="rowForm">
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" class="inputForm" value="<?= $dates['ciudad'] ?>">
    </div>
    <div class="rowForm">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia" class="inputForm" value="<?= $dates['provincia'] ?>">
    </div>
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="rowSubmit">
        <input type="submit" name="submitAnterior" id="returnProductos" value="Productos" class="anteriorButton button">
        <input type="submit" name="submitUpdate" id="submitUpdate" value="Guardar y continuar" class="button">
    </div>
</form>