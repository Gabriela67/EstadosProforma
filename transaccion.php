<?php

include("header.php");

// Establece una conexión a la base de datos MySQL
$mysqli = new mysqli("localhost", "root", "", "contabilidad");

// Verifica si la conexión a la base de datos fue exitosa
if ($mysqli->connect_error) {
    die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
}

// Comprueba si la solicitud HTTP es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $cuenta1 = $_POST["cuenta1"];
    $valor1 = $_POST["valor1"];
    $tipo1 = $_POST["tipo"];
    $fecha = $_POST["fecha"];

    // Realiza una consulta para obtener el valor actual de "TOTAL" para la cuenta específica
    $query = "SELECT TOTAL FROM cuentas WHERE DETALLE = ?";
    $stmtGetTotal = $mysqli->prepare($query);

    // Verifica si la consulta preparada se ejecuta correctamente
    if ($stmtGetTotal) {
        $stmtGetTotal->bind_param("s", $cuenta1);
        $stmtGetTotal->execute();
        $stmtGetTotal->bind_result($total);
        $stmtGetTotal->fetch();
        $stmtGetTotal->close();

        // Calcula el nuevo valor de "TOTAL" para la cuenta específica
        $nuevoTotal = $total + ($tipo1 == 1 ? $valor1 : -$valor1); // Suma si es Debe, resta si es Haber

        // Actualiza el campo "TOTAL" en la tabla "cuentas" para la cuenta específica
        $queryUpdate = "UPDATE cuentas SET TOTAL = ? WHERE DETALLE = ?";
        $stmtUpdate = $mysqli->prepare($queryUpdate);

        // Verifica si la consulta preparada se ejecuta correctamente
        if ($stmtUpdate) {
            $stmtUpdate->bind_param("ss", $nuevoTotal, $cuenta1);

            // Ejecuta la consulta de actualización
            if ($stmtUpdate->execute()) {
                // La actualización en la tabla "cuentas" para la cuenta específica fue exitosa
                // Puedes mostrar un mensaje de éxito aquí
                echo '<script type="text/javascript">
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Transaccion Realizada con exito",
                    showConfirmButton: false,
                    timer: 1500
                  })
                 </script>';
            } else {
                echo "Error al actualizar el campo 'TOTAL': " . $stmtUpdate->error;
            }

            $stmtUpdate->close();
        } else {
            echo "Error en la preparación de la consulta de actualización: " . $mysqli->error;
        }
    } else {
        echo "Error al obtener el valor actual de 'TOTAL': " . $stmtGetTotal->error;
    }
}
?>

<section class="contenido">
    <header class="tituloContenido">
        <h2>Nueva Transaccion</h2>
    </header>

    <section id="nuevaTransacion">
        <table class='styled-table table-xl table-striped'>
            <form action="transaccion.php" method="POST">
                <div class="fecha">
                    <label for "" class="tituloContenido">Fecha</label>
                    <input name="fecha" type="date" class="styled-date-input" placeholder="aaaa-mm-dd" required>
                </div>
                <tr>
                    <th>CUENTA</th>
                    <th>VALOR</th>
                    <th>TIPO TRANSACCION</th>
                </tr>
                <tr>
                    <td>
                        <?php
                        // Realizar una consulta SQL para seleccionar los datos de la tabla "cuentas"
                        $query = "SELECT DETALLE FROM cuentas";
                        $result = $mysqli->query($query);

                        if ($result->num_rows > 0) {
                            echo "<select name='cuenta1' class='styled-select' id='verCuenta'>";
                            echo "<option value=''>Selecciona una cuenta</option>";

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['DETALLE'] . "'>" . $row['DETALLE'] . "</option>";
                            }

                            echo "</select>";
                        } else {
                            echo "No se encontraron cuentas en la base de datos.";
                        }
                        ?>
                    </td>
                    <td><input name="valor1" type="number" class="styled-input" required></td>
                    <td>
                        <select name='tipo' class="styled-select">
                            <option value=1>Debe</option>
                            <option value=2>Haber</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" class="styled-button" value="Hacer Transaccion"></td>
                </tr>
            </form>
        </table>
    </section>
</section>
</body>
</html>
