<div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="editarClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5 text-white" id="editarClienteModalLabel">
                    <i class="fa-solid fa-file-pen"></i> Editar Cliente
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para recoger datos y actualizar en la BD -->
                <form action="/proyectoWT/models/clientes/actualizarCliente.php" method="POST" enctype="multipart/form-data">
                    <!-- Campo oculto para el ID del cliente -->
                    <input type="hidden" name="idCliente" id="idCliente">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellidos" class="form-label">Apellidos:</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="tel" name="telefono" id="telefono" class="form-control" pattern="[0-9]{9}" title="Ingrese un número de teléfono válido (9 dígitos)" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="comentarios" class="form-label">Comentarios:</label>
                        <textarea name="comentarios" id="comentarios" class="form-control"></textarea>
                    </div>
                    
                    <!-- Botones del modal -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa-regular fa-floppy-disk"></i> Confirmar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
