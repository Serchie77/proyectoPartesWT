<!-- Modal -->
<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <!-- modal-dialogo tipo lg / sm (long / small-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editaModalLabel"> <i class="fa-solid fa-user-pen"></i> Editar Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- creamos el formulario para -recoger datos- a la BD || enctype... para reconocer archivos-->
                <form action="actualiza.php" method="POST" enctype="multipart/form-data">

                    <!-- creación id para saber qué registro se editará -->
                    <input type="hidden" name="idCliente" id="idCliente">

                    <div class="mb-3">
                        <label for="nombre" class="form-label ">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label ">Apellidos: </label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label ">E-mail: </label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label ">Teléfono: </label>
                        <input type="tel" name="telefono" id="telefono" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label ">Dirección: </label>
                        <input type="text" name="direccion" id="direccion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="comentarios" class="form-label ">Comentarios: </label>
                        <textarea name="comentarios" id="comentarios" class="form-control"></textarea>
                    </div>
                    <!-- Botones -->
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary justify"> <i class="fa-regular fa-floppy-disk"></i>
                            Actualizar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>