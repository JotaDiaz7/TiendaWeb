<?php
class DevolucionesModel
{
    //Para obtener los productos que se hayan podido devolver
    public function productosDevueltos($con, $pedido)
    {
        $sql = "SELECT 
                p.id,
                p.nombre,
                p.img1,
                ld.talla,
                ld.cantidad,
                ld.precio
            FROM linea_devolucion ld
            JOIN productos p ON ld.producto = p.id
            JOIN devoluciones d ON ld.devolucion = d.id
            WHERE d.pedido = :pedido"; 

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':pedido', $pedido);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
