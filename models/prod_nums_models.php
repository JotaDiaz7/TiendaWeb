<?php
class ProdNumsModel
{
    //Para registrar stock
    public function registro($con, $producto, $talla, $stock)
    {
        $sql = "INSERT INTO prod_nums (producto, talla, stock) 
                VALUES (:producto, :talla, :stock)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':producto', $producto);
            $stmt->bindValue(':talla', $talla);
            $stmt->bindValue(':stock', $stock);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para comprobar si existe la talla
    public function comprobarTalla($con, $producto, $talla)
    {
        $sql = "SELECT talla FROM prod_nums WHERE producto = :producto AND talla = :talla";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':producto', $producto);
            $stmt->bindParam(':talla', $talla);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener el stock del producto
    public function getStock($con, $producto)
    {
        $sql = "SELECT *
                FROM prod_nums 
                WHERE producto = :producto
                order by talla";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':producto', $producto);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener el stock del producto
    public function getStockTalla($con, $producto, $talla)
    {
        $sql = "SELECT stock
                    FROM prod_nums 
                    WHERE producto = :producto AND talla = :talla
                    order by talla";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':producto', $producto);
            $stmt->bindParam(':talla', $talla);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result["stock"];
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para actualizar los datos del stock
    public function updateStock($con, $producto, $talla, $stock)
    {
        $sql = "UPDATE prod_nums 
                SET stock = stock + :stock
                WHERE producto = :producto AND talla = :talla";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':producto', $producto);
            $stmt->bindParam(':talla', $talla);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para disminuir el stock
    public function disminuirStock($con, $producto, $talla, $stock)
    {
        $sql = "UPDATE prod_nums 
                    SET stock = stock - :stock
                    WHERE producto = :producto AND talla = :talla";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':producto', $producto);
            $stmt->bindParam(':talla', $talla);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }


    //Obtenemos todas las tallas que tengan stock
    public function getTallas($con, $producto)
    {
        $sql = "SELECT talla FROM prod_nums WHERE producto = :producto AND stock > 0";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':producto', $producto);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Obtenemos la talla más pequeña que tengan stock
    public function getMinTalla($con, $producto)
    {
        $sql = "SELECT MIN(talla) AS talla FROM prod_nums WHERE producto = :producto AND stock > 0";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':producto', $producto);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result["talla"] ?? 0;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a borrar el stock
    public function borrarStock($con, $producto, $talla)
    {
        $sql = "DELETE FROM prod_nums WHERE producto = :producto AND talla = :talla";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':producto', $producto);
            $stmt->bindValue(':talla', $talla);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
