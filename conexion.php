<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "contabilidad";

// Conectar a la base de datos
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    // Verificar si la conexión sigue activa
    if (mysqli_ping($conn)) {
        echo "Conexión exitosa a la base de datos.";
    } else {
        echo "La conexión ha sido perdida.";
    }
}

// Cierra la conexión cuando hayas terminado de trabajar con la base de datos.
mysqli_close($conn);
?>

