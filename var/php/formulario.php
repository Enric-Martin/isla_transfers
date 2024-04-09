<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoRegistro = $_POST["tipoRegistro"];
    
    if ($tipoRegistro == "viajero") {
        header("Location: formulario_viajero.php");
        exit;
    }
}
?>