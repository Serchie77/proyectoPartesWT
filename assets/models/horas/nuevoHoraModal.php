<!-- Modal -->
<div class="modal fade" id="nuevoHoraModal" tabindex="-1" aria-labelledby="nuevoHoraModalLabel" aria-hidden="true">

    <!-- modal-dialogo tipo lg -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="nuevoHoraModalLabel"> Agregar Parte de Horas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- creamos el formulario para agregar a la BD || enctype... para reconocer archivos-->
                <form action="guardarHora.php" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                        <label for="fecha" class="form-label">Introduce la fecha: </label>
                        <input type="date" name="fecha" id="fecha" class="form-control form-control-sm" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="horasNormales" class="form-label">Total horas (15 min = 0,25 h): </label>
                            <input type="text" name="horasNormales" id="horasNormales" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="horasExtras" class="form-label">Total horas Extras: </label>
                            <input type="text" name="horasExtras" id="horasExtras" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="idParte" class="form-label">Parte de Trabajo asociado: </label>
                            <select name="idParte" id="idParte" class="form-select form-select-sm" required>
                                <option value="">Selecciona...</option>
                                <?php while ($registro = $consultaParte->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $registro['idParte']; ?>">
                                        <?php echo $registro['idParte']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="idUsuario" class="form-label">Usuario asociado: </label>
                            <select name="idUsuario" id="idUsuario" class="form-select form-select-sm" required>
                                <option value="">Selecciona...</option>
                                <?php while ($registro = $consultaUsuario->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $registro['idUsuario']; ?>">
                                        <?php echo $registro['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"> <i class="fa-regular fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>