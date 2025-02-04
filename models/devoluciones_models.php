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
                SUM(ld.cantidad) AS cantidad_total,
                ld.precio
            FROM linea_devolucion ld
            JOIN productos p ON ld.producto = p.id
            JOIN devoluciones d ON ld.devolucion = d.id
            WHERE d.pedido = :pedido
            GROUP BY p.id, ld.talla, ld.precio";

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

    //Para registrar devoluciones
    public function registro($con, $id, $pedido, $usuario, $direccion, $ciudad, $provincia, $fecha, $hora, $importe)
    {
        $sql = "INSERT INTO devoluciones (id, pedido, usuario, direccion, ciudad, provincia, fecha, hora, importe) 
            VALUES (:id, :pedido, :usuario, :direccion, :ciudad, :provincia, :fecha, :hora, :importe)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':pedido', $pedido);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':direccion', $direccion);
            $stmt->bindValue(':ciudad', $ciudad);
            $stmt->bindValue(':provincia', $provincia);
            $stmt->bindValue(':fecha', $fecha);
            $stmt->bindValue(':hora', $hora);
            $stmt->bindValue(':importe', $importe);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para registrar los productos de la devolución

    public function registroLineaDevolucion($con, $devolucion, $producto, $talla, $cantidad, $precio)
    {
        $sql = "INSERT INTO linea_devolucion (devolucion, producto, talla, cantidad, precio) 
            VALUES (:devolucion, :producto, :talla, :cantidad, :precio)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':devolucion', $devolucion);
            $stmt->bindValue(':producto', $producto);
            $stmt->bindValue(':talla', $talla);
            $stmt->bindValue(':cantidad', $cantidad);
            $stmt->bindValue(':precio', $precio);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para comprobar el id 
    public function comprobarId($con, $id)
    {
        $sql = "SELECT id FROM devoluciones WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener los datos de la devolucion
    public function getDevolucion($con, $id)
    {
        $sql = "SELECT d.id, 
            d.pedido, 
            d.direccion,
            d.ciudad,
            d.provincia,
            d.fecha,
            d.hora,
            d.estado,
            d.importe,
            u.id AS usuario_id,
            u.nombre,
            u.apellidos,
            u.email,
            u.movil
        FROM devoluciones d
        JOIN usuarios u ON d.usuario = u.id
        WHERE d.id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a obtener el número total de devoluciones
    public function contar($con, $usuario)
    {
        if (empty($usuario)) {
            $sql = "SELECT count(*) as count FROM devoluciones";
        } else {
            $sql = "SELECT count(*) as count FROM devoluciones WHERE usuario = :usuario";
        }
        try {
            $stmt = $con->prepare($sql);
            if (!empty($usuario)) {
                $stmt->bindValue(':usuario', $usuario);
            }
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener los devoluciones
    public function listarDevoluciones($con, $order, $inicio, $num, $usuario)
    {
        $order = $order == null ? 'DESC' : $order;
        if ($usuario == "") {
            $sql = "SELECT * FROM devoluciones ORDER BY fecha $order LIMIT $inicio, $num";
        } else {
            $sql = "SELECT * FROM devoluciones WHERE usuario = :usuario ORDER BY fecha $order LIMIT $inicio, $num";
        }

        try {
            $stmt = $con->prepare($sql);
            if ($usuario != "") {
                $stmt->bindParam(':usuario', $usuario);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Obtenemos todos los productos de la devolucion
    public function productosDevolucion($con, $devolucion)
    {
        $sql = "SELECT 
                    pr.id,
                    pr.nombre,
                    pr.img1,
                    ld.devolucion,
                    ld.talla,
                    ld.cantidad,
                    ld.precio
                FROM linea_devolucion ld
                JOIN productos pr ON ld.producto = pr.id
                WHERE ld.devolucion = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $devolucion);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para cambiar el estado de la devolución
    public function cambiarEstado($con, $id, $estado): bool
    {
        $sql = "UPDATE devoluciones SET estado = :estado WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Buscamos la devolucion
    public function buscarDevolucion($con, $busqueda)
    {
        $sql = "SELECT * FROM devoluciones WHERE id LIKE :busqueda OR usuario LIKE :busqueda";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':busqueda', "%$busqueda%");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para eliminar la devolución
    public function eliminarDevolucion($con, $id): bool
    {
        $sql1 = "DELETE FROM linea_devolucion WHERE devolucion = :id";
        $sql2 = "DELETE FROM devoluciones WHERE id = :id";
        try {
            $stmt1 = $con->prepare($sql1);
            $stmt2 = $con->prepare($sql2);

            $stmt1->bindParam(':id', $id);
            $stmt2->bindParam(':id', $id);

            $stmt1->execute();
            $stmt2->execute();

            return $stmt2->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
