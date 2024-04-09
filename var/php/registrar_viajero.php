<?php
require_once 'conexion.php';
session_start();

$_SERVER["REQUEST_METHOD"] == "POST";

// Información enviada por el formulario
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$direccion = $_POST['direccion'];
$codigopostal = $_POST['codigoPostal'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['pais'];
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar si el email ya está registrado
$sql_verificar_email = "SELECT COUNT(*) AS count FROM transfer_viajeros WHERE email = :email";
$stmt_verificar_email = $pdo->prepare($sql_verificar_email);
$stmt_verificar_email->bindParam(':email', $email, PDO::PARAM_STR);
$stmt_verificar_email->execute();
$resultado_verificar_email = $stmt_verificar_email->fetch(PDO::FETCH_ASSOC);

if ($resultado_verificar_email['count'] > 0) {
    // El email ya está registrado, mostrar mensaje de error
    $_SESSION['error_message'] = "Ya existe un usuario con este email.";
    // Redirigir de vuelta al formulario de registro
    header("Location: formulario_viajero.php");
    exit(); // Terminar la ejecución del script después de redirigir
} else {
    // El email no está registrado, se puede proceder con el registro
    // Hashing de la contraseña utilizando CONCAT() en la consulta SQL
    $hashedPassword = "CONCAT('*', SHA2('$password', 256))";

    // Preparamos el insert
    $sql = "INSERT INTO transfer_viajeros(nombre,apellido1,apellido2,direccion,codigoPostal,ciudad,pais,email,password) VALUES(:nombre,:apellido1,:apellido2,:direccion,:codigoPostal,:ciudad,:pais,:email,$hashedPassword)";

    // Preparamos la consulta
    $stmt = $pdo->prepare($sql); 

    // Vinculamos los parametros al nombre de la variable especificado 
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR, 100);
    $stmt->bindParam(':apellido1', $apellido1, PDO::PARAM_STR, 100);
    $stmt->bindParam(':apellido2', $apellido2, PDO::PARAM_STR, 100);
    $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR, 100);
    $stmt->bindParam(':codigoPostal', $codigopostal, PDO::PARAM_STR, 100);
    $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR, 100);
    $stmt->bindParam(':pais', $pais, PDO::PARAM_STR, 100);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR, 100);
    // No es necesario vincular el password ya que se incluye directamente en la consulta

    // Ejecutamos la consulta 
    if ($stmt->execute()) {
        header("refresh:2; log_in.html");
    }
}
?>