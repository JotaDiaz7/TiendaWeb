<ul id="productsCar">
    <?php
    $precioProductos = 0;
    require_once '../models/productos_models.php';
    $modelP = new ProductosModel;
    if(!empty($_SESSION["devolucion"])){
    foreach ($_SESSION["devolucion"] as $item) {
        $idProd = $item['id'];
        $producto = $modelP->getProducto($con, $idProd);
        $nombre = formatearNombre($producto['nombre']);
        $talla = $item['talla'] > 1 ? "/talla-" . $item['talla'] : "";
    ?>
        <li class="productCar">
            <a href="/producto/<?= $idProd ?>/<?= $nombre ?><?= $talla ?>" class="imgProdCar itemsCenter">
                <img src="/media/productos/<?= $producto['img1']; ?>" alt="<?= $producto['nombre']; ?>" title="<?= $producto['nombre']; ?>">
            </a>
            <div class="infoProdCar">
                <h4><a href="/producto/<?= $idProd ?>/<?= $nombre ?><?= $talla ?>" class="titleProd"><?= $producto['nombre']; ?></a></h4>
                <span class="precio"><?= $item['precio']; ?>€</span>
                <span class="sizeProd"><?php if ($item['talla'] > 0) { ?> Talla: <?= $item['talla'];} ?></span>
                <div class="inputsCar">
                    <div class="amountWrap">
                        <a href="/controllers/devoluciones/sumar_cantidad_controller.php?producto=<?= $idProd ?>&talla=<?= $item['talla'] ?>&max=<?=$item["cantidad_max"]?>&pedido=<?=$pedido?>" class="incToCart">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="M6 12H18M12 6V18" stroke="#7c3030" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </svg>
                        </a>
                        <input type="number" name="cantidadProd" class="inputCantProd" value="<?= $item['cantidad'] ?>" readonly>
                        <a href="/controllers/devoluciones/restar_cantidad_controller.php?producto=<?= $idProd ?>&talla=<?= $item['talla'] ?>&pedido=<?=$pedido?>" class="decToCart">
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
        $precioProductos += $item['precio'] * $item['cantidad'];
        
    }}else{
    ?>
    <li>No quedan más productos para devolver en este pedido.</li>
    <?php } ?>
</ul>