<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1, $rol ?? -1);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/registro-admin.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="../js/registro-admin.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section class="md30">
            <h1>Registrar producto</h1>
        </section>
        <section class="mainWrap d-flex">
            <div id="wrapDates">
                <form id="register" method="post" class="formMain d-flex space-between align-center">
                    <div id="dates" class="d-flex space-between">
                        <div class="rowForm">
                            <label for="nombre">Nombre*</label>
                            <input type="text" name="nombre" class="inputForm" placeholder="Nombre">
                        </div>
                        <div class="rowForm">
                            <label for="categoria">Categoría*</label>
                            <select name="categoria" class="inputForm">
                                <?php opciones_categorias($con, "child") ?>
                            </select>
                        </div>
                        <div class="rowForm">
                            <label for="precio">Precio*</label>
                            <input type="text" name="precio" class="inputForm ">
                        </div>
                    </div>
                    <label>Imágenes</label>
                    <div id="imgsWrap" class="itemsCenter">
                        <div class="imgWrap">
                            <button>
                                <svg fill="#737373" width="20px" height="20px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
                                </svg>
                            </button>
                            <img class="imgProd" src="">
                            <input type="file" name="img1" aria-label="Archivo" class="hidden inputImg cleanInput" accept="image/*">
                        </div>
                        <div class="imgWrap">
                            <button>
                                <svg fill="#737373" width="20px" height="20px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
                                </svg>
                            </button>
                            <img class="imgProd" src="">
                            <input type="file" name="img2" aria-label="Archivo" class="hidden inputImg cleanInput" accept="image/*">
                        </div>
                        <div class="imgWrap">
                            <button>
                                <svg fill="#737373" width="20px" height="20px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
                                </svg>
                            </button>
                            <img class="imgProd" src="">
                            <input type="file" name="img3" aria-label="Archivo" class="hidden inputImg cleanInput" accept="image/*">
                        </div>
                        <div class="imgWrap">
                            <button>
                                <svg fill="#737373" width="20px" height="20px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
                                </svg>
                            </button>
                            <img class="imgProd" src="">
                            <input type="file" name="img4" aria-label="Archivo" class="hidden inputImg cleanInput" accept="image/*">
                        </div>
                    </div>
                    <div id="info">
                        <div class="rowForm">
                            <label for="descripcion">Descripción*</label>
                            <textarea name="descripcion" id="descripcion"></textarea>
                        </div>
                    </div>
                    <div class=" hidden">
                        <input type="checkbox" name="honeyPot" class="inputForm">
                    </div>
                    <div class="rowSubmit itemsCenter">
                        <input type="submit" id="submit" name="submit" value="Registrar" class="button">
                    </div>
                </form>
            </div>
        </section>
        <section>
            <a href="/admin/productos">Ver todos los productos</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>