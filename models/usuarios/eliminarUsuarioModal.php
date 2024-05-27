<div class="modal fade" id="eliminarUsuarioModal" tabindex="-1" aria-labelledby="eliminarUsuarioModalLabel" aria-hidden="true">
    <!-- Modal diálogo tamaño sm (small) -->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="eliminarUsuarioModalLabel">
                    <i class="fa-solid fa-exclamation-triangle"></i> Aviso
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Realmente desea eliminar?
                <div class="modal-footer">
                    <!-- Formulario para eliminar de la base de datos -->
                    <form action="/proyectoWT/models/usuarios/eliminarUsuario.php" method="POST">
                        <!-- ID del registro a eliminar -->
                        <input type="hidden" name="idUsuario" id="idUsuario">

                        <!-- Botones -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">
                        <i class="fas fa-trash">></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
