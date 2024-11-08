<?php
require_once "./main.php";


$nombre_apellido = str_clean($_POST["nombre_apellido"]);
$empresa = str_clean($_POST["empresa"]);
$cuit = str_clean($_POST["cuit"]);
$direccion = str_clean($_POST["direccion"]);
$email = str_clean($_POST["email"]);
$telefono = str_clean($_POST["telefono"]);
$tipo_servicio = str_clean($_POST["tipo_servicio"]);
$condiciones_pago = str_clean($_POST["condiciones_pago"]);
$descripcion = str_clean($_POST["descripcion"]);

if ($nombre_apellido == "" || $cuit == "" || $tipo_servicio == "") {
    echo '
        <link rel="stylesheet" href="../css/bulma.min.css">
        <div class="notification-container">
            <section class="hero is-warning is-centered custom-warning">
                <div class="hero-body">
                    <p class="title">Advertencia</p>
                    <p class="subtitle">Datos excluyentes han sido omitidos en el formulario</p>
                    <p>Fecha y hora: ' . date("Y-m-d H:i:s") . '</p>
                </div>
                <p class="navigation-link">Volver a la página anterior <a href="http://localhost/firstApp/index.php?ruta=providers/new">AQUÍ</a></p>
            </section>
        </div>
         <script>
            setTimeout(function() {
                window.location.href = "/firstApp/index.php?ruta=providers/list";
            }, 2000);
        </script>
    ';
    exit();
}

if (!verify_data_form("/^\d{11}$/", $cuit)) {
    echo '
        <link rel="stylesheet" href="../css/bulma.min.css">
        <div class="notification-container">
            <section class="hero is-warning is-centered custom-warning">
                <div class="hero-body">
                    <p class="title">Advertencia</p>
                    <p class="subtitle">El formato del CUIT no coincide con los parámetros esperados para este campo</p>
                    <p>Fecha y hora: ' . date("Y-m-d H:i:s") . '</p>
                </div>
                <p class="navigation-link">Volver a la página anterior <a href="http://localhost/firstApp/index.php?ruta=providers/new">AQUÍ</a></p>
            </section>
        </div>
         <script>
            setTimeout(function() {
                window.location.href = "/firstApp/index.php?ruta=providers/list";
            }, 2000);
        </script>
    ';
    exit();
}

$connection = conn();
$cuit_exists = $connection->query("SELECT cuit FROM proveedores WHERE cuit=$cuit");
if ($cuit_exists->rowCount() > 0) {
    echo '
        <link rel="stylesheet" href="../css/bulma.min.css">
        <div class="notification-container">
            <section class="hero is-warning is-centered custom-warning">
                <div class="hero-body">
                    <p class="title">Advertencia</p>
                    <p class="subtitle">El CUIT ingresado ya existe en la base de datos</p>
                    <p>Fecha y hora: ' . date("Y-m-d H:i:s") . '</p>
                </div>
                <p class="navigation-link">Volver a la página anterior <a href="http://localhost/firstApp/index.php?ruta=providers/new">AQUÍ</a></p>
            </section>
        </div>
         <script>
            setTimeout(function() {
                window.location.href = "/firstApp/index.php?ruta=providers/list";
            }, 2000);
        </script>
    ';
    exit();
}
$cuit_exists = null;

$send_data = $connection->prepare("INSERT INTO proveedores(nombre_apellido, empresa, cuit, direccion, telefono, email, tipo_servicio, condiciones_pago, descripcion) VALUES(:nombre_apellido, :empresa, :cuit, :direccion, :telefono, :email, :tipo_servicio, :condiciones_pago, :descripcion)");

$charge_data = [
    ":nombre_apellido" => $nombre_apellido,
    ":empresa" => $empresa,
    ":cuit" => $cuit,
    ":direccion" => $direccion,
    ":telefono" => $telefono,
    ":email" => $email,
    ":tipo_servicio" => $tipo_servicio,
    ":condiciones_pago" => $condiciones_pago,
    ":descripcion" => $descripcion
];

if ($send_data->execute($charge_data)) {
    echo '
        <link rel="stylesheet" href="../css/bulma.min.css">
        <div class="notification-container">
            <section class="hero is-success is-centered custom-success">
                <div class="hero-body">
                    <p class="title">Éxito</p>
                    <p class="subtitle">Datos guardados exitosamente</p>
                    <p>Fecha y hora: ' . date("Y-m-d H:i:s") . '</p>
                    <p>Nombre: ' . $nombre_apellido . '</p>
                    <p>Empresa: ' . $empresa . '</p>
                    <p>CUIT: ' . $cuit . '</p>
                </div>
            </section>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "/firstApp/index.php?ruta=providers/list";
            }, 2000);
        </script>
    ';
} else {
    echo '
        <link rel="stylesheet" href="../css/bulma.min.css">
        <div class="notification-container">
            <section class="hero is-warning is-centered custom-warning">
                <div class="hero-body">
                    <p class="title">Advertencia</p>
                    <p class="subtitle">Ocurrió un error al guardar los datos</p>
                    <p>Fecha y hora: ' . date("Y-m-d H:i:s") . '</p>
                </div>
                <p class="navigation-link">Volver a la página anterior <a href="http://localhost/firstApp/index.php?ruta=providers/new">AQUÍ</a></p>
            </section>
        </div>
         <script>
            setTimeout(function() {
                window.location.href = "/firstApp/index.php?ruta=providers/list";
            }, 2000);
        </script>
    ';
}
?>

<style>
    /* Asegurarse de que el contenedor esté centrado */
    .notification-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: center;
    }

    /* Estilos personalizados para la clase de advertencia */
    .custom-warning {
        background-color: #ffdd57 !important; /* Amarillo claro de advertencia */
        color: #363636 !important; /* Color del texto */
    }

    /* Estilos personalizados para la clase de éxito */
    .custom-success {
        background-color: #48c774 !important; /* Verde de éxito */
        color: #ffffff !important; /* Color del texto */
    }

    /* Estilo para el enlace de navegación */
    .navigation-link {
        margin-top: 1em;
        font-size: 1.1em;
    }
    .navigation-link a {
        color: #3273dc;
        font-weight: bold;
        text-decoration: underline;
    }
</style>


