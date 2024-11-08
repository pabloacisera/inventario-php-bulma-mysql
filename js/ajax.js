// Función para enviar los datos del formulario usando AJAX
function enviar(e) {
  e.preventDefault();

  let enviar = confirm("¿Quiere enviar el formulario?");

  if (enviar == true) {
    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");

    let config = {
      method: method,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'  // Tipo de contenido correcto
      },
      mode: 'cors',
      cache: 'no-cache',
      body: new URLSearchParams(data)
    };

    fetch(action, config)
      .then(response => response.text())
      .then(response => {
        let container = document.querySelector(".form-rest");
        container.innerHTML = response;
      })
      .catch(error => {
        console.error("Error:", error);
      });
  }
}

// Función para asociar el evento de submit a los formularios .f_ajax
function bindAjaxForms() {
  const f_ajax = document.querySelectorAll(".f_ajax");
  f_ajax.forEach(form => {
    form.removeEventListener("submit", enviar); // Eliminar cualquier listener previo
    form.addEventListener("submit", enviar);    // Asociar el evento submit
  });
}

// Ejecutar la función cuando la página se carga
document.addEventListener("DOMContentLoaded", function() {
  bindAjaxForms();
});
