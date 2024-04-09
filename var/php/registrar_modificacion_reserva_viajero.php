<?php

// Iniciar sesión para acceder a las variables de sesión
session_start();

// Incluir el archivo de conexión
require_once 'conexion.php';

// Obtener el ID de la reserva enviado desde el formulario
$id_reserva = $_POST['id_reserva'];

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Obtener el valor del botón que fue pulsado
    $accion = $_POST['accion'];
    
    // Si el botón "Modificar" fue pulsado
    if ($accion === "modificar") {
        // Recuperar los datos del formulario
        $tipo_reserva = $_POST['tipo_reserva'];
        $email_cliente = $_POST['email_cliente'];
        $hotel = $_POST['hotel'];
        $fecha_entrada = !empty($_POST['fecha_entrada']) ? $_POST['fecha_entrada'] : null;
        $hora_entrada = !empty($_POST['hora_entrada']) ? $_POST['hora_entrada'] : null;
        $numero_vuelo_entrada = !empty($_POST['numero_vuelo_entrada']) ? $_POST['numero_vuelo_entrada'] : null;
        $origen_vuelo_entrada = $_POST['origen_vuelo_entrada'];
        $hora_vuelo_salida = !empty($_POST['hora_vuelo_salida']) ? $_POST['hora_vuelo_salida'] : null;
        $fecha_salida = !empty($_POST['fecha_salida']) ? $_POST['fecha_salida'] : null;
        $num_viajeros = $_POST['num_viajeros'];
        $tipo_vehiculo = $_POST['tipo_vehiculo'];

        // Consulta SQL para actualizar los datos en la tabla transfer_viajeros
        $sql = "UPDATE transfer_reservas SET id_tipo_reserva = :tipo_reserva, email_cliente = :email_cliente, id_destino = :hotel,fecha_entrada = :fecha_entrada,hora_entrada = :hora_entrada,numero_vuelo_entrada = :numero_vuelo_entrada,origen_vuelo_entrada = :origen_vuelo_entrada, hora_vuelo_salida = :hora_vuelo_salida, fecha_vuelo_salida = :fecha_salida, num_viajeros = :num_viajeros, id_vehiculo = :tipo_vehiculo WHERE id_reserva = :id_reserva";

        // Preparar la consulta
        $stmt = $pdo->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':tipo_reserva', $tipo_reserva, PDO::PARAM_INT);
        $stmt->bindParam(':email_cliente', $email_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':hotel', $hotel, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_entrada', $fecha_entrada, PDO::PARAM_STR);
        $stmt->bindParam(':hora_entrada', $hora_entrada, PDO::PARAM_STR);
        $stmt->bindParam(':numero_vuelo_entrada', $numero_vuelo_entrada, PDO::PARAM_STR);
        $stmt->bindParam(':origen_vuelo_entrada', $origen_vuelo_entrada, PDO::PARAM_STR);
        $stmt->bindParam(':hora_vuelo_salida', $hora_vuelo_salida, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_salida', $fecha_salida, PDO::PARAM_STR);
        $stmt->bindParam(':num_viajeros', $num_viajeros, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_vehiculo', $tipo_vehiculo, PDO::PARAM_INT);
        $stmt->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirigir a la página de perfil con el parámetro "guardado=true"
            header("refresh:2; url=panel_viajero.php");
            exit();
        } else {
            // Manejar el error si la consulta no se ejecuta correctamente
            echo "Error al actualizar los datos.";
        }
    } 
    // Si el botón "Cancelar" fue pulsado
    else if ($accion === "cancelar") {
        $sql = "DELETE FROM transfer_reservas WHERE id_reserva = :id_reserva";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            header("refresh:2; url=panel_viajero.php");
            exit();
        } else {
            echo "Error al cancelar la reserva.";
        }
    }
    
}

?>
