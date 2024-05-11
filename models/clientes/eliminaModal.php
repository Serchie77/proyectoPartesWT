<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <!-- modal-dialogo tipo sm (small)-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="eliminaModalLabel"> Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el cliente?
                <div class="modal-footer">

                    <!-- creamos el formulario para ELIMINAR de la BD -->
                    <form action="elimina.php" method="POST">
                        <!-- creación id para saber qué registro se eliminará -->
                        <input type="hidden" name="idCliente" id="idCliente">
                        <!-- Botones -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-floppy-disk"></i>
                            Eliminar</button>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>