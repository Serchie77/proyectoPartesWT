<div class="modal fade" id="eliminarHoraModal" tabindex="-1" aria-labelledby="eliminarHoraModalLabel" aria-hidden="true">
    <!-- modal-dialogo tipo sm (small)-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="eliminarHoraModalLabel"><i class="fa-solid fa-triangle-exclamation"></i> Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea realmente eliminarlo?
            </div>
            <div class="modal-footer">
                <!-- creamos el formulario para ELIMINAR de la BD -->
                <form action="eliminarHora.php" method="POST">
                    <!-- creación id para saber qué registro se eliminará -->
                    <input type="hidden" name="idParteHora" id="idParteHora">
                    <!-- Botones -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-eraser"></i>
                        Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
