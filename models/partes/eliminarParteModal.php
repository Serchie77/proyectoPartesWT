<div class="modal fade" id="eliminarParteModal" tabindex="-1" aria-labelledby="eliminarParteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="eliminarParteModalLabel"><i class="fa-solid fa-triangle-exclamation"></i> Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Realmente desea eliminar?</p>
                <!-- Formulario para eliminar de la BD -->
                <form action="eliminarParte.php" method="POST">
                    <!-- Campo oculto para saber qué registro se eliminará -->
                    <input type="hidden" name="idParte" id="idParte">

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash-alt"></i> Confirmar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>