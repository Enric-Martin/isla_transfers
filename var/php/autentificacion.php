<?php
// Incluir el archivo de conexión
require_once 'conexion.php';
// Incluir la clase usoUsuario
require_once 'uso_de_usuario.php';

// Crear una instancia de la clase usoUsuario
$userManager = new UsoUsuario($pdo);

// Validar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['email'], $_POST['password'], $_POST['tipo_usuario'])) {
    if ($userManager->iniciarSesion($_POST['email'], $_POST['password'], $_POST['tipo_usuario'])) {
        // Redirigir al panel correspondiente según el tipo de usuario
        switch ($_POST['tipo_usuario']) {
            case 'viajero':
                header('Location: panel_viajero.php');
                exit;
            case 'corporativo':
                header('Location: panel_corporativo.html');
                exit;
            case 'conductor':
                header('Location: panel_conductor.php');
                exit;
            case 'administrador':
                header('Location: panel_admin.php');
                exit;
        }
    } else {
        // Si las credenciales son incorrectas, redirigir de nuevo al formulario de inicio de sesión
        header('Location: log_in.html?error=credenciales_invalidas');
        exit;
    }
} else {
    // Si no se han proporcionado todos los datos necesarios, redirigir al formulario de inicio de sesión
    header('Location: log_in.html');
    exit;
}
?>
