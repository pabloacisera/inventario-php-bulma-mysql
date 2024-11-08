<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bulma.min.css">
    <title>Home</title>
    <script src="./js/ajax.js" ></script>
    <script>
    function loadContent(ruta) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', './index.php?ruta=' + ruta, true);
        xhr.onload = function() {
            if (this.status === 200) {
                document.getElementById('main-content').innerHTML = this.responseText;

                // Volver a vincular los formularios después de cargar el contenido dinámico
                bindAjaxForms();

                // Cambiar URL sin recargar la página
                history.pushState(null, '', './index.php?ruta=' + ruta);
            } else {
                document.getElementById('main-content').innerHTML = '<h1>Error 404: Página no encontrada</h1>';
            }
        };
        xhr.send();
    }
    // Cargar ajax y asociar eventos al cargar la página
    window.onload = function() {
        // Asociar el evento 'submit' a los formularios
        bindAjaxForms();

        const currentRoute = new URLSearchParams(window.location.search).get('ruta');
        if (!currentRoute) {
            loadContent('home');
        }
    };
    </script>
</head>
<body>
    <div id="main-content">
        <?php
        include "./inc/nabvar.php";
        $ruta = isset($_GET['ruta']) ? $_GET['ruta'] : 'home';

        switch ($ruta) {
            case 'home':
                include "./pages/home.php";
                break;
            case 'providers/list':
                include "./pages/routes/providers/providers_list.php";
                break;
            case 'providers/new':
                include "./pages/routes/providers/new_providers.php";
                break;
            case 'products/list':
                include "./pages/routes/products/products_list.php";
                break;
            case 'products/new':
                include "./pages/routes/products/new_products.php";
                break;
            default:
                include "./pages/404.php";
                break;
        }
        ?>
    </div>
</body>
</html>


