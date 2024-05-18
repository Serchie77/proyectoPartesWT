<!-- Modal -->
<div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" aria-labelledby="nuevoUsuarioModalLabel" aria-hidden="true">

    <!-- modal-dialogo tipo lg -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="nuevoUsuarioModalLabel"> Agregar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- creamos el formulario para agregar a la BD || enctype... para reconocer archivos-->
                <form action="guardarUsuario.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos: </label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección: </label>
                        <input type="text" name="direccion" id="direccion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono / Móvil: </label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required minlength="9">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico: </label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Alias: </label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña: </label>
                        <input type="password" name="password" id="password" class="form-control" required maxlength="15" minlength="8">
                    </div>
                    <div class="mb-3">
                        <label for="idRol" class="form-label">Tipo de Rol: </label>
                        <select name="idRol" id="idRol" class="form-select" required>
                            <option value="">Selecciona tipo de rol...</option>
                            <?php while ($registro = $consultaRol->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $registro['idRol']; ?>">
                                    <?php echo $registro['rol']; ?>
                                </option>
                            <?php } ?>
                        </select>
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