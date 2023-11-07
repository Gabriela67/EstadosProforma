<?php
include("header.php");

// Crear una conexión a la base de datos usando MySQLi
$mysqli = new mysqli("localhost", "root", "", "contabilidad");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
}
?>

<section class="contenido">
    <header class="tituloContenido"><h2>Cuentas Creadas</h2></header>
    <table class='styled-table'>
        <tr>
            <th>CODIGO</th>
            <th>DETALLE</th>
            <th>RAZON</th>
            <th>TOTAL($)</th>
            <th>ULTIMA FECHA DE TRANSACCION</th>
        </tr>
        <?php
      $consulta = $mysqli->query("SELECT * FROM cuentas ORDER BY CAST(SUBSTRING(CODIGO, 1, 2) AS SIGNED)");
        if ($consulta) {
            while ($linea = $consulta->fetch_assoc()) {
                echo "<tr>
                    <td>{$linea['CODIGO']}</td>
                    <td>{$linea['DETALLE']}</td>
                    <td>{$linea['RAZON']}</td>
                    <td>{$linea['TOTAL']}</td>
                    <td>{$linea['FECHA']}</td>
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
