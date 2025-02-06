<table>
    <thead>
        <th>ID</th>
        <th>Pedido</th>
        <th>Usuario</th>
        <th>Estado</th>
        <th>Importe</th>
        <th>Fecha</th>
    </thead>
    <tbody>
        <?php 
            foreach ($dates as $item) {
        ?>
                <tr>
                    <td><?= $item["id"] ?></td>
                    <td><?= $item["pedido"] ?></td>
                    <td><?= $item["usuario"] ?></td>
                    <td><?= $item["estado"] ?></td>
                    <td><?= $item["importe"] ?>€</td>
                    <td><?= $item["fecha"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>