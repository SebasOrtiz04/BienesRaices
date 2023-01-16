<?php
//importar la conexión
require 'includes/config/database.php';
$db = conectarDB();

//Crear un email y un Password
$email = "admin@admin.com";
$password = "pass1234";

$passwordHash = password_hash( $password,PASSWORD_DEFAULT);

//Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ( '".$email."', '".$passwordHash."')";
echo $query;

//Agregar a la base de datos
mysqli_query($db,$query);



