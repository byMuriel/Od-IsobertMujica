<?php
include '../../templates/header.php';
include '../../controllerLogin.php';
?>

<main class="imagenFondo"><br><br>
  <div class="row">
    <div class="col-md-12 center">
        <h5>NUEVO USUARIO</h5>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Registro de nuevo usuario:
        </div>
        <div class="card-body">
          <form action="controllerUsers.php" enctype="multipart/form-data" method="POST">
                Nombre:
                <input type="text" required class="form-control" name="nombre" id="nombre" oninput="validarFormulario();">
                </br>
                Apellidos:
                <input type="text" required class="form-control" name="apellidos" id="apellidos" oninput="validarFormulario();">
                </br>
                Email:
                <input type="text" required class="form-control" name="email" id="email" oninput="validarFormulario();">
                </br>
                Teléfono:
                <input type="text" required class="form-control" name="telefono" id="telefono" onkeyup="validarTelefono();" oninput="validarFormulario();">
                <span id="spanTlf" class="red-text ocultar">*El teléfono debe tener 9 dígitos numéricos</span></br>
                </br>
                Fecha de Nacimiento:
                <input type="date" required class="form-control" name="fechaNacimiento" id="fechaNacimiento" max="<?php echo date('Y-m-d'); ?>" oninput="validarFormulario();">
                </br>
                Sexo:
                <select class="form-select" required aria-label="Default select example" name="sexo" id="sexo" oninput="validarFormulario();">
                  <option selected>Selecciona una opción</option>
                  <option value="m">Mujer</option>
                  <option value="h">Hombre</option>
                  <option value="o">Otro</option>
                  <option value="n">No quiero decirlo</option>
                </select>
                </br>
                Dirección:
                <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="10" oninput="validarFormulario();"></textarea>
                </br>
                Rol:
                <select class="form-select" required aria-label="Default select example" name="rol" id="rol" oninput="validarFormulario();">
                  <option selected>Selecciona una opción</option>
                  <option value="user" selected>Usuario</option>
                  <option value="admin">Admin</option>
                </select>
                </br>
                Contraseña:
                <input type="password" required class="form-control" name="contrasenia" id="contrasenia" onkeyup="validarPassReg();" oninput="validarFormulario();">
                <span id="spanPass" class="red-text ocultar">*La contraseña debe tener más de 8 caracteres alfanuméricos.</span></br>
                </br>
                <input type="hidden" name="nuevoUsuario" value="nuevoUsuario">
                <div class="row">
                    <button type="submit" class="waves-effect waves-light btn blue align-self-center" id="btnAgregar" disabled>AGREGAR</button></br></br>
                    <button type="reset" class="waves-effect waves-light btn white  blue-grey-text text-darken-2 align-self-center">Borrar</button>
                </div>              
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include '../../templates/footer.php';?>