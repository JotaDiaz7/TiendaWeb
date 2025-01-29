<?php
class PedidosModel
{
    //Para registrar pedidos
    public function registro($con, $id, $usuario, $metodo_pago, $direccion, $ciudad, $provincia, $fecha, $hora, $importe)
    {
        $sql = "INSERT INTO pedidos (id, usuario, metodo_pago, direccion, ciudad, provincia, fecha, hora, importe) 
                VALUES (:id, :usuario, :metodo_pago, :direccion, :ciudad, :provincia, :fecha, :hora, :importe)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':metodo_pago', $metodo_pago);
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

    //Para registrar los productos del pedido
    public function registroLineaPedido($con, $pedido, $producto, $talla, $cantidad, $precio)
    {
        $sql = "INSERT INTO linea_pedido (pedido, producto, talla, cantidad, precio) 
            VALUES (:pedido, :producto, :talla, :cantidad, :precio)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':pedido', $pedido);
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
        $sql = "SELECT id FROM pedidos WHERE id = :id";
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

    //Para obtener los datos del pedido
    public function getPedido($con, $id)
    {
        $sql = "SELECT *
                    FROM pedidos 
                    WHERE id = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($pedido) {
                return $pedido;
            } else {
                header("Location: /");
                exit;
            }
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener los pedidos
    public function listarPedidos($con, $order, $inicio, $num)
    {
        $order = $order == null ? 'fecha DESC' : 'nombre ' . $order;
        $sql = "SELECT * 
        FROM pedidos ORDER BY $order LIMIT $inicio, $num";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a obtener el número total de pedidos
    public function contar($con)
    {
        $sql = "SELECT count(*) as count FROM pedidos";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
