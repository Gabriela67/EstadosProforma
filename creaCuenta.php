<?php
include("header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $razon = $_POST['tipo'];

    $conn = new mysqli("localhost", "root", "", "contabilidad");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $query2 = "INSERT INTO cuentas (CODIGO, DETALLE, RAZON) VALUES ('$codigo', '$nombre', '$razon')";
    if ($conn->query($query2) === TRUE) {
        echo "Registro insertado exitosamente";
        echo '<script type="text/javascript">
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Cuenta creada con exito",
            showConfirmButton: false,
            timer: 1500
          })
         </script>';
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }

    $conn->close();
}
?>

<section class="contenido">
    <header class="tituloContenido">
        <h2>Crear Nueva Cuenta</h2>
    </header>
    <section id="nuevaCuenta">
        <form method="POST" action="creaCuenta.php">
            <label class="cuentaTitulo"><h3>Tipo de Cuenta</h3></label>
            <select name="tipo" class="opcionCuenta styled-select ">
                <option value="Activo">Activo</option>
                <option value="Pasivo">Pasivo</option>
                <option value="Patrimonio">Patrimonio</option>
                <option value="Gasto">Gastos</option>
                <option value="Ingreso">Ingresos</option>
            </select>
            <label class="cuentaTitulo"><h3>Nombre de Cuenta</h3></label>
            <input type="text" name="nombre" class="opcionCuenta styled-input" placeholder="Nombre de la cuenta" required>

            <label class="cuentaTitulo"><h3>Codigo de Cuenta</h3></label>
            <input type="number" name="codigo" class="opcionCuenta styled-input" placeholder="Codigo de la cuenta" required>

            <input type="submit" class="styled-button" value="Crear Cuenta">
        </form>
    </section>
</section>
</body>
</html>
