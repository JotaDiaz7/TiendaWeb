<?php

class InformesModel
{
    //Para los usuarios
    function usuarios($con, $estado, $inicio, $num, $order)
    {
        if ($estado == "") {
            $order = $order == "" ? "DESC" : $order;
            $sql = "SELECT id, nombre, apellidos, email, movil, fecha_registro 
            FROM usuarios ORDER BY fecha_registro $order LIMIT $inicio, $num";
        } else {
            $sql = "SELECT id, nombre, apellidos, email, movil, fecha_registro 
            FROM usuarios WHERE activo = :estado order by fecha_registro DESC
            LIMIT $inicio, $num";
        }

        try {
            $stmt = $con->prepare($sql);
            if ($estado != "") $stmt->bindParam(':estado', $estado);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para los productos
    function productos($con, $estado, $inicio, $num, $order, $filtro)
    {
        if ($estado == "") {
            $order = $order == "" ? "DESC" : $order;
            $filtro = $filtro == "ventas" ? $filtro : "registro";
            $sql = "SELECT id, nombre, img1, categoria, ventas, registro 
            FROM productos order by $filtro $order LIMIT $inicio, $num";
        } else {
            $sql = "SELECT id, nombre, img1, categoria, ventas, registro 
            FROM productos WHERE activo = :estado order by registro DESC
            LIMIT $inicio, $num";
        }

        try {
            $stmt = $con->prepare($sql);
            if ($estado != "") $stmt->bindParam(':estado', $estado);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para los pedidos
    function pedidos($con, $estado, $inicio, $num, $fecha_inicio, $fecha_fin)
    {
        if ($estado != "") {
            $sql = "SELECT id, usuario, estado, metodo_pago, importe, fecha 
                FROM pedidos WHERE estado = :estado order by fecha DESC LIMIT $inicio, $num";
        } else if ($fecha_inicio != "" && $fecha_fin != "") {
            $sql = "SELECT id, usuario, estado, metodo_pago, importe, fecha 
            FROM pedidos WHERE fecha BETWEEN :fecha_inicio AND :fecha_fin LIMIT $inicio, $num";
        } else {
            $sql = "SELECT id, usuario, estado, metodo_pago, importe, fecha 
                FROM pedidos order by fecha DESC LIMIT $inicio, $num";
        }

        try {
            $stmt = $con->prepare($sql);
            if ($estado != "") $stmt->bindParam(':estado', $estado);
            if ($fecha_inicio != "" && $fecha_fin != "") {
                $stmt->bindParam(':fecha_inicio', $fecha_inicio);
                $stmt->bindParam(':fecha_fin', $fecha_fin);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para las devoluciones
    function devoluciones($con, $estado, $inicio, $num, $fecha_inicio, $fecha_fin)
    {
        if ($estado != "") {
            $sql = "SELECT id, pedido, usuario, estado, importe, fecha 
                    FROM devoluciones WHERE estado = :estado order by fecha DESC LIMIT $inicio, $num";
        } else if ($fecha_inicio != "" && $fecha_fin != "") {
            $sql = "SELECT id, pedido, usuario, estado, importe, fecha 
                FROM devoluciones WHERE fecha BETWEEN :fecha_inicio AND :fecha_fin LIMIT $inicio, $num";
        } else {
            $sql = "SELECT id, pedido, usuario, estado, importe, fecha 
                    FROM devoluciones order by fecha DESC LIMIT $inicio, $num";
        }

        try {
            $stmt = $con->prepare($sql);
            if ($estado != "") $stmt->bindParam(':estado', $estado);
            if ($fecha_inicio != "" && $fecha_fin != "") {
                $stmt->bindParam(':fecha_inicio', $fecha_inicio);
                $stmt->bindParam(':fecha_fin', $fecha_fin);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    function ganancias($con, $fecha_inicio, $fecha_fin)
    {

        $sql = "
        SELECT 
            (SELECT SUM(importe) FROM pedidos 
                WHERE fecha BETWEEN :fecha_inicio AND :fecha_fin) AS pedidos,
            (SELECT SUM(importe) FROM pedidos 
                WHERE estado = 'Cancelado' AND fecha BETWEEN :fecha_inicio AND :fecha_fin) AS cancelados,
            (SELECT SUM(importe) FROM devoluciones 
                WHERE estado != 'Cancelada' AND fecha BETWEEN :fecha_inicio AND :fecha_fin) AS devoluciones
        ";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC) ?? ['pedidos' => 0, 'cancelados' => 0, 'devoluciones' => 0];
        } catch (PDOException $e) {
            header("Location: /error?error=" . urlencode("Error en la consulta: " . $e->getMessage()));
            exit;
        }
    }

    function contar($con, $tipo, $informe, $dato, $fecha_inicio, $fecha_fin)
    {
        switch ($tipo) {
            case 1:
                if ($informe == 1 || $informe == 2) {
                    $activo = $informe == 1 ? 1 : 0;
                    $sql = "SELECT count(*) as count FROM usuarios WHERE activo = $activo";
                } else {
                    $sql = "SELECT count(*) as count FROM usuarios";
                }
                break;
            case 2:
                if ($informe == 1 || $informe == 2) {
                    $activo = $informe == 1 ? 1 : 0;
                    $sql = "SELECT count(*) as count FROM productos WHERE activo = $activo";
                } else {
                    $sql = "SELECT count(*) as count FROM productos";
                }
                break;
            case 3:
                if ($informe == 1 && $dato != "") {
                    $sql = "SELECT count(*) as count FROM pedidos WHERE estado = :estado";
                } else if ($informe == 2 && $fecha_inicio != "" && $fecha_fin != "") {
                    $sql = "SELECT count(*) as count FROM pedidos WHERE fecha BETWEEN :fecha_inicio AND :fecha_fin";
                } else {
                    $sql = "SELECT count(*) as count FROM pedidos";
                }
                break;
            case 4:
                if ($informe == 1 && $dato != "") {
                    $sql = "SELECT count(*) as count FROM devoluciones WHERE estado = :estado";
                } else if ($informe == 2 && $fecha_inicio != "" && $fecha_fin != "") {
                    $sql = "SELECT count(*) as count FROM devoluciones WHERE fecha BETWEEN :fecha_inicio AND :fecha_fin";
                } else {
                    $sql = "SELECT count(*) as count FROM devoluciones";
                }
                break;
        }

        try {
            $stmt = $con->prepare($sql);
            //Parámetros para los pedidos y devoluciones
            if (($tipo == 3 || $tipo == 4) && $informe == 1 && $dato != "") $stmt->bindParam(':estado', $dato);
            if (($tipo == 3 || $tipo == 4) && $informe == 2 && $fecha_inicio != "" && $fecha_fin != "") {
                $stmt->bindParam(':fecha_inicio', $fecha_inicio);
                $stmt->bindParam(':fecha_fin', $fecha_fin);
            }

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        } catch (PDOException $e) {
            header("Location: /error?error=1Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
