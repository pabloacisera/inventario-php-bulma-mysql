<section class="section">
    <div class="container">
        
        <h1 class="title">Agregar Proveedor</h1>
        <form action="http://localhost/firstApp/php/save_provider.php" method="post" class="f_ajax">
            
            <div class="field">
                <label class="label">Nombre y Apellido (Titular)</label>
                <div class="control">
                    <input class="input" type="text" name="nombre_apellido" placeholder="Ej: Juan Pérez" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Empresa</label>
                <div class="control">
                    <input class="input" type="text" name="empresa" placeholder="Nombre de la empresa" required>
                </div>
            </div>

            <div class="field">
                <label class="label">CUIT</label>
                <div class="control">
                    <input class="input" type="text" name="cuit" placeholder="20-12345678-9" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Dirección</label>
                <div class="control">
                    <input class="input" type="text" name="direccion" placeholder="Ej: Calle 123, Ciudad, Provincia" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email" placeholder="ejemplo@empresa.com" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Teléfono</label>
                <div class="control">
                    <input class="input" type="tel" name="telefono" placeholder="Ej: +54 11 1234-5678" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Tipo de Servicio/Producto</label>
                <div class="control">
                    <div class="select">
                        <select name="tipo_servicio">
                            <option value="">Seleccione una opción</option>
                            <option value="producto">Producto</option>
                            <option value="servicio">Servicio</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Condiciones de Pago</label>
                <div class="control">
                    <textarea class="textarea" name="condiciones_pago" placeholder="Ej: Pago a 30 días, 50% anticipado, etc."></textarea>
                </div>
            </div>

            <div class="field">
                <label class="label">Descripción del Proveedor</label>
                <div class="control">
                    <textarea class="textarea" name="descripcion" placeholder="Detalles sobre los productos/servicios que ofrece el proveedor"></textarea>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-link" type="submit">Agregar Proveedor</button>
                </div>
                <div class="control">
                    <button class="button is-light" type="reset">Limpiar</button>
                </div>
            </div>

        </form>
        <div class="form-rest"></div>
    </div>
</section>
