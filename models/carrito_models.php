<?php
class CarritoModel
{
    //Para registrar productos en el carrito
    public function registro($con, $usuario, $producto, $talla, $cantidad)
    {
        $sql = "INSERT INTO carrito (usuario, producto, talla, cantidad)
                VALUES (:usuario, :producto, :talla, :cantidad)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':producto', $producto);
            $stmt->bindValue(':talla', $talla);
            $stmt->bindValue(':cantidad', $cantidad);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para aumentar en 1 la cantidad de un producto
    public function aumentarCantidad($con, $usuario, $producto, $talla, $cantidad)
    {
        $sql = "UPDATE carrito SET cantidad = cantidad + :cantidad WHERE usuario = :usuario AND producto = :producto AND talla = :talla";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':producto', $producto);
            $stmt->bindValue(':talla', $talla);
            $stmt->bindValue(':cantidad', $cantidad);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para disminuir en 1 la cantidad de un producto
    public function disminuirCantidad($con, $usuario, $producto, $talla)
    {
        $sql = "UPDATE carrito SET cantidad = cantidad - 1 WHERE usuario = :usuario AND producto = :producto AND talla = :talla";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':producto', $producto);
            $stmt->bindValue(':talla', $talla);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para cambiar la cantidad de un producto
    public function cambiarCantidad($con, $usuario, $producto, $talla, $cantidad)
    {
        $sql = "UPDATE carrito SET cantidad = :cantidad WHERE usuario = :usuario AND producto = :producto AND talla = :talla";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':producto', $producto);
            $stmt->bindValue(':talla', $talla);
            $stmt->bindValue(':cantidad', $cantidad);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener los productos del usuario en el carrito
    public function productosUsuario($con, $usuario)
    {
        $sql = "SELECT * FROM carrito WHERE usuario = :usuario";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener la cantidad de un producto en concreto del usuario en el carrito
    public function getCantProd($con, $usuario, $producto, $talla)
    {
        $sql = "SELECT cantidad FROM carrito WHERE usuario = :usuario AND producto = :producto AND talla = :talla";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':producto', $producto);
            $stmt->bindParam(':talla', $talla);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result === false ? 0 : (int)$result["cantidad"];
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    // Para eliminar productos del carrito
    public function eliminarProducto($con, $usuario, $producto, $talla)
    {
        $sql = "DELETE FROM carrito WHERE usuario = :usuario AND producto = :producto AND talla = :talla";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':producto', $producto);
            $stmt->bindValue(':talla', $talla);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
