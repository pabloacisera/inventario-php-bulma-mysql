<section class="section">
    <div class="container">
        <!-- Sección de Descarga y Carga de Excel -->
        <div class="box mb-6">
            <!-- Mensaje de Instrucción -->
            <div class="notification is-info has-text-centered">
            <p class="mb-4">Por favor, descargue el archivo Excel con las columnas requeridas, complete los datos y luego cárguelo en el campo de carga para procesarlo. Cuando descargue el archivo, asegúrese de nombrarlo como el nombre de la tabla en la que desea guardar los datos. Por ejemplo, si desea cargar datos en la tabla de proveedores, el archivo debe llamarse <strong>proveedores.xlsx</strong>.</p>

            <p class="title is-5 mb-3">Las tablas disponibles para cargar son:</p>
            <ul class="content">
                <li><i class="fas fa-file-excel mr-2"></i><strong>proveedores.xlsx</strong> - Para cargar datos en la tabla de proveedores.</li>
                <li><i class="fas fa-file-excel mr-2"></i><strong>productos.xlsx</strong> - Para cargar datos en la tabla de productos.</li>
                <li><i class="fas fa-file-excel mr-2"></i><strong>clientes.xlsx</strong> - Para cargar datos en la tabla de clientes.</li>
                <li><i class="fas fa-file-excel mr-2"></i><strong>sueldos.xlsx</strong> - Para cargar datos en la tabla de sueldos.</li>
                <li><i class="fas fa-file-excel mr-2"></i><strong>trabajadores.xlsx</strong> - Para cargar datos en la tabla de trabajadores.</li>
            </ul>
            </div>


            <!-- Título de la sección -->
            <h2 class="title is-4">Descargar y Cargar Archivo Excel</h2>

            <!-- Botón de Descargar Excel -->
            <div class="control mb-4">
                <button type="button" class="button is-success" id="btn-descargar-excel">Descargar Excel</button>
            </div>

            <!-- Área de Carga de Archivo -->
            <div class="field mt-5">
                <label class="label">Cargar Archivo Excel Completo</label>
                <div class="control">
                    <div class="file is-centered has-name is-boxed is-info" id="file-drop-zone">
                        <label class="file-label">
                            <input class="file-input" type="file" name="archivo_excel" id="archivo_excel" accept=".xlsx">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Arrastra el archivo aquí o haz clic para seleccionarlo
                                </span>
                            </span>
                            <span class="file-name" id="file-name">No se ha seleccionado ningún archivo</span>
                        </label>
                    </div>
                </div>
                <p class="help is-success" id="file-ready-message" style="display: none;">Archivo cargado y listo para ser enviado.</p>
            </div>

            <!-- Botón de Carga -->
            <div class="control mt-4">
                <button type="button" class="button is-link" id="btn-cargar-archivo" disabled>Cargar Archivo</button>
            </div>
        </div>

        <!-- Línea divisora -->
        <hr class="is-divider my-6">

        <!-- Sección de Formulario de Agregar Proveedor -->
        <div class="box">
            <!-- Título de la sección -->
            <h2 class="title is-4">Agregar Proveedor Manualmente</h2>

            <form action="http://localhost/firstApp/php/save_provider.php" method="post" class="f_ajax">
                <!-- Campos del formulario -->
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
        </div>
    </div>
</section>

<!-- Estilos personalizados -->
<style>
    /* Mejorar la apariencia del contenedor de carga */
    .file {
        background-color: #f1f5f9; /* Fondo claro para el área de carga */
        border-radius: 5px;
        padding: 15px;
        border: 2px dashed #00d1b2; /* Borde sutil y colorido */
        transition: border-color 0.3s ease;
    }

    .file:hover {
        border-color: #00c4a7; /* Cambia de color al pasar el ratón */
    }

    .file-cta {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        background-color: #00d1b2; /* Botón de acción con color verde */
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .file-cta:hover {
        background-color: #00c4a7; /* Cambiar color al pasar el ratón */
    }

    .file-icon {
        margin-right: 10px;
    }

    .file-name {
        font-size: 0.9rem;
        color: #4a4a4a;
        margin-top: 10px;
    }

    /* Estilo adicional para el mensaje de archivo cargado */
    .help.is-success {
        font-size: 1rem;
        color: #23d160;
        font-weight: bold;
        margin-top: 10px;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Botón de Descarga de Excel
    document.getElementById("btn-descargar-excel").addEventListener("click", function() {
        const formElements = document.querySelector("form.f_ajax").elements;
        const columnNames = [];

        for (let element of formElements) {
            if (element.name) {
                columnNames.push(element.name);
            }
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/firstApp/php/xlsx_create.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.responseType = "blob";

        xhr.onload = function() {
            if (xhr.status === 200) {
                const url = window.URL.createObjectURL(xhr.response);
                const a = document.createElement("a");
                a.href = url;
                a.download = "nombres_columnas.xlsx";
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            } else {
                console.error("Error al descargar el archivo:", xhr.statusText);
            }
        };

        xhr.onerror = function() {
            console.error("Error en la conexión con el servidor.");
        };

        xhr.send(JSON.stringify({ columnNames: columnNames }));
    });

    // Carga y envío del archivo Excel
    const dropZone = document.getElementById("file-drop-zone");
    const inputFile = document.getElementById("archivo_excel");
    const fileName = document.getElementById("file-name");
    const fileReadyMessage = document.getElementById("file-ready-message");
    const btnCargarArchivo = document.getElementById("btn-cargar-archivo");

    dropZone.addEventListener("dragover", function(e) {
        e.preventDefault();
        dropZone.classList.add("is-dragover");
    });

    dropZone.addEventListener("dragleave", function() {
        dropZone.classList.remove("is-dragover");
    });

    dropZone.addEventListener("drop", function(e) {
        e.preventDefault();
        dropZone.classList.remove("is-dragover");

        const files = e.dataTransfer.files;
        if (files.length) {
            inputFile.files = files;
            fileName.textContent = files[0].name;
            showFileReady();
        }
    });

    inputFile.addEventListener("change", function() {
        if (inputFile.files.length > 0) {
            fileName.textContent = inputFile.files[0].name;
            showFileReady();
        }
    });

    function showFileReady() {
        fileReadyMessage.style.display = "block";
        fileReadyMessage.textContent = "Archivo cargado y listo para ser enviado.";
        btnCargarArchivo.disabled = false;
    }

    btnCargarArchivo.addEventListener("click", function() {
        const archivo = inputFile.files[0];
        if (archivo) {
            const formData = new FormData();
            formData.append("archivo_excel", archivo);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/firstApp/php/upload_data_from_xlsx.php", true);

            xhr.onload = function() {
            console.log(xhr.responseText); // Verificar respuesta del backend
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                alert(response.message); // Mensaje de éxito
                console.log(response.data); // Muestra datos procesados para depuración
                window.location.href = "http://localhost/firstApp/index.php?ruta=providers/list";
        } else {
            alert(response.message); // Mensaje de error
        }
    } else {
        alert("Error al enviar el archivo.");
    }
};

            xhr.onerror = function() {
                alert("Error en la conexión con el servidor.");
            };

            xhr.send(formData);
        } else {
            alert("Por favor, selecciona un archivo antes de intentar enviarlo.");
        }
    });
});
</script>

