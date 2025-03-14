
var editarModal = document.getElementById('editarModal');
editarModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  var id = button.getAttribute('data-id');
  var nombre = button.getAttribute('data-nombre');
  var descripcion = button.getAttribute('data-descripcion');
  var precio = button.getAttribute('data-precio');
  var categoria = button.getAttribute('data-categoria');
  var proveedor = button.getAttribute('data-proveedor');

  var modalIdInput = editarModal.querySelector('#editar_id');
  var modalNombreInput = editarModal.querySelector('#editar_nombre');
  var modalDescripcionInput = editarModal.querySelector('#editar_descripcion');
  var modalPrecioInput = editarModal.querySelector('#editar_precio');
  var modalCategoriaInput = editarModal.querySelector('#editar_categoria');
  var modalProveedorInput = editarModal.querySelector('#editar_proveedor');

  modalIdInput.value = id;
  modalNombreInput.value = nombre;
  modalDescripcionInput.value = descripcion;
  modalPrecioInput.value = precio;
  modalCategoriaInput.value = categoria;
  modalProveedorInput.value = proveedor;
});

var eliminarModal = document.getElementById('eliminarModal');
eliminarModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  var id = button.getAttribute('data-id');

  var modalIdInput = eliminarModal.querySelector('#eliminar_id');
  modalIdInput.value = id;
});
