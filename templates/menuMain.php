<div id="menuMov">
    <div class="d-flex space-end">
        <svg id="closeMenuMov" fill="#737373" width="25px" height="25px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
            <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z" />
        </svg>
    </div>
    <?php if (isset($id)) {  ?>
        <a href="/cuenta" class="itemsCenter nameMenu">
            <h3>Hola <span><?= $nombre ?></span></h3>
        </a>
    <?php } ?>
    <div id="tiendaMenuMov">
        <?php botones_categorias($con) ?>
    </div>

    <?php if (isset($id)) {  ?>
        <ul id="cuentaMenuMov">
            <li><a href="/cuenta">Mi cuenta</a></li>
            <li class="discIcon">
                <a href="../controllers/usuarios/logout_controller.php">
                    <svg width="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.00098 11.999L16.001 11.999M16.001 11.999L12.501 8.99902M16.001 11.999L12.501 14.999" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.3531 21.8897 19.1752 21.9862 17 21.9983M9.00195 17C9.01406 19.175 9.11051 20.3529 9.87889 21.1213C10.5202 21.7626 11.4467 21.9359 13 21.9827" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </a>
            </li>
        </ul>
    <?php } else { ?>
        <ul id="cuentaMenuMov">
            <li><a href="/login">Iniciar sesión</a></li>
        </ul>
    <?php } ?>

</div>
<div id="blackGround" class="<?php if(isset($_GET["cart"])){ ?>d-block<?php } ?>"></div>