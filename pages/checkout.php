<?php
require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

require '../config/carrito.php';

//Si no existe el carrito o está vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header("Location: /error?error=Tienes el carrito vacío.");
    exit;
}

seguridad(false, 0, $rol ?? -1);

require '../controllers/usuarios/usuarios_controllers.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/checkout.css">
    <link rel="icon" href="/media/favicon.PNG">
    <script type="module" src="/js/checkout.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AbJdy91OXtflOfZCOFKw2ya5KvfPogmA9eLQtAL1jNlXEy1XmddfMAx5nBknQDqACP0f7BVm4PooSVnF&currency=EUR"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <div id="datesWrap">
                <h2>1. Productos</h2>
                <div id="carrito" class="container hiddenContainer">
                    <?php productos_sesion($con, $carrito); ?>
                    <div class="buttonWrap">
                        <button id="buttonCarrito" class="button">Continuar</button>
                    </div>
                </div>
                <h2>2. Información de pedido</h2>
                <div id="personalInfo" class="container hiddenContainer">
                    <?php if (isset($id)) {
                        checkout_usuario($con, $id);
                    } else { ?>
                        <div id="loginWrap" class="formWrap d-none">
                            <form id="loginForm" method="post" class="formMain d-flex">
                                <div class="rowForm">
                                    <label for="emailUser">Correo electrónico*</label>
                                    <input type="email" name="email" id="emailUser" class="inputForm">
                                </div>
                                <div class="rowForm">
                                    <label for="passwordUser">Contraseña*</label>
                                    <div class="inputForm">
                                        <input type="password" name="password" id="passwordUser" class="password">
                                        <span class="showPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#222222">
                                                <path d="M2.68936 6.70456C2.52619 6.32384 2.08528 6.14747 1.70456 6.31064C1.32384 6.47381 1.14747 6.91472 1.31064 7.29544L2.68936 6.70456ZM15.5872 13.3287L15.3125 12.6308L15.5872 13.3287ZM9.04145 13.7377C9.26736 13.3906 9.16904 12.926 8.82185 12.7001C8.47466 12.4742 8.01008 12.5725 7.78417 12.9197L9.04145 13.7377ZM6.37136 15.091C6.14545 15.4381 6.24377 15.9027 6.59096 16.1286C6.93815 16.3545 7.40273 16.2562 7.62864 15.909L6.37136 15.091ZM22.6894 7.29544C22.8525 6.91472 22.6762 6.47381 22.2954 6.31064C21.9147 6.14747 21.4738 6.32384 21.3106 6.70456L22.6894 7.29544ZM19 11.1288L18.4867 10.582V10.582L19 11.1288ZM19.9697 13.1592C20.2626 13.4521 20.7374 13.4521 21.0303 13.1592C21.3232 12.8663 21.3232 12.3914 21.0303 12.0985L19.9697 13.1592ZM11.25 16.5C11.25 16.9142 11.5858 17.25 12 17.25C12.4142 17.25 12.75 16.9142 12.75 16.5H11.25ZM16.3714 15.909C16.5973 16.2562 17.0619 16.3545 17.409 16.1286C17.7562 15.9027 17.8545 15.4381 17.6286 15.091L16.3714 15.909ZM5.53033 11.6592C5.82322 11.3663 5.82322 10.8914 5.53033 10.5985C5.23744 10.3056 4.76256 10.3056 4.46967 10.5985L5.53033 11.6592ZM2.96967 12.0985C2.67678 12.3914 2.67678 12.8663 2.96967 13.1592C3.26256 13.4521 3.73744 13.4521 4.03033 13.1592L2.96967 12.0985ZM12 13.25C8.77611 13.25 6.46133 11.6446 4.9246 9.98966C4.15645 9.16243 3.59325 8.33284 3.22259 7.71014C3.03769 7.3995 2.90187 7.14232 2.8134 6.96537C2.76919 6.87696 2.73689 6.80875 2.71627 6.76411C2.70597 6.7418 2.69859 6.7254 2.69411 6.71533C2.69187 6.7103 2.69036 6.70684 2.68957 6.70503C2.68917 6.70413 2.68896 6.70363 2.68892 6.70355C2.68891 6.70351 2.68893 6.70357 2.68901 6.70374C2.68904 6.70382 2.68913 6.70403 2.68915 6.70407C2.68925 6.7043 2.68936 6.70456 2 7C1.31064 7.29544 1.31077 7.29575 1.31092 7.29609C1.31098 7.29624 1.31114 7.2966 1.31127 7.2969C1.31152 7.29749 1.31183 7.2982 1.31218 7.299C1.31287 7.30062 1.31376 7.30266 1.31483 7.30512C1.31698 7.31003 1.31988 7.31662 1.32353 7.32483C1.33083 7.34125 1.34115 7.36415 1.35453 7.39311C1.38127 7.45102 1.42026 7.5332 1.47176 7.63619C1.57469 7.84206 1.72794 8.13175 1.93366 8.47736C2.34425 9.16716 2.96855 10.0876 3.8254 11.0103C5.53867 12.8554 8.22389 14.75 12 14.75V13.25ZM15.3125 12.6308C14.3421 13.0128 13.2417 13.25 12 13.25V14.75C13.4382 14.75 14.7246 14.4742 15.8619 14.0266L15.3125 12.6308ZM7.78417 12.9197L6.37136 15.091L7.62864 15.909L9.04145 13.7377L7.78417 12.9197ZM22 7C21.3106 6.70456 21.3107 6.70441 21.3108 6.70427C21.3108 6.70423 21.3108 6.7041 21.3109 6.70402C21.3109 6.70388 21.311 6.70376 21.311 6.70368C21.3111 6.70352 21.3111 6.70349 21.3111 6.7036C21.311 6.7038 21.3107 6.70452 21.3101 6.70576C21.309 6.70823 21.307 6.71275 21.3041 6.71924C21.2983 6.73223 21.2889 6.75309 21.2758 6.78125C21.2495 6.83757 21.2086 6.92295 21.1526 7.03267C21.0406 7.25227 20.869 7.56831 20.6354 7.9432C20.1669 8.69516 19.4563 9.67197 18.4867 10.582L19.5133 11.6757C20.6023 10.6535 21.3917 9.56587 21.9085 8.73646C22.1676 8.32068 22.36 7.9668 22.4889 7.71415C22.5533 7.58775 22.602 7.48643 22.6353 7.41507C22.6519 7.37939 22.6647 7.35118 22.6737 7.33104C22.6782 7.32097 22.6818 7.31292 22.6844 7.30696C22.6857 7.30398 22.6867 7.30153 22.6876 7.2996C22.688 7.29864 22.6883 7.29781 22.6886 7.29712C22.6888 7.29677 22.6889 7.29646 22.689 7.29618C22.6891 7.29604 22.6892 7.29585 22.6892 7.29578C22.6893 7.29561 22.6894 7.29544 22 7ZM18.4867 10.582C17.6277 11.3882 16.5739 12.1343 15.3125 12.6308L15.8619 14.0266C17.3355 13.4466 18.5466 12.583 19.5133 11.6757L18.4867 10.582ZM18.4697 11.6592L19.9697 13.1592L21.0303 12.0985L19.5303 10.5985L18.4697 11.6592ZM11.25 14V16.5H12.75V14H11.25ZM14.9586 13.7377L16.3714 15.909L17.6286 15.091L16.2158 12.9197L14.9586 13.7377ZM4.46967 10.5985L2.96967 12.0985L4.03033 13.1592L5.53033 11.6592L4.46967 10.5985Z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="rememberWrap">
                                    <input type="checkbox" id="remember" name="remember" class="inputForm">
                                    <label for="remember" class="remLabel">Recúerdame</label>
                                </div>
                                <div class="anclaPassLost"><a href="/recuperar-contrasena">¿Has olvidado tu contraseña?</a></div>
                                <div class="rowForm">
                                    <input type="submit" name="submit" id="submitLogin" value="Inicia sesión" class="button">
                                </div>
                            </form>
                            <div id="anclaRegister" class="anclaLoginRegister">¿No tienes cuenta? Regístrate</div>
                        </div>
                        <div id="registerWrap" class="formWrap">
                            <form id="registerForm" method="post" class="formMain d-flex">
                                <div class="rowForm">
                                    <label for="nameReg">Nombre*</label>
                                    <input type="text" name="nombre" id="nameReg" class="inputForm">
                                </div>
                                <div class="rowForm">
                                    <label for="nameReg">Apellidos*</label>
                                    <input type="text" name="apellidos" id="apelReg" class="inputForm">
                                </div>
                                <div class="rowForm">
                                    <label for="emailReg">Correo electrónico*</label>
                                    <input type="email" name="email" id="emailReg" class="inputForm">
                                </div>
                                <div class="rowForm">
                                    <label for="movilReg">Móvil*</label>
                                    <input type="tel" name="movil" id="movilReg" class="inputForm">
                                </div>
                                <div class="rowForm">
                                    <label for="passwordReg">Contraseña*</label>
                                    <div class="inputForm">
                                        <input type="password" name="password" id="passwordReg" class="password">
                                        <span class="showPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#222222">
                                                <path d="M2.68936 6.70456C2.52619 6.32384 2.08528 6.14747 1.70456 6.31064C1.32384 6.47381 1.14747 6.91472 1.31064 7.29544L2.68936 6.70456ZM15.5872 13.3287L15.3125 12.6308L15.5872 13.3287ZM9.04145 13.7377C9.26736 13.3906 9.16904 12.926 8.82185 12.7001C8.47466 12.4742 8.01008 12.5725 7.78417 12.9197L9.04145 13.7377ZM6.37136 15.091C6.14545 15.4381 6.24377 15.9027 6.59096 16.1286C6.93815 16.3545 7.40273 16.2562 7.62864 15.909L6.37136 15.091ZM22.6894 7.29544C22.8525 6.91472 22.6762 6.47381 22.2954 6.31064C21.9147 6.14747 21.4738 6.32384 21.3106 6.70456L22.6894 7.29544ZM19 11.1288L18.4867 10.582V10.582L19 11.1288ZM19.9697 13.1592C20.2626 13.4521 20.7374 13.4521 21.0303 13.1592C21.3232 12.8663 21.3232 12.3914 21.0303 12.0985L19.9697 13.1592ZM11.25 16.5C11.25 16.9142 11.5858 17.25 12 17.25C12.4142 17.25 12.75 16.9142 12.75 16.5H11.25ZM16.3714 15.909C16.5973 16.2562 17.0619 16.3545 17.409 16.1286C17.7562 15.9027 17.8545 15.4381 17.6286 15.091L16.3714 15.909ZM5.53033 11.6592C5.82322 11.3663 5.82322 10.8914 5.53033 10.5985C5.23744 10.3056 4.76256 10.3056 4.46967 10.5985L5.53033 11.6592ZM2.96967 12.0985C2.67678 12.3914 2.67678 12.8663 2.96967 13.1592C3.26256 13.4521 3.73744 13.4521 4.03033 13.1592L2.96967 12.0985ZM12 13.25C8.77611 13.25 6.46133 11.6446 4.9246 9.98966C4.15645 9.16243 3.59325 8.33284 3.22259 7.71014C3.03769 7.3995 2.90187 7.14232 2.8134 6.96537C2.76919 6.87696 2.73689 6.80875 2.71627 6.76411C2.70597 6.7418 2.69859 6.7254 2.69411 6.71533C2.69187 6.7103 2.69036 6.70684 2.68957 6.70503C2.68917 6.70413 2.68896 6.70363 2.68892 6.70355C2.68891 6.70351 2.68893 6.70357 2.68901 6.70374C2.68904 6.70382 2.68913 6.70403 2.68915 6.70407C2.68925 6.7043 2.68936 6.70456 2 7C1.31064 7.29544 1.31077 7.29575 1.31092 7.29609C1.31098 7.29624 1.31114 7.2966 1.31127 7.2969C1.31152 7.29749 1.31183 7.2982 1.31218 7.299C1.31287 7.30062 1.31376 7.30266 1.31483 7.30512C1.31698 7.31003 1.31988 7.31662 1.32353 7.32483C1.33083 7.34125 1.34115 7.36415 1.35453 7.39311C1.38127 7.45102 1.42026 7.5332 1.47176 7.63619C1.57469 7.84206 1.72794 8.13175 1.93366 8.47736C2.34425 9.16716 2.96855 10.0876 3.8254 11.0103C5.53867 12.8554 8.22389 14.75 12 14.75V13.25ZM15.3125 12.6308C14.3421 13.0128 13.2417 13.25 12 13.25V14.75C13.4382 14.75 14.7246 14.4742 15.8619 14.0266L15.3125 12.6308ZM7.78417 12.9197L6.37136 15.091L7.62864 15.909L9.04145 13.7377L7.78417 12.9197ZM22 7C21.3106 6.70456 21.3107 6.70441 21.3108 6.70427C21.3108 6.70423 21.3108 6.7041 21.3109 6.70402C21.3109 6.70388 21.311 6.70376 21.311 6.70368C21.3111 6.70352 21.3111 6.70349 21.3111 6.7036C21.311 6.7038 21.3107 6.70452 21.3101 6.70576C21.309 6.70823 21.307 6.71275 21.3041 6.71924C21.2983 6.73223 21.2889 6.75309 21.2758 6.78125C21.2495 6.83757 21.2086 6.92295 21.1526 7.03267C21.0406 7.25227 20.869 7.56831 20.6354 7.9432C20.1669 8.69516 19.4563 9.67197 18.4867 10.582L19.5133 11.6757C20.6023 10.6535 21.3917 9.56587 21.9085 8.73646C22.1676 8.32068 22.36 7.9668 22.4889 7.71415C22.5533 7.58775 22.602 7.48643 22.6353 7.41507C22.6519 7.37939 22.6647 7.35118 22.6737 7.33104C22.6782 7.32097 22.6818 7.31292 22.6844 7.30696C22.6857 7.30398 22.6867 7.30153 22.6876 7.2996C22.688 7.29864 22.6883 7.29781 22.6886 7.29712C22.6888 7.29677 22.6889 7.29646 22.689 7.29618C22.6891 7.29604 22.6892 7.29585 22.6892 7.29578C22.6893 7.29561 22.6894 7.29544 22 7ZM18.4867 10.582C17.6277 11.3882 16.5739 12.1343 15.3125 12.6308L15.8619 14.0266C17.3355 13.4466 18.5466 12.583 19.5133 11.6757L18.4867 10.582ZM18.4697 11.6592L19.9697 13.1592L21.0303 12.0985L19.5303 10.5985L18.4697 11.6592ZM11.25 14V16.5H12.75V14H11.25ZM14.9586 13.7377L16.3714 15.909L17.6286 15.091L16.2158 12.9197L14.9586 13.7377ZM4.46967 10.5985L2.96967 12.0985L4.03033 13.1592L5.53033 11.6592L4.46967 10.5985Z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="checkWrap">
                                    <input type="checkbox" name="checkboxR" id="checkboxR" class="inputForm">
                                    <label for="checkboxR" class="checkLabel">Acepto <a href="#">los términos y condiciones</a>.</label>
                                </div>
                                <div class="rowSubmit">
                                    <input type="submit" name="submitAnterior" id="returnProductos" value="Productos" class="anteriorButton button">
                                    <input type="submit" name="submitReg" id="submitReg" value="Registrarse" class="button">
                                </div>
                            </form>
                            <div id="anclaLogin" class="anclaLoginRegister">¿Ya tienes una cuenta? Inicia sesión</div>
                        </div>
                    <?php } ?>
                </div>
                <h2>3. Método de pago</h2>
                <div id="payments" class="container hiddenContainer">
                    <div class="paymentsWrap ">
                        <div class="payment d-flex">
                            <input type="radio" id="paypal" name="payment" value="paypal">
                            <label for="paypal">
                                <img src="/media/paypal.png" alt="">
                            </label>
                        </div>
                        <div class="payment d-flex">
                            <input type="radio" id="stripe" name="payment" value="stripe">
                            <label for="stripe">
                                <img src="/media/stripe.png" alt="">
                            </label>
                        </div>
                    </div>
                    <div class="rowSubmit">
                        <button id="returnPersonalInfo" class="anteriorButton button">Info. pedido</button>
                        <button id="submitPayment" class="button">Continuar</button>
                    </div>
                </div>
                <h2>4. Comprar</h2>
                <form id="purchase" class="container " method="POST">
                    <div class="rowSubmit">
                        <button id="returnPayment" class="anteriorButton button">Método de pago</button>
                    </div>
                    <?php
                    //Vamos a calcular el importe total de la compra
                    $envio = $precioProductos >= 150 ? 0 : 5;
                    $importe = $precioProductos + $envio;
                    ?>

                    <div class="rowImport d-flex space-between">
                        <label for="pricePurchase">Importe total</label>
                        <div class="d-flex space-end">
                            <input type="text" name="importe" id="pricePurchase" readonly class="mainPrice" value="<?= $importe ?>">
                            €
                        </div>
                    </div>
                    <div class="checkboxWrap">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <label for="checkbox">He leído y acepto el <a href="#">Aviso Legal y Cookies</a>, la <a href="#">Política de Privacidad</a> y <a href="#">Envíos y Devoluciones</a>.</label>
                    </div>
                    <input type="hidden" name="usuario" id="usuario" value="<?= $id ?>">
                    <input type="hidden" name="metodoPago" id="metodoPago">
                    <!-- <input type="submit" id="prueba"> -->
                    <div id="paypalWrap" name="paypal" class="buttonPayWrap d-none"></div>
                    <div id="stripeWrap" name="stripe" class="buttonPayWrap">
                        <div id="card-element"></div>
                        <button id="submitStripe" class="buttonStripe itemsCenter">
                            <img src="/media/stripe.png" alt="">
                        </button>
                    </div>
                </form>
            </div>
            <aside id="resumeWrap" class="none-md">
                <div class="purchaseDates d-flex">
                    <span>Productos:</span>
                    <span id="priceProducts" class="mainPrice"><?= $precioProductos ?>€</span>
                </div>
                <div id="descWrap" class="purchaseDates d-flex hidden">
                    <span>Descuento:</span>
                    <span id="discount"></span>
                </div>
                <div class="purchaseDates d-flex">
                    <span>Envío:</span>
                    <span id="deliverCost"><?= $envio ?>€</span>
                </div>
                <div class="purchaseDates d-flex">
                    <h5>Importe total:</h5>
                    <h5 id="totalImport" class="mainPrice"><?= $importe ?>€</h5>
                </div>
                <p class="ivaInfo">*Envíos gratuitos a partir de 150€</p>
            </aside>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
    <script type="module" src="/js/stripe.js"></script>                  
    <!-- <script type="module" src="/js/paypal.js"></script>                   -->
</body>

</html>