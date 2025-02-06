<table>
    <thead>
        <th>Ventas</th>
        <th>Pedidos cancelados</th>
        <th>Devoluciones</th>
        <th>Ingresos</th>
    </thead>
    <tbody>
        <tr>
            <td>
                <?= ($dates["pedidos"] !== null) ? number_format($dates["pedidos"], 2, ',', '.') : '0' ?>€
            </td>
            <td>
                <?= ($dates["cancelados"] !== null) ? number_format($dates["cancelados"], 2, ',', '.') : '0' ?>€
            </td>
            <td>
                <?= ($dates["devoluciones"] !== null) ? number_format($dates["devoluciones"], 2, ',', '.') : '0' ?>€
            </td>
            <td><?= number_format($dates["pedidos"] - $dates["cancelados"] - $dates["devoluciones"], 2, ',', '.') ?>€</td>
        </tr>
    </tbody>
</table>