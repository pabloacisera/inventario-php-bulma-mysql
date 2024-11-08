    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">

        <a href="http://localhost/firstApp/index.php">
        <img src="http://localhost/firstApp/img/logo_a.jpg" alt="logo-inventify" class="navbar-logo" />
        </a>        
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">

            
            <div class="navbar-start">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Proveedores</a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" onclick="loadContent('providers/list')">Listado</a>
                        <a class="navbar-item" onclick="loadContent('providers/new')">Nuevo</a>
                    </div>
                </div>
            </div>

            <div class="navbar-start">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Productos</a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" onclick="loadContent('products/list')">Listado</a>
                        <a class="navbar-item" onclick="loadContent('products/new')">Nuevo</a>
                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary"><strong>Cuenta</strong></a>
                        <a class="button is-link">Salir</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <style>
  /* Aseguramos que la imagen se ajuste a la altura de los elementos de la barra de navegación */
  .navbar-logo {
    max-width: 5rem;
    max-height: 5rem; /* Ajusta esto según el tamaño de la barra (Bulma suele usar 3rem de alto) */
    margin-right: 10px; /* Espacio opcional a la derecha de la imagen */
    border-radius: 50%;
    margin-left: 5px;
    margin-top: 5px;
  }
</style>

