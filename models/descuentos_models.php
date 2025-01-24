<?php
class DescuentosModel
{
    // Para registrar un descuento
    public function registro($con, $nombre, $importe, $tipo, $fecha_inicio, $fecha_fin)
    {
        $sql = "INSERT INTO descuentos (nombre, importe, tipo, fecha_inicio, fecha_fin)
                VALUES (:nombre, :importe, :tipo, :fecha_inicio, :fecha_fin)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':nombre', $nombre);
            $stmt->bindValue(':importe', $importe);
            $stmt->bindValue(':tipo', $tipo);
            $stmt->bindValue(':fecha_inicio', $fecha_inicio);
            $stmt->bindValue(':fecha_fin', $fecha_fin);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    // Para comprobar si un descuento ya existe
    public function comprobarDescuento($con, $nombre)
    {
        $sql = "SELECT nombre FROM descuentos WHERE nombre = :nombre";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();

            $descuento = $stmt->fetch(PDO::FETCH_ASSOC);

            return $descuento ? true : false;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    // Obtenemos todos los descuentos
    public function listarDescuentos($con)
    {
        $sql = "SELECT * FROM descuentos";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    // Para obtener un descuento específico
    public function getDescuento($con, $nombre)
    {
        $sql = "SELECT * FROM descuentos WHERE nombre = :nombre";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':nombre', $nombre);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    // Para obtenemos los datos del descuento de un producto en concreto
    public function getDescuentoProducto($con, $producto)
    {
        $sql = "
            SELECT d.*, p.precio
            FROM productos p
            JOIN descuentos d ON p.descuento = d.nombre
            WHERE p.id = :producto
            AND CURDATE() BETWEEN d.fecha_inicio AND d.fecha_fin
        ";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':producto', $producto);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }


    // Para actualizar los datos de un descuento
    public function actualizarDescuento($con, $nombre, $importe, $tipo, $fecha_inicio, $fecha_fin)
    {
        $sql = "UPDATE descuentos 
                SET importe = :importe, tipo = :tipo, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin
                WHERE nombre = :nombre";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':importe', $importe);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    // Para borrar un descuento concreto de un producto
    public function borrarDescuentoProducto($con, $descuento)
    {
        $sql = "UPDATE productos SET descuento = NULL WHERE descuento = :descuento";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':descuento', $descuento);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    // Para borrar un descuento
    public function borrarDescuento($con, $nombre)
    {
        $sql = "DELETE FROM descuentos WHERE nombre = :nombre";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    // Para obtener los productos que usan un descuento específico
    public function getProductosConDescuento($con, $nombre)
    {
        $sql = "SELECT p.id, p.nombre, p.precio 
                FROM productos p 
                WHERE p.descuento = :nombre";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
