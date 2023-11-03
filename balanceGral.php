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
    <header class="tituloContenido">
        <hgroup>
            <h2>Empresa S.A.</h2>
            <h2>Balance General</h2>
            <h2>Junio 2023</h2>
        </hgroup>
    </header>
    <table class='styled-table' id='tab'>
        <tr>
            <td rowspan='3'>
                <table class="tab2">
                    <tr>
                        <th colspan='2'>Activos</th>
                    </tr>
                    <?php
                    $consultaActivos = $mysqli->query("SELECT * FROM cuentas WHERE RAZON ='activo'");
                    $consultaPasivos = $mysqli->query("SELECT * FROM cuentas WHERE RAZON ='Pasivo'");
                    $consultaPatrimonio = $mysqli->query("SELECT * FROM cuentas WHERE RAZON ='Patrimonio'");
                    $consultaTotalActivos = $mysqli->query("SELECT SUM(TOTAL) AS TOTAL FROM cuentas WHERE RAZON='activo'");
                    $consultaTotalPasivos = $mysqli->query("SELECT SUM(TOTAL) AS TOTAL FROM cuentas WHERE RAZON='Pasivo'");
                    $consultaTotalPatrimonio = $mysqli->query("SELECT SUM(TOTAL) AS TOTAL FROM cuentas WHERE RAZON='Patrimonio'");
                    $totalActivos = $consultaTotalActivos->fetch_assoc();
                    $totalPasivos = $consultaTotalPasivos->fetch_assoc();
                    $totalPatrimonio = $consultaTotalPatrimonio->fetch_assoc();

                    while ($row1 = $consultaActivos->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row1['DETALLE']}</td>
                            <td class='valor'>{$row1['TOTAL']}</td>
                        </tr>";
                    }

                    echo "<tr>
                            <th>Total Activos</th>
                            <td class='valor cierreTmp'>{$totalActivos['TOTAL']}</td>
                        </tr>";
                    ?>
                </table>
            </td>
            <td colspan='2'>
                <table class="tab2">
                    <tr>
                        <th colspan='2'>Pasivos</th>
                    </tr>
                    <?php
                    while ($row2 = $consultaPasivos->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row2['DETALLE']}</td>
                            <td class='valor'>{$row2['TOTAL']}</td>
                        </tr>";
                    }

                    echo "<tr>
                            <th>Total Pasivos</th>
                            <td class='valor'>{$totalPasivos['TOTAL']}</td>
                        </tr>";
                    ?>
                    <tr>
                        <th colspan='2'>Patrimonio</th>
                    </tr>
                    <?php
                    while ($row3 = $consultaPatrimonio->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row3['DETALLE']}</td>
                            <td class='valor'>{$row3['TOTAL']}</td>
                        </tr>";
                    }

                    $patrimonioTotal = $totalPatrimonio['TOTAL'];
                    echo "<tr>
                            <th>Total Patrimonio</th>
                            <td class='valor'>{$patrimonioTotal}</td>
                        </tr>";
                    
                    $patrimonioMasPasivo = $patrimonioTotal + $totalPasivos['TOTAL'];
                    echo "<tr>
                            <th>Total Patrimonio + Pasivos</th>
                            <td class='valor cierreTmp'>{$patrimonioMasPasivo}</td>
                        </tr>";

                    // Verificar si el balance no está cuadrado
                    $tolerancia = 0.01; // Define una tolerancia pequeña
                    if (abs($totalActivos['TOTAL'] - $patrimonioMasPasivo) > $tolerancia) {
                        echo "<tr>
                            <th colspan='2' id='errorB' class='error'>¡El balance no está cuadrado!</th>
                        </tr>";
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</section>

</body>
</html>
