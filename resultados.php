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
            <h2>Estado de Resultados</h2>
            <h2>Julio 2023</h2>
        </hgroup>
    </header>
    <table class="styled-table">
        <?php

        // Consulta para obtener los ingresos (haber)
        $consultaIngresos = $mysqli->query("SELECT * FROM cuentas WHERE RAZON='Ingreso'");
        $totalIngresos = 0;
        while ($row1 = $consultaIngresos->fetch_assoc()) {
            $totalIngresos += $row1['TOTAL'];
        }

        // Consulta para obtener los gastos (debe)
        $consultaGastos = $mysqli->query("SELECT * FROM cuentas WHERE RAZON='Gasto'");
        $totalGastos = 0;
        while ($row2 = $consultaGastos->fetch_assoc()) {
            $totalGastos += $row2['TOTAL'];
        }

        echo "<tr>
                <th>1. Total Ingresos</th>
                <td></td>
                <td></td>
                <td class='valor cierre'>$totalIngresos</td>
            </tr>";

        // Mostrar los detalles de los ingresos
        $consultaIngresos = $mysqli->query("SELECT * FROM cuentas WHERE RAZON='Ingreso'");
        while ($fila = $consultaIngresos->fetch_assoc()) {
            echo "<tr>
                    <td></td>
                    <td>{$fila['DETALLE']}</td>
                    <td class='valor'>{$fila['TOTAL']}</td>
                    <td></td>
                </tr>";
        }

        echo "<tr>
                <th>2. Total Gastos</th>
                <td></td>
                <td></td>
                <td class='valor cierre'>$totalGastos</td>
            </tr>";

        // Mostrar los detalles de los gastos
        $consultaGastos = $mysqli->query("SELECT * FROM cuentas WHERE RAZON='Gasto'");
        while ($fila = $consultaGastos->fetch_assoc()) {
            echo "<tr>
                    <td></td>
                    <td>{$fila['DETALLE']}</td>
                    <td class='valor'>{$fila['TOTAL']}</td>
                    <td></td>
                </tr>";
        }

        $utilidadAntesImpuestos = $totalIngresos - $totalGastos;

        echo "<tr>
                <th>3. Utilidad Antes de Impuestos</th>
                <td></td>
                <td></td>
                <td class='valor cierre'>$utilidadAntesImpuestos</td>
            </tr>";

        $impuesto = $utilidadAntesImpuestos * 0.13;

        echo "<tr>
                <th>4. Impuestos 13%</th>
                <td></td>
                <td></td>
                <td class='valor cierre'>$impuesto</td>
            </tr>";

        $utilidadNeta = $utilidadAntesImpuestos - $impuesto;
        echo "<tr>
                <th>5. Utilidad Neta</th>
                <td></td>
                <td></td>
                <td class='valor cierre'>$utilidadNeta</td>
            </tr>";
        ?>
    </table>
</section>

</body>
</html>
