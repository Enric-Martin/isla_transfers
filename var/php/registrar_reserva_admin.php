<?php
    // Iniciar sesión para acceder a las variables de sesión
    session_start();

    require_once 'conexion.php';

    // Verificar si se han enviado datos por POST
    $_SERVER["REQUEST_METHOD"] == "POST";

    // Obtener los datos enviados por el formulario y asignar null si están vacíos
    $id_hotel = !empty($_POST['hotel']) ? $_POST['hotel'] : null;
    $id_tipo_reserva = !empty($_POST['tipo_reserva']) ? $_POST['tipo_reserva'] : null;
    $id_destino = !empty($_POST['hotel']) ? $_POST['hotel'] : null;
    $fecha_entrada = !empty($_POST['fecha_entrada']) ? $_POST['fecha_entrada'] : null;
    $hora_entrada = !empty($_POST['hora_entrada']) ? $_POST['hora_entrada'] : null;
    $numero_vuelo_entrada = !empty($_POST['numero_vuelo_entrada']) ? $_POST['numero_vuelo_entrada'] : null;
    $origen_vuelo_entrada = !empty($_POST['origen_vuelo_entrada']) ? $_POST['origen_vuelo_entrada'] : null;
    $hora_vuelo_salida = !empty($_POST['hora_vuelo_salida']) ? $_POST['hora_vuelo_salida'] : null;
    $fecha_vuelo_salida = !empty($_POST['fecha_salida']) ? $_POST['fecha_salida'] : null;
    $num_viajeros = !empty($_POST['num_viajeros']) ? $_POST['num_viajeros'] : null;
    $id_vehiculo = !empty($_POST['tipo_vehiculo']) ? $_POST['tipo_vehiculo'] : null;
    $email_cliente = !empty($_POST['email_cliente']) ? $_POST['email_cliente'] : null;
    
    // Fecha y hora actual de la reserva
    $fecha_reserva = date('Y-m-d');
    $localizador = uniqid('LOC_');

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO transfer_reservas (localizador, id_hotel, id_tipo_reserva, email_cliente, fecha_reserva, fecha_modificacion, id_destino, fecha_entrada, hora_entrada, numero_vuelo_entrada, origen_vuelo_entrada, hora_vuelo_salida, fecha_vuelo_salida, num_viajeros, id_vehiculo) 
            VALUES (:localizador, :hotel, :tipo_reserva, :email_cliente, :fecha_reserva, :fecha_reserva, :id_destino, :fecha_entrada, :hora_entrada, :numero_vuelo_entrada, :origen_vuelo_entrada, :hora_vuelo_salida, :fecha_vuelo_salida, :num_viajeros, :tipo_vehiculo)";

    $stmt = $pdo->prepare($sql); 

    // Vincular los parámetros a los valores obtenidos del formulario
    $stmt->bindParam(':localizador', $localizador, PDO::PARAM_STR);
    $stmt->bindParam(':hotel', $id_hotel, PDO::PARAM_INT);
    $stmt->bindParam(':tipo_reserva', $id_tipo_reserva, PDO::PARAM_INT);
    $stmt->bindParam(':email_cliente', $email_cliente, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_reserva', $fecha_reserva, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_reserva', $fecha_reserva, PDO::PARAM_STR);        
    $stmt->bindParam(':id_destino', $id_destino, PDO::PARAM_INT);
    $stmt->bindParam(':fecha_entrada', $fecha_entrada, PDO::PARAM_STR);
    $stmt->bindParam(':hora_entrada', $hora_entrada, PDO::PARAM_STR);
    $stmt->bindParam(':numero_vuelo_entrada', $numero_vuelo_entrada, PDO::PARAM_STR);
    $stmt->bindParam(':origen_vuelo_entrada', $origen_vuelo_entrada, PDO::PARAM_STR);
    $stmt->bindParam(':hora_vuelo_salida', $hora_vuelo_salida, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_vuelo_salida', $fecha_vuelo_salida, PDO::PARAM_STR);
    $stmt->bindParam(':num_viajeros', $num_viajeros, PDO::PARAM_INT);
    $stmt->bindParam(':tipo_vehiculo', $id_vehiculo, PDO::PARAM_INT);

    // Enviamos correo electronico
    //include 'enviar_correo.php';

    // Ejecutar la consulta 
    if($stmt->execute()){
        header("refresh:2; url=panel_admin.php");
    } 
?>