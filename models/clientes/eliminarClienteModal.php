<!-- Modal -->
<div class="modal fade" id="eliminarClienteModal" tabindex="-1" aria-labelledby="eliminarClienteModalLabel" aria-hidden="true">
    <!-- modal-dialogo tipo sm (small)-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="eliminarClienteModalLabel"> Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea realmente eliminarlo?
                <div class="modal-footer">

                    <!-- creamos el formulario para ELIMINAR de la BD -->
                    <form action="eliminarCliente.php" method="POST">
                        <!-- creación id para saber qué registro se eliminará -->
                        <input type="hidden" name="idCliente" id="idCliente">
                        <!-- Botones -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"> <i class="fa-solid fa-floppy-disk"></i>
                            Eliminar</button>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>