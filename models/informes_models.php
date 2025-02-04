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

            return $stmt->fetchAll(PDO::FETCH_ASSOC);;
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

            return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para los pedidos
    function pedidos($con, $estado, $inicio, $num)
    {
        if ($estado != "") {
            $sql = "SELECT id, usuario, estado, metodo_pago, importe, fecha 
                FROM pedidos WHERE estado = :estado order by fecha DESC LIMIT $inicio, $num";
        } else {
            $sql = "SELECT id, usuario, estado, metodo_pago, importe, fecha 
                FROM pedidos order by fecha DESC LIMIT $inicio, $num";
        }

        try {
            $stmt = $con->prepare($sql);
            if ($estado != "") $stmt->bindParam(':estado', $estado);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    function contar($con, $tipo, $informe, $dato)
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
                } else {
                    $sql = "SELECT count(*) as count FROM pedidos";
                }
            break;
        }

        try {
            $stmt = $con->prepare($sql);
            if ($tipo == 3 && $informe == 1 && $dato != "") $stmt->bindParam(':estado', $dato);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        } catch (PDOException $e) {
            header("Location: /error?error=1Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
