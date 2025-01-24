<form id="update" method="post" class="formMain d-flex space-between align-center">
    <div id="imgsWrap" class="itemsCenter">
        <div class="imgWrap">
            <a href="/controllers/productos/borrar_img_controller.php?id=<?= $dates["id"] ?>&img=img1&nombre=<?= $dates["img1"] ?>">
                <svg fill="#737373" width="20px" height="20px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
                </svg>
            </a>
            <img class="imgProd" src="../../media/productos/<?= $dates["img1"] ?>">
            <input type="file" name="img1" aria-label="Archivo" class="hidden inputImg cleanInput" accept="image/*">
            <input type="hidden" name="img1" value="<?= $dates["img1"] ?>">
        </div>
        <div class="imgWrap">
            <a href="/controllers/productos/borrar_img_controller.php?id=<?= $dates["id"] ?>&img=img2&nombre=<?= $dates["img2"] ?>">
                <svg fill="#737373" width="20px" height="20px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
                </svg>
            </a>
            <img class="imgProd" src="../../media/productos/<?= $dates["img2"] ?>">
            <input type="file" name="img2" aria-label="Archivo" class="hidden inputImg cleanInput" accept="image/*">
            <input type="hidden" name="img2" value="<?= $dates["img2"] ?>">
        </div>
        <div class="imgWrap">
            <a href="/controllers/productos/borrar_img_controller.php?id=<?= $dates["id"] ?>&img=img3&nombre=<?= $dates["img3"] ?>">
                <svg fill="#737373" width="20px" height="20px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
                </svg>
            </a>
            <img class="imgProd" src="../../media/productos/<?= $dates["img3"] ?>">
            <input type="file" name="img3" aria-label="Archivo" class="hidden inputImg cleanInput" accept="image/*">
            <input type="hidden" name="img3" value="<?= $dates["img3"] ?>">
        </div>
        <div class="imgWrap">
            <a href="/controllers/productos/borrar_img_controller.php?id=<?= $dates["id"] ?>&img=img4&nombre=<?= $dates["img4"] ?>">
                <svg fill="#737373" width="20px" height="20px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
                </svg>
            </a>
            <img class="imgProd" src="../../media/productos/<?= $dates["img4"] ?>">
            <input type="file" name="img4" aria-label="Archivo" class="hidden inputImg cleanInput" accept="image/*">
            <input type="hidden" name="img4" value="<?= $dates["img4"] ?>">
        </div>
    </div>
    <div class="rowForm d-flex">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" maxlength="50" class="inputForm" value="<?= $dates["nombre"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="categoria">Categoría</label>
        <select name="categoria" class="inputForm">
            <option value="<?= $dates["categoria"] ?>" select><?= $dates["categoria"] ?></option>
            <?php opciones_categorias($con, "child") ?>
        </select>
    </div>
    <div class="rowForm d-flex">
        <label for="precio">Precio</label>
        <input type="text" name="precio" class="inputForm " value="<?= $dates["precio"] ?>">
    </div>
    <div class="rowForm d-flex">
        <label for="descuento">Descuento</label>
        <select name="descuento" class="inputForm">
            <?php if (empty($dates["descuento"])) { ?>
                <option value="<?= $dates["descuento"] ?>" select><?= $dates["descuento"] ?></option>
            <?php } else { ?>
                <option value="<?= $dates["descuento"] ?>" select><?= $dates["descuento"] ?></option>
                <option value=""></option>
            <?php } ?>
            <?php listar_descuentos($con, true) ?>
        </select>
    </div>
    <div class="rowFull d-flex">
        <label for="descripcion">Descripción*</label>
        <textarea name="descripcion" id="descripcion"><?= $dates["descripcion"] ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="rowSubmit d-flex space-end">
        <input type="submit" name="submit" id="submitUpdate" value="Guardar" class="button">
    </div>
</form>