document.addEventListener('DOMContentLoaded', function () {
  const seleccionar = document.querySelectorAll('.sidebar-link');

  document.querySelector('.toggle-btn').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('collapsed');
  });
  

  seleccionar.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const contentUrl = this.getAttribute('data-content');

      fetch(contentUrl)
        .then(response => response.text())
        .then(data => {
          const temporalDiv = document.createElement('div');
          temporalDiv.innerHTML = data;

          // Esto no va de ninguna forma jaja, tengo que informarme sobre  AJAX
          const estiloPagina = temporalDiv.querySelectorAll('link[rel="stylesheet"]');
          estiloPagina.forEach(style => {
            if (!document.head.querySelector(`link[href="${style.href}"]`)) {
              document.head.appendChild(style);
            }
          });
          //

          document.querySelector('main .container-fluid').innerHTML = temporalDiv.innerHTML;
          initializeFormHandler(); 
        })
        .catch(error => console.error('Ha ocurrido un error:', error));
    });
  });

  function initializeFormHandler() {
    }

  initializeFormHandler();
});
