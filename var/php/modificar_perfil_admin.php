<?php

// Iniciar sesion para acceder a las variables de sessión
session_start();
$id_admin = $_SESSION['id_admin'];


// Incluir el archivo de conexión
require_once 'conexion.php';

// Verificar si se han enviado los datos del formulario
$_SERVER["REQUEST_METHOD"] == "POST";
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['contrasena']; // Recuerda cambiar el nombre del campo si es diferente en tu formulario

    //Convertir contraseña en hash
    $hashedPassword = "CONCAT('*', SHA2('$password', 256))";

    // Consulta SQL para actualizar los datos en la tabla transfer_admin
    $sql = "UPDATE transfer_admin SET nombre = :nombre, email = :email, password = $hashedPassword WHERE id_admin = :id_admin";

    // Preparar la consulta
    $stmt = $pdo->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(':id_admin', $id_admin, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // Actualizar los datos de sesión si la consulta se ejecutó correctamente
        $_SESSION['nombre'] = $nombre;
        $_SESSION['email'] = $email;

        // Actualizar los datos del usuario en la sesión
        $_SESSION['userData']['nombre'] = $nombre;
        $_SESSION['userData']['email'] = $email;

        // Redirigir a la página de perfil con el parámetro "guardado=true"
        header("refresh:2; url=log_in.html");
        exit(); // Asegúrate de salir del script después de la redirección
    } else {
        // Manejar el error si la consulta no se ejecuta correctamente
        echo "Error al actualizar los datos.";
    }
?>