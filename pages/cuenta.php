<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 0, $rol ?? -1);

require '../config/carrito.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/cuenta.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="../js/cuenta.js"></script>
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1>Hola <strong><?= $nombre ?></strong></h1>
        </section>
        <section class="iconMenuWrap">
            <div class="iconMenuCuenta">
                <a href="/mi-perfil" class="itemsCenter">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="6" r="4" stroke="#222222" stroke-width="1.5" />
                        <path d="M18.0429 12.3656L18.4865 11.7609L18.4865 11.7609L18.0429 12.3656ZM19 8.69135L18.4813 9.23307C18.7713 9.51077 19.2287 9.51077 19.5187 9.23307L19 8.69135ZM19.9571 12.3656L19.5135 11.7609L19.5135 11.7609L19.9571 12.3656ZM19 12.8276L19 13.5776H19L19 12.8276ZM18.4865 11.7609C18.0686 11.4542 17.6081 11.0712 17.2595 10.6681C16.8912 10.2423 16.75 9.91131 16.75 9.69673H15.25C15.25 10.4666 15.6912 11.1479 16.1249 11.6493C16.5782 12.1735 17.1391 12.6327 17.5992 12.9703L18.4865 11.7609ZM16.75 9.69673C16.75 9.12068 17.0126 8.87002 17.2419 8.78964C17.4922 8.70189 17.9558 8.72986 18.4813 9.23307L19.5187 8.14963C18.6943 7.36028 17.6579 7.05432 16.7457 7.3741C15.8125 7.70123 15.25 8.59955 15.25 9.69673H16.75ZM20.4008 12.9703C20.8609 12.6327 21.4218 12.1735 21.8751 11.6493C22.3088 11.1479 22.75 10.4666 22.75 9.69672H21.25C21.25 9.91132 21.1088 10.2424 20.7405 10.6681C20.3919 11.0713 19.9314 11.4542 19.5135 11.7609L20.4008 12.9703ZM22.75 9.69672C22.75 8.59954 22.1875 7.70123 21.2543 7.37409C20.3421 7.05432 19.3057 7.36028 18.4813 8.14963L19.5187 9.23307C20.0442 8.72986 20.5078 8.70189 20.7581 8.78964C20.9874 8.87002 21.25 9.12068 21.25 9.69672H22.75ZM17.5992 12.9703C17.9678 13.2407 18.3816 13.5776 19 13.5776L19 12.0776C18.9756 12.0776 18.9605 12.0775 18.9061 12.0488C18.8202 12.0034 18.7128 11.9269 18.4865 11.7609L17.5992 12.9703ZM19.5135 11.7609C19.2872 11.9269 19.1798 12.0034 19.0939 12.0488C19.0395 12.0775 19.0244 12.0776 19 12.0776L19 13.5776C19.6184 13.5776 20.0322 13.2407 20.4008 12.9703L19.5135 11.7609Z" fill="#222222" />
                        <path d="M17.9975 18C18 17.8358 18 17.669 18 17.5C18 15.0147 14.4183 13 10 13C5.58172 13 2 15.0147 2 17.5C2 19.9853 2 22 10 22C12.231 22 13.8398 21.8433 15 21.5634" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <h4>Mi perfil</h4>
                </a>
            </div>
            <div class="iconMenuCuenta">
                <a href="/pedidos" class="itemsCenter">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 14L17 14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M7 14H7.5" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M7 10.5H7.5" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M7 17.5H7.5" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M10.5 10.5H17" stroke="#222222C" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M10.5 17.5H17" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M8 3.5C8 2.67157 8.67157 2 9.5 2H14.5C15.3284 2 16 2.67157 16 3.5V4.5C16 5.32843 15.3284 6 14.5 6H9.5C8.67157 6 8 5.32843 8 4.5V3.5Z" stroke="#222222" stroke-width="1.5" />
                        <path d="M21 16.0002C21 18.8286 21 20.2429 20.1213 21.1215C19.2426 22.0002 17.8284 22.0002 15 22.0002H9C6.17157 22.0002 4.75736 22.0002 3.87868 21.1215C3 20.2429 3 18.8286 3 16.0002V13.0002M16 4.00195C18.175 4.01406 19.3529 4.11051 20.1213 4.87889C21 5.75757 21 7.17179 21 10.0002V12.0002M8 4.00195C5.82497 4.01406 4.64706 4.11051 3.87868 4.87889C3.11032 5.64725 3.01385 6.82511 3.00174 9" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <h4>Pedidos</h4>
                </a>
            </div>
            <div class="iconMenuCuenta">
                <a href="/devoluciones" class="itemsCenter">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path d="M6 8L10.125 4M6 8L10.125 12M6 8L13 8M18 8H16" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18 16L13.875 12M18 16L13.875 20M18 16L11 16M6 16H8" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </svg>
                    <h4>Devoluciones</h4>
                </a>
            </div>
            <div class="iconMenuCuenta">
                <a href="../controllers/usuarios/logout_controller.php" class="itemsCenter discIcon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.00098 11.999L16.001 11.999M16.001 11.999L12.501 8.99902M16.001 11.999L12.501 14.999" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.3531 21.8897 19.1752 21.9862 17 21.9983M9.00195 17C9.01406 19.175 9.11051 20.3529 9.87889 21.1213C10.5202 21.7626 11.4467 21.9359 13 21.9827" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <h4>Salir</h4>
                </a>
            </div>
        </section>
    </main>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/carrito.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>