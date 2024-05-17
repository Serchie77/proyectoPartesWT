<!-- Modal -->
<div class="modal fade" id="editarHoraModal" tabindex="-1" aria-labelledby="editarHoraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5 text-white" id="editarHoraModalLabel"><i class="fa-solid fa-file-pen"></i> Editar Horas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Formulario para actualizar datos -->
                <form action="actualizarHora.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idParteHora" id="idParteHora">

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Introduce la fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control form-control-sm" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="horasNormales" class="form-label">Horas Normales:</label>
                            <input type="text" name="horasNormales" id="horasNormales" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="horasExtras" class="form-label">Horas Extras:</label>
                            <input type="text" name="horasExtras" id="horasExtras" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="idParte" class="form-label">Parte de Trabajo asociado:</label>
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
                            <label for="idUsuario" class="form-label">Usuario asociado:</label>
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
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success ms-2"><i class="fa-regular fa-floppy-disk"></i> Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

