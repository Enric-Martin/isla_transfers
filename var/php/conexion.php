<?php

//Conexion Mysql
$servidor = "mysql";
$usuario = "miusuario";
$password = "mipassword";
$bd = "bbddRocketTeam";

//Configurar dsn
$dsn = 'mysql:host=' . $servidor . ';dbname=' . $bd;

//Crear una instancia PDO
$pdo = new PDO($dsn, $usuario, $password);

if(!$pdo){
    die("Error al conectar la base de datos de la pagina".mysql_connect_error());
}

?>