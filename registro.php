<?php include 'templates/header.php'; ?>

<main class="imagenFondo"></br></br>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card blue lighten-5">
                    </br>
                    <div class="card-header">
                        <div class="row g-0 text-center">
                            <div class="col-sm-6 col-md-8 align-self-center">REGISTRO DE USUARIO</div>
                            <div class="col-6 col-md-4 align-self-center"><img src="assets/images/logoIsobert.png" width="100px" class="img-fluid rounded-top" alt="logo Odontologa Isobert Mujica"></div>
                        </div>
                        <div>
                            <a href="login.php" class="textMenuIzq right">¿Ya estás registrado? INGRESA AQUÍ</a>
                            </br>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $url_base;?>secciones/usuarios/controllerUsers.php" method="POST">
                            <div class="mb-3"> 
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" required name="nombre" id="nombre" aria-describedby="helpId" oninput="validarFormulario();"></br>

                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" required name="apellidos" id="apellidos" aria-describedby="helpId" oninput="validarFormulario();"></br>

                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" required name="email" id="email" aria-describedby="helpId" oninput="validarFormulario();"></br>

                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" required name="telefono" id="telefono" aria-describedby="helpId" onkeyup="validarTelefono();" oninput="validarFormulario();">
                                <span id="spanTlf" class="red-text ocultar">*El teléfono debe tener 9 dígitos numéricos</span></br>
                                
                                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" required name="fechaNacimiento" id="fechaNacimiento" aria-describedby="helpId" max="<?php echo date('Y-m-d'); ?>" oninput="validarFormulario();"></br>

                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control"  required name="direccion" id="direccion" aria-describedby="helpId" oninput="validarFormulario();"></br>

                                <div class="mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select class="form-select form-select-lg" required name="sexo" id="sexo" oninput="validarFormulario();">
                                        <option selected>Select one</option>
                                        <option value="m">Mujer</option>
                                        <option value="h">Hombre</option>
                                        <option value="o">Otro</option>
                                        <option value="n">No quiero decirlo</option>
                                    </select>
                                </div> 

                                <label for="contrasenia">Contraseña</label>
                                <input type="password" class="form-control" required name="contrasenia" id="contrasenia" aria-describedby="helpId" onkeyup="validarPassReg();" oninput="validarFormulario();">
                                <span id="spanPass" class="red-text ocultar">*La contraseña debe tener más de 8 caracteres alfanuméricos.</span></br>
                            </div>
                            
                            <div class="row">
                                <input type="hidden" name="nuevoUsuario" value="nuevoUsuario">
                                    <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" id="politicaPrivacidad" required />
                                        <span class=" light-blue-text text-darken-4"><a href="assets/documents/avisoLegal.pdf">Acepto la política de privacidad</a></span>
                                    </label>
                                    </p>

                                
                                <button type="submit" class="waves-effect waves-light btn blue align-self-center" id="btnAgregar" disabled>ENVIAR</button></br></br>
                                <button type="reset" class="waves-effect waves-light btn white  blue-grey-text text-darken-2 align-self-center">Borrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div> 
</main>
<script src="<?php echo 'js/javascript.js';?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<?php include 'templates/footer.php'; ?> 
