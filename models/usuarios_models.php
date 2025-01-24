<?php
class UsuariosModel
{
    //Función para el login
    public function login($con, $email, $password)
    {
        $sql = "SELECT id, rol, nombre, `password` FROM usuarios WHERE email = :email AND activo = 1";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && (password_verify($password, $usuario['password']))) {
                $_SESSION['usuario'] = [$usuario['id'], $usuario['rol'], $usuario['nombre']];

                return [$usuario['id'], $usuario['rol'], $usuario['nombre']];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para registrar Usuarios
    public function registro($con, $id, $nombre, $apellidos, $email, $password, $fecha_registro, $movil, $direccion, $ciudad, $provincia)
    {
        $sql = "INSERT INTO usuarios (id, nombre, apellidos, email, `password`, fecha_registro, movil, direccion, ciudad, provincia) 
                VALUES (:id, :nombre, :apellidos, :email, :password, :fecha_registro, :movil, :direccion, :ciudad, :provincia)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nombre', $nombre);
            $stmt->bindValue(':apellidos', $apellidos);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':fecha_registro', $fecha_registro);
            $stmt->bindValue(':movil', $movil);
            $stmt->bindValue(':direccion', $direccion);
            $stmt->bindValue(':ciudad', $ciudad);
            $stmt->bindValue(':provincia', $provincia);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para comprobar el id 
    public function comprobarId($con, $id)
    {
        $sql = "SELECT id FROM usuarios WHERE id = :id";
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

    //Para comprobar el email
    public function comprobarEmail($con, $email, $id)
    {
        $sql = "SELECT email FROM usuarios WHERE email = :email AND id != :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);; // El email ya existe y pertenece a otro usuario

        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }


    //Para obtener los datos del usuario
    public function getUsuario($con, $id)
    {
        $sql = "SELECT nombre, apellidos, email, movil, direccion, ciudad, provincia, activo FROM usuarios WHERE id = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                return $usuario;
            } else {
                header("Location: /");
                exit;
            }
        } catch (PDOException $e) {
            header("Location: ../error/Ha habido un problema: " . $e->getMessage());
            exit;
        }
    }

    //Para actualizar los datos del usuario
    public function updateUsuario($con, $id, $nombre, $apellidos, $email, $movil, $direccion, $ciudad, $provincia)
    {
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, movil = :movil, direccion = :direccion, ciudad = :ciudad, provincia = :provincia WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre',  $nombre);
            $stmt->bindParam(':apellidos',  $apellidos);
            $stmt->bindParam(':email',  $email);
            $stmt->bindParam(':movil', $movil);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':ciudad', $ciudad);
            $stmt->bindParam(':provincia', $provincia);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para cambiar la contraseña
    public function cambiarPassword($con, $id, $password)
    {
        $sql = "UPDATE usuarios SET `password` = :password WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para "eliminar" o activar al usuario
    public function estadoUsuario($con, $id, $activo)
    {
        $sql = "UPDATE usuarios SET activo = :active WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':active', $activo);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para obtener todos los usuarios
    public function listarUsuarios($con, $order, $inicio, $num)
    {
        $order= $order == null ? 'fecha_registro DESC' : 'nombre '.$order;
        $sql = "SELECT id, nombre, apellidos, email, movil, ciudad, provincia, direccion, rol, activo 
        FROM usuarios ORDER BY $order LIMIT $inicio, $num";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error/Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para cambiar el rol
    public function cambiarRol($con, $id, $rol)
    {
        //En la consulta vamos a comprobar que el id y el rol coinciden con el mismo usuario    
        $sql = "UPDATE usuarios SET rol = :rol WHERE id = :id";

        if ($rol == 1) {
            $text = " ahora es editor.";
        } else if ($rol == 0) {
            $text = " ya no tiene permisos de administrador ni de editor.";
        } else {
            $text = " ahora tiene permisos de administrador.";
        }
        try {
            $stmt = $con->prepare($sql);

            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return "El usuario " . $id . $text;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Buscamos el cliente
    public function buscarUsuario($con, $busqueda)
    {
        $sql = "SELECT id, nombre, apellidos, email, movil, rol, activo 
                FROM usuarios 
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

    //Vamos a obtener el número total de usuarios
    public function contar($con)
    {
        $sql = "SELECT count(*) as count FROM usuarios";
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
