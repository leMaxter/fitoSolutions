    var editarModal = document.getElementById('editarModal');
    editarModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Botón que abrió el modal
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var direccion = button.getAttribute('data-direccion');
        var telefono = button.getAttribute('data-telefono');
        var correo = button.getAttribute('data-correo');

        // Asignar los valores a los campos correspondientes del formulario
        document.getElementById('editar_id').value = id;
        document.getElementById('editar_nombre').value = nombre;
        document.getElementById('editar_direccion').value = direccion;
        document.getElementById('editar_telefono').value = telefono;
        document.getElementById('editar_correo').value = correo;
    });

    // Establecer el ID del proveedor en el modal de eliminación
    var eliminarModal = document.getElementById('eliminarModal');
    eliminarModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        document.getElementById('eliminar_id').value = id;
    });

