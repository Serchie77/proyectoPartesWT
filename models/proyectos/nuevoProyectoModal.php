<!-- Modal -->
<div class="modal fade" id="nuevoProyectoModal" tabindex="-1" aria-labelledby="nuevoProyectoModalLabel" aria-hidden="true">

    <!-- modal-dialogo tipo lg -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="nuevoProyectoModalLabel"> Agregar Proyecto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- creamos el formulario para agregar a la BD || enctype... para reconocer archivos-->
                <form action="guardarProyecto.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del proyecto: </label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar del proyecto: </label>
                        <input type="text" name="lugar" id="lugar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fechaInicio" class="form-label">Fecha inicial del proyecto: </label>
                        <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fechaFin" class="form-label">Fecha final del proyecto: </label>
                        <input type="date" name="fechaFin" id="fechaFin" class="form-control" required>
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
                        <button type="submit" class="btn btn-success"> <i class="fa-regular fa-floppy-disk"></i> Guardar proyecto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>