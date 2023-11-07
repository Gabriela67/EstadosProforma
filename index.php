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
        $consulta = $mysqli->query("SELECT * FROM cuentas ORDER BY CAST(SUBSTRING(CODIGO, 1, 2) AS SIGNED)");        if ($consulta) {
            while ($linea = $consulta->fetch_assoc()) {
                echo "<tr>
                    <td>{$linea['CODIGO']}</td>
                    <td>{$linea['DETALLE']}</td>
                    <td>{$linea['RAZON']}</td>
                </tr>";
            }
        } else {
            echo "Error en la consulta: " . $mysqli->error;
        }
        $mysqli->close();
        ?>
    </table>
</section>

</body>
</html>
