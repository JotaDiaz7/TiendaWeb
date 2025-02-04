<table>
    <thead>
        <th>ID</th>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Ventas</th>
        <th>Registro</th>
    </thead>
    <tbody>
        <?php
        foreach ($dates as $item) {
        ?>
            <tr>
                <td><?= $item["id"] ?></td>
                <td>
                    <img src="../media/productos/<?= $item["img1"] ?>" width="50px" alt="">
                </td>
                <td><?= $item["nombre"] ?></td>
                <td><?= $item["categoria"] ?></td>
                <td><?= $item["ventas"] ?></td>
                <td><?= $item["registro"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>