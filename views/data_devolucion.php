<h3>Productos</h3>
<ul id="productos" class="container">
    <?php include '../views/productos_pedido.php'; ?>
</ul>
<h3>Detalles de recogida</h3>
<div id="envio" class="container">
    <div id="name">
        <?= $dates['nombre']; ?> <?= $dates['apellidos']; ?>   
    </div>
    <div id="correo">
        <a href="mailto:<?= $dates['email']; ?>"><?= $dates['email']; ?></a>
    </div>
    <div id="movil">
        <a href="tel:+34<?= $dates['movil']; ?>"><?= $dates['movil']; ?></a>
    </div>
    <div class="direcWrap d-flex">
        <p class="direccion"><?= $dates["direccion"] ?></p>
        <span class="ciudad"><?= $dates["ciudad"] ?></span>
        <span class="provincia"><?= $dates["provincia"] ?></span>
    </div>
</div>
<h3>Detalles de devolución</h3>
<div id="pago" class="container d-flex space-between">
    <div class="rowPago">
        <p><?= $dates['fecha']; ?></p>
        <p><?= $dates['hora']; ?></p>
    </div>
    <div class="rowPago">
        <h2><?= $dates['importe']; ?>€</h2>
    </div>
</div>