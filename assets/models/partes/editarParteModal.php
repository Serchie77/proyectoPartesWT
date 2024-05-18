<!-- Modal -->
<div class="modal fade" id="editarParteModal" tabindex="-1" aria-labelledby="editarParteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5 text-white" id="editarParteodalLabel"><i class="fa-solid fa-file-pen"></i> Editar Horas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Formulario para actualizar datos -->
                <form action="actualizarParte.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idParte" id="idParte">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fechaInicio" class="form-label">Fecha Inicio Trabajo: </label>
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaFin" class="form-label">Fecha Final Trabajo: </label>
                            <input type="date" name="fechaFin" id="fechaFin" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="idUsuario" class="form-label">Trabajador asociado: </label>
                            <select name="idUsuario" id="idUsuario" class="form-select form-select-sm" required>
                                <option value="">Selecciona el trabajador...</option>
                                <?php while ($registro = $consultaUsuario->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $registro['idUsuario']; ?>">
                                        <?php echo $registro['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="idProyecto" class="form-label">Proyecto asociado: </label>
                            <select name="idProyecto" id="idProyecto" class="form-select form-select-sm" required>
                                <option value="">Selecciona el proyecto...</option>
                                <?php while ($registro = $consultaProyecto->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $registro['idProyecto']; ?>">
                                        <?php echo $registro['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="totalHorasNormales" class="form-label">Total horas: </label>
                            <input type="text" name="totalHorasNormales" id="totalHorasNormales" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="totalHorasExtras" class="form-label">Total horas Extras: </label>
                            <input type="text" name="totalHorasExtras" id="totalHorasExtras" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="horasViaje" class="form-label">Horas Viaje: </label>
                            <input type="text" name="horasViaje" id="horasViaje" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comentarios" class="form-label ">Comentarios: </label>
                        <textarea name="comentarios" id="comentarios" class="form-control"></textarea>
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

