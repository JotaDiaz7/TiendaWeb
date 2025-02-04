<table>
    <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>e-mail</th>
        <th>Móvil</th>
        <th>Fecha registro</th>
    </thead>
    <tbody>
        <?php 
            foreach ($dates as $item) {
        ?>
                <tr>
                    <td><?= $item["id"] ?></td>
                    <td><?= $item["nombre"] ?></td>
                    <td><?= $item["apellidos"] ?></td>
                    <td><?= $item["email"] ?></td>
                    <td><?= $item["movil"] ?></td>
                    <td><?= $item["fecha_registro"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>