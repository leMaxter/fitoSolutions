
var editarModal = document.getElementById('modalEditar');
editarModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var nombre = button.getAttribute('data-nombre');
    var descripcion = button.getAttribute('data-descripcion');

    var modalIdInput = editarModal.querySelector('#editar_id');
    var modalNombreInput = editarModal.querySelector('#editar_nombre');
    var modalDescripcionInput = editarModal.querySelector('#editar_descripcion');

    modalIdInput.value = id;
    modalNombreInput.value = nombre;
    modalDescripcionInput.value = descripcion;
});

var eliminarModal = document.getElementById('modalEliminar');
eliminarModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Botón que activó el modal
    var id = button.getAttribute('data-id'); // Obtener el id del botón

    var modalIdInput = eliminarModal.querySelector('#eliminar_id');
    modalIdInput.value = id; // Asignar el id al campo oculto
});

