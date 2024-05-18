<!-- Modal -->
<div class="modal fade" id="eliminarUsuarioModal" tabindex="-1" aria-labelledby="eliminarUsuarioModalLabel" aria-hidden="true">
    <!-- modal-dialogo tipo sm (small)-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="eliminarUsuarioModalLabel"><i class="fa-solid fa-triangle-exclamation"></i> Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Realmente desea eliminar?
                <div class="modal-footer">
                    <!-- creación el formulario para ELIMINAR de la BD -->
                    <form action="eliminarUsuario.php" method="POST">
                        <!-- creación id para saber qué registro se eliminará -->
                        <input type="hidden" name="idUsuario" id="idUsuario">


                        
                        <!-- Botones -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-eraser"></i> Confirmar</button>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>