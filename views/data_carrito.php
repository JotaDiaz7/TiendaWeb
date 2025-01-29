<ul id="productsCar">
    <?php
    $precioProductos = 0;
    $modelP = new ProductosModel;

    foreach ($carrito as $item) {
        $idProd = $item['producto'];

        $producto = $modelP->getProducto($con, $idProd);
        $nombre = formatearNombre($producto['nombre']);
        $talla = $item['talla'] > 1 ? "/talla-" . $item['talla'] : ""; //Si la talla es mayor a uno es calzado
    ?>
        <li class="productCar">
            <a href="/producto/<?= $idProd ?>/<?= $nombre ?><?= $talla ?>" class="imgProdCar itemsCenter">
                <img src="/media/productos/<?= $producto['img1']; ?>" alt="<?= $producto['nombre']; ?>" title="<?= $producto['nombre']; ?>">
            </a>
            <div class="infoProdCar">
                <h4><a href="/producto/<?= $idProd ?>/<?= $nombre ?><?= $talla ?>" class="titleProd"><?= $producto['nombre']; ?></a></h4>
                <?php
                //Consultamos el precio para saber si tiene o no descuento, y además poner su view
                $precio = consultar_precio($con, $idProd, $producto['precio']);
                ?>
                <span class="sizeProd"><?php if ($item['talla'] > 0) { ?> Talla: <?= $item['talla'];} ?></span>
                <div class="inputsCar">
                    <a href="/controllers/carrito/borrar_controller.php?producto=<?= $idProd ?>&talla=<?= $item['talla'] ?>" class="removeProd">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g stroke-width="0" />
                            <g stroke-linecap="round" stroke-linejoin="round" />
                            <g>
                                <path d="M20.5001 6H3.5" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M9.5 11L10 16" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M14.5 11L14 16" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6" stroke="#222222" stroke-width="1.5" />
                                <path d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                            </g>
                        </svg>
                    </a>
                    <div class="amountWrap">
                        <a href="/controllers/carrito/sumar_cantidad_controller.php?producto=<?= $idProd ?>&talla=<?= $item['talla'] ?>" class="incToCart">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="M6 12H18M12 6V18" stroke="#7c3030" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </svg>
                        </a>
                        <input type="number" name="cantidadProd" class="inputCantProd" value="<?= $item['cantidad'] ?>" readonly>
                        <a href="/controllers/carrito/restar_cantidad_controller.php?producto=<?= $idProd ?>&talla=<?= $item['talla'] ?>" class="decToCart">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="M6 12L18 12" stroke="#7c3030" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </li>
    <?php

        $precioProductos += $precio * $item['cantidad'];
    }
    ?>
</ul>