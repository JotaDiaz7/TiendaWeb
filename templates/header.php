<?php
//Vamos a crearnos funciones para saber la url de la página en la que nos encontramos en ese momento
$url_actual = basename($_SERVER['REQUEST_URI']);

function noCarritoPage()
{
    global $url_actual;
    $pages = ['compra', 'checkout', 'checkout-devolucion'];

    // Recorremos el array y comprobamos si alguna página está en la URL
    foreach ($pages as $page) {
        if (strpos($url_actual, $page) !== false) {
            return true;
        }
    }
}

function loginPage()
{
    global $url_actual;
    return strpos($url_actual, 'login') !== false;
}

function cuentaPage()
{
    global $url_actual;
    $pages = ['cuenta', 'mi-perfil', 'pedidos'];

    // Recorremos el array y comprobamos si alguna página está en la URL
    foreach ($pages as $page) {
        if (strpos($url_actual, $page) !== false) {
            return true;
        }
    }
}
?>
<header class="d-flex">
    <div id="menuWrap">
        <button id="buttonMenuMov">
            <svg width="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g stroke-width="0" />
                <g stroke-linecap="round" stroke-linejoin="round" />
                <g>
                    <path d="M4 7L7 7M20 7L11 7" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M20 17H17M4 17L13 17" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M4 12H7L20 12" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                </g>
            </svg>
        </button>
    </div>
    <div id="logoWrap" class="itemsCenter">
        <a href="/" id="logoAncla">
            <img id="logo" src="/media/logo.PNG" alt="La madriguera logo" title="La madriguera, productos respetuosos">
        </a>
    </div>
    <div id="mainIcons" class="d-flex align-center space-end">
        <?php
        if (isset($usuario) && $rol != 0) { ?>
            <button id="admin" class="buttonIcons">
                <a href="/admin/administracion">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <circle cx="12" cy="12" r="3" stroke="#222222" stroke-width="1.5" />
                            <path d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        </g>
                    </svg>
                </a>
            </button>
            <?php } else if (!loginPage()) {
            if (isset($usuario)) {
                if (!cuentaPage()) {
            ?>
                    <button id="user" class="buttonUser none-s">
                        <a href="/cuenta">
                            <span>Hola <?= $nombre ?></span>
                            <p>Mi cuenta</p>
                        </a>
                    </button>
                    <button id="userMov" class="buttonIcons none-xmd">
                        <a href="/cuenta">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10" cy="6" r="4" stroke="#222222" stroke-width="1.5" />
                                <path d="M18.0429 12.3656L18.4865 11.7609L18.4865 11.7609L18.0429 12.3656ZM19 8.69135L18.4813 9.23307C18.7713 9.51077 19.2287 9.51077 19.5187 9.23307L19 8.69135ZM19.9571 12.3656L19.5135 11.7609L19.5135 11.7609L19.9571 12.3656ZM19 12.8276L19 13.5776H19L19 12.8276ZM18.4865 11.7609C18.0686 11.4542 17.6081 11.0712 17.2595 10.6681C16.8912 10.2423 16.75 9.91131 16.75 9.69673H15.25C15.25 10.4666 15.6912 11.1479 16.1249 11.6493C16.5782 12.1735 17.1391 12.6327 17.5992 12.9703L18.4865 11.7609ZM16.75 9.69673C16.75 9.12068 17.0126 8.87002 17.2419 8.78964C17.4922 8.70189 17.9558 8.72986 18.4813 9.23307L19.5187 8.14963C18.6943 7.36028 17.6579 7.05432 16.7457 7.3741C15.8125 7.70123 15.25 8.59955 15.25 9.69673H16.75ZM20.4008 12.9703C20.8609 12.6327 21.4218 12.1735 21.8751 11.6493C22.3088 11.1479 22.75 10.4666 22.75 9.69672H21.25C21.25 9.91132 21.1088 10.2424 20.7405 10.6681C20.3919 11.0713 19.9314 11.4542 19.5135 11.7609L20.4008 12.9703ZM22.75 9.69672C22.75 8.59954 22.1875 7.70123 21.2543 7.37409C20.3421 7.05432 19.3057 7.36028 18.4813 8.14963L19.5187 9.23307C20.0442 8.72986 20.5078 8.70189 20.7581 8.78964C20.9874 8.87002 21.25 9.12068 21.25 9.69672H22.75ZM17.5992 12.9703C17.9678 13.2407 18.3816 13.5776 19 13.5776L19 12.0776C18.9756 12.0776 18.9605 12.0775 18.9061 12.0488C18.8202 12.0034 18.7128 11.9269 18.4865 11.7609L17.5992 12.9703ZM19.5135 11.7609C19.2872 11.9269 19.1798 12.0034 19.0939 12.0488C19.0395 12.0775 19.0244 12.0776 19 12.0776L19 13.5776C19.6184 13.5776 20.0322 13.2407 20.4008 12.9703L19.5135 11.7609Z" fill="#222222" />
                                <path d="M17.9975 18C18 17.8358 18 17.669 18 17.5C18 15.0147 14.4183 13 10 13C5.58172 13 2 15.0147 2 17.5C2 19.9853 2 22 10 22C12.231 22 13.8398 21.8433 15 21.5634" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </a>
                    </button>
                <?php } else { ?>
                    <a href="../controllers/usuarios/logout_controller.php" class="buttonIcons discIcon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.00098 11.999L16.001 11.999M16.001 11.999L12.501 8.99902M16.001 11.999L12.501 14.999" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.3531 21.8897 19.1752 21.9862 17 21.9983M9.00195 17C9.01406 19.175 9.11051 20.3529 9.87889 21.1213C10.5202 21.7626 11.4467 21.9359 13 21.9827" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </a>

                <?php } ?>
            <?php } else { ?>
                <button id="user" class="buttonIcons">
                    <a href="/login">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="6" r="4" stroke="#222222" stroke-width="1.5" />
                            <path d="M19.9975 18C20 17.8358 20 17.669 20 17.5C20 15.0147 16.4183 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C14.231 22 15.8398 21.8433 17 21.5634" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </a>
                </button>
            <?php }

            if (!noCarritoPage()) {
            ?>
                <button id="shopBag" class="buttonIcons">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.2236 12.5257C19.6384 9.40452 19.3458 7.84393 18.2349 6.92196C17.124 6 15.5362 6 12.3606 6H11.6394C8.46386 6 6.87608 6 5.76518 6.92196C4.65428 7.84393 4.36167 9.40452 3.77645 12.5257C2.95353 16.9146 2.54207 19.1091 3.74169 20.5545C4.94131 22 7.17402 22 11.6394 22H12.3606C16.826 22 19.0587 22 20.2584 20.5545C20.9543 19.7159 21.108 18.6252 20.9537 17" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
        <?php }
        }
        ?>
    </div>
</header>