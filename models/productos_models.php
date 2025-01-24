<?php
class ProductosModel
{
    //Para registrar Productos
    public function registro($con, $id, $img1, $img2, $img3, $img4, $categoria, $nombre, $precio, $descripcion, $registro)
    {
        $sql = "INSERT INTO productos (id, img1, img2, img3, img4, categoria, nombre, precio, descripcion, registro) 
                VALUES (:id, :img1, :img2, :img3, :img4, :categoria, :nombre, :precio, :descripcion, :registro)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':img1', $img1);
            $stmt->bindValue(':img2', $img2);
            $stmt->bindValue(':img3', $img3);
            $stmt->bindValue(':img4', $img4);
            $stmt->bindValue(':categoria', $categoria);
            $stmt->bindValue(':nombre', $nombre);
            $stmt->bindValue(':precio', $precio);
            $stmt->bindValue(':descripcion', $descripcion);
            $stmt->bindValue(':registro', $registro);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }


    //Para comprobar el id 
    public function comprobarId($con, $id)
    {
        $sql = "SELECT id FROM productos WHERE id = :id";
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

    //Para obtener los datos del producto
    public function getProducto($con, $id)
    {
        $sql = "SELECT *
                FROM productos 
                WHERE id = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($producto) {
                return $producto;
            } else {
                header("Location: /");
                exit;
            }
        } catch (PDOException $e) {
            header("Location: ../error/Ha habido un problema: " . $e->getMessage());
            exit;
        }
    }


    //Para actualizar los datos del producto
    public function updateProducto($con, $id, $img1, $img2, $img3, $img4, $categoria, $nombre, $precio, $descripcion, $descuento)
    {
        $sql = "UPDATE productos 
                SET img1 = :img1, 
                    img2 = :img2, 
                    img3 = :img3, 
                    img4 = :img4, 
                    categoria = :categoria, 
                    nombre = :nombre, 
                    precio = :precio, 
                    descripcion = :descripcion, 
                    descuento = :descuento
                WHERE id = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':img1', $img1);
            $stmt->bindParam(':img2', $img2);
            $stmt->bindParam(':img3', $img3);
            $stmt->bindParam(':img4', $img4);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':descuento', $descuento);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }


    //Para desactivar o activar al producto
    public function estadoProducto($con, $id, $activo)
    {
        $sql = "UPDATE productos SET activo = :active WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':active', $activo);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener todos los productos
    public function listarProductos($con, $order)
    {
        $order= $order == null ? 'registro ASC' : 'nombre '.$order;
        $sql = "SELECT * FROM productos ORDER BY $order";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Buscamos el cliente
    public function buscarProducto($con, $busqueda)
    {
        $sql = "SELECT * FROM productos 
                WHERE id LIKE :busqueda OR nombre LIKE :busqueda";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':busqueda', "%$busqueda%");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a borrar la url de las imágenes de la bbdd
    public function borrarImg($con, $img, $id)
    {
        $sql = "UPDATE productos SET $img = '' WHERE id = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a obtener los productos según categoría
    public function getProductosCat($con, $categoria, $order, $inicio, $num)
    {
        $order= $order == null ? 'p.registro ASC' : 'p.nombre '.$order;
        $sql = "
            SELECT p.*
            FROM productos p
            LEFT JOIN categorias c ON p.categoria = c.categoria
            WHERE (p.categoria = :categoria OR c.padre = :categoria)
            AND p.activo = 1
            ORDER BY $order LIMIT $inicio, $num
        ";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a obtener el número total de productos
    public function contar($con)
    {
        $sql = "SELECT count(*) as count FROM productos";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }
}
