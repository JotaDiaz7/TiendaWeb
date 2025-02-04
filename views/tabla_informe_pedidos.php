<table>
    <thead>
        <th>ID</th>
        <th>Usuario</th>
        <th>Estado</th>
        <th>Método de pago</th>
        <th>Importe</th>
        <th>Fecha</th>
    </thead>
    <tbody>
        <?php 
            foreach ($dates as $item) {
        ?>
                <tr>
                    <td><?= $item["id"] ?></td>
                    <td><?= $item["usuario"] ?></td>
                    <td><?= $item["estado"] ?></td>
                    <td><?= $item["metodo_pago"] ?></td>
                    <td><?= $item["importe"] ?>€</td>
                    <td><?= $item["fecha"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>