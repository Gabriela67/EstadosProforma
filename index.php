<?php
include("header.php");
?>

<section class="contenido">
    <header class="tituloContenido"><h2>Plan de Cuentas</h2></header>
    <table class='styled-table'>
        <tr>
            <th>CODIGO</th>
            <th>DETALLE</th>
            <th>RAZON</th>
        </tr>
        <?php
       

       $mysqli = new mysqli("localhost", "root", "", "contabilidad");

// Verifica si la conexión a la base de datos fue exitosa
if ($mysqli->connect_error) {
    die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
}

        // Realiza la consulta SQL usando MySQLi
        $query = "SELECT * FROM cuentas";
        $result = $mysqli->query($query);

        // Verifica si la consulta se ejecutó correctamente
        if ($result) {
            while ($linea = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$linea['CODIGO']}</td>
                    <td>{$linea['DETALLE']}</td>
                    <td>{$linea['RAZON']}</td>
                </tr>";
            }
        } else {
            echo "Error en la consulta SQL: " . $mysqli->error;
        }

        // Cierra la conexión a la base de datos
        $mysqli->close();
        ?>
    </table>
</section>

</body>
</html>
