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
        $sql = "SELECT p.id AS pedido_id, 
            p.metodo_pago,
            p.direccion,
            p.ciudad,
            p.provincia,
            p.fecha,
            p.hora,
            p.estado,
            p.importe,
            u.id AS usuario_id,
            u.nombre,
            u.apellidos,
            u.email,
            u.movil
        FROM pedidos p
        JOIN usuarios u ON p.usuario = u.id
        WHERE p.id = :id";
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

    //Para obtener los pedidos
    public function listarPedidos($con, $order, $inicio, $num, $usuario)
    {
        $order = $order == null ? 'DESC' : $order;
        if ($usuario == "") {
            $sql = "SELECT * FROM pedidos ORDER BY fecha $order LIMIT $inicio, $num";
        } else {
            $sql = "SELECT * FROM pedidos WHERE usuario = :usuario ORDER BY fecha $order LIMIT $inicio, $num";
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

    //Vamos a obtener el número total de pedidos
    public function contar($con, $usuario)
    {
        if(empty($usuario)){
            $sql = "SELECT count(*) as count FROM pedidos";
        }else{
            $sql = "SELECT count(*) as count FROM pedidos WHERE usuario = :usuario";
        }
        try {
            $stmt = $con->prepare($sql);
            if(!empty($usuario)){
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

    //Buscamos el pedido
    public function buscarPedido($con, $busqueda)
    {
        $sql = "SELECT * FROM pedidos WHERE id LIKE :busqueda OR usuario LIKE :busqueda";

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

    //Obtenemos todos los productos del pedido
    public function productosPedido($con, $pedido)
    {
        $sql = "SELECT 
                pr.id,
                pr.nombre,
                pr.img1,
                lp.pedido,
                lp.talla,
                lp.cantidad,
                lp.precio
            FROM linea_pedido lp
            JOIN productos pr ON lp.producto = pr.id
            WHERE lp.pedido = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $pedido);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para cambiar el estado del pedido
    public function cambiarEstado($con, $id, $estado): bool
    {
        $sql = "UPDATE pedidos SET estado = :estado WHERE id = :id";
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

    //Para eliminar el pedido
    public function eliminarPedido($con, $id): bool
    {
        $sql1 = "DELETE FROM linea_pedido WHERE pedido = :id";
        $sql2 = "DELETE FROM pedidos WHERE id = :id";
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
