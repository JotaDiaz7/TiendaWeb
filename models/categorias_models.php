<?php
class CategoriasModel
{
    //Para registrar categoría
    public function registro($con, $id, $categoria, $padre)
    {
        $sql = "INSERT INTO categorias (id, nombre, padre)
                VALUES (:id, :nombre, :padre)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nombre', $categoria);
            $stmt->bindValue(':padre', $padre);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para comprobar si la categoría ya existe 
    public function comprobarCategoria($con, $categoria)
    {
        $sql = "SELECT nombre FROM categorias WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $categoria);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result["nombre"] ?? false;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener las categorías padre o hijo
    public function getCategorias($con, $esPadre)
    {
        if ($esPadre === "") { //Para obtener solo los padres
            $sql = "SELECT * FROM categorias WHERE padre IS NULL AND activo = 1";
        } else if ($esPadre === "child") { //Solo las hijas
            $sql = "SELECT * FROM categorias WHERE padre IS NOT NULL AND activo = 1";
        } else { //En función del padre
            $sql = "SELECT * FROM categorias WHERE padre = :padre AND activo = 1";
        }

        try {
            $stmt = $con->prepare($sql);
            if (!in_array($esPadre, ["", "all", "child"])) {
                $stmt->bindParam(':padre', $esPadre);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener tidas las categorías 
    public function listarCategorias($con, $inicio, $num)
    {
        $sql = "SELECT * FROM categorias order by padre asc LIMIT $inicio, $num";

        try {
            $stmt = $con->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para activar o desactivar las categorías
    public function estadoCategoria($con, $categoria, $activo)
    {
        $sql = "UPDATE categorias SET activo = :activo WHERE id = :categoria";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':activo', $activo);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para borrar una categoría
    public function borrarCategoria($con, $categoria)
    {
        $sql = "DELETE FROM categorias WHERE id = :categoria";
        try {
            $stmt = $con->prepare($sql);

            $stmt->bindParam(':categoria', $categoria);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener la categoría padre de un hijo
    public function getCategoriaPadre($con, $categoriaHijo)
    {
        $sql = "SELECT padre FROM categorias WHERE id = :categoriaHijo";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':categoriaHijo', $categoriaHijo);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a crear una función para ver si el producto es calzado o no 
    public function esCalzado($con, $producto)
    {
        $sql = "SELECT 
                p.categoria
            FROM productos p JOIN categorias c
            ON p.categoria = c.id 
            WHERE c.padre = 'calzado' AND p.id = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $producto);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ? true : false;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a crear una función para saber si una categoría padre tiene hijos, ya que si los tiene no la podremos borrar
    public function tieneHijos($con, $categoriaPadre)
    {
        $sql = "SELECT COUNT(*) as count FROM categorias WHERE padre = :categoriaPadre";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':categoriaPadre', $categoriaPadre);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['count'] > 0;
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a obtener el número total de categorías
    public function contar($con)
    {
        $sql = "SELECT count(*) as count FROM categorias";
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

        //Buscamos a la categoría
        public function buscarCategoría($con, $categoria)
        {
            $sql = "SELECT * FROM categorias 
                    WHERE nombre LIKE :categoria";
    
            try {
                $stmt = $con->prepare($sql);
                $stmt->bindValue(':categoria', "%$categoria%");
                $stmt->execute();
    
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                header("Location: /error?error=Error en la consulta: " . $e->getMessage());
                exit;
            }
        }
}
