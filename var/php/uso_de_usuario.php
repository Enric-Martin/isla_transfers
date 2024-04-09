<?php
// Incluir el archivo de conexión
require_once 'conexion.php';

// Clase para manejar usuarios
class UsoUsuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function iniciarSesion($email, $password, $tipoUsuario) {
        // Determinar la tabla correspondiente en la base de datos según el tipo de usuario
        switch ($tipoUsuario) {
            case 'viajero':
                $tablaUsuario = 'transfer_viajeros';
                break;
            case 'corporativo':
                $tablaUsuario = 'transfer_hotel';
                break;
            case 'conductor':
                $tablaUsuario = 'transfer_vehiculo';
                break;
            case 'administrador':
                $tablaUsuario = 'transfer_admin';
                break;
            default:
                throw new Exception('El tipo de usuario proporcionado no es válido');
        }
    
        // Consulta preparada para obtener los datos del usuario
        $stmt = $this->pdo->prepare("SELECT * FROM $tablaUsuario WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verificar si se encontró un usuario con el email proporcionado
        if ($user && $this->verifyPassword($password, $user['password'])) {
            // Contraseña correcta, iniciar sesión
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
    
            // Almacenar los datos específicos del usuario en variables de sesión
            $_SESSION['userData'] = $user;
    
            return true;
        } else {
            return false;
        }
    }
    
    private function verifyPassword($password, $hashedPassword) {
        // Proceso de hashing del password proporcionado
        $hashedUserPassword = '*' . hash('sha256', $password);
    
        // Comparación de los hashes
        return $hashedUserPassword === $hashedPassword;
    }

    public function obtenerDatosUsuario($campo) {
        // Verificar si el usuario está logueado
        if (isset($_SESSION['loggedin'], $_SESSION['userData'], $_SESSION['userData'][$campo])) {
            return $_SESSION['userData'][$campo];
        } else {
            return null;
        }
    }
}
?>
