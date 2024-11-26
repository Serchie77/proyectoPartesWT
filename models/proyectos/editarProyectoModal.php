<!-- Modal -->
<div class="modal fade" id="editarProyectoModal" tabindex="-1" aria-labelledby="editarProyectoModalLabel" aria-hidden="true">
    <!-- modal-dialogo tipo lg / sm (long / small-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5 text-white" id="editarProyectoModalLabel"><i class="fa-solid fa-file-pen"></i> Editar Proyecto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- creamos el formulario para -recoger datos- a la BD || enctype... para reconocer archivos-->
                <form action="actualizarProyecto.php" method="POST" enctype="multipart/form-data">

                    <!-- creación id para saber qué registro se editará -->
                    <input type="hidden" name="idProyecto" id="idProyecto">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre del proyecto: </label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lugar" class="form-label">Lugar del proyecto: </label>
                            <input type="text" name="lugar" id="lugar" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaInicio" class="form-label">Fecha inicial del proyecto: </label>
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaFin" class="form-label">Fecha final del proyecto: </label>
                            <input type="date" name="fechaFin" id="fechaFin" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="idCliente" class="form-label">Cliente: </label>
                        <select name="idCliente" id="idCliente" class="form-select" required>
                            <option value="">Seleccionar cliente asociado...</option>
                            <?php while ($registro = $consultaCliente->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $registro['idCliente']; ?>">
                                    <?php echo $registro['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Botones -->
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"> <i class="fa-regular fa-floppy-disk"></i>
                            Confirmar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>