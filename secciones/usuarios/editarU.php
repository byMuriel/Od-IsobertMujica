<?php
include '../../templates/header.php';
include 'controllerUsers.php';
?>

<main class="imagenFondo"><br><br>
  <div class="row">
    <div class="col-md-12 center">
        <h5>EDITAR USUARIO</h5>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Editar datos de usuario:
        </div>
        <div class="card-body">
          <form action="controllerUsers.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="idUser" value="<?php echo $idUser?>">
                Nombre:
                <input type="text" required class="form-control" name="nombreNvo" value="<?php echo $nombre?>">
                </br>
                Apellidos:
                <input type="text" required class="form-control" name="apellidosNvo" value="<?php echo $apellidos?>">
                </br>
                Email:
                <input type="text" disabled class="form-control" name="emailNvo" value="<?php echo $email?>">
                </br>
                Teléfono:
                <input type="text" required class="form-control" name="telefonoNvo" value="<?php echo $telefono?>">
                </br>
                Fecha de Nacimiento:
                <input type="date" required class="form-control" name="fechaNacimientoNvo" value="<?php echo $fechaNacimiento?>">
                </br>
                Sexo:
                <select class="form-select" required aria-label="Default select example" name="sexoNvo">
                  <option <?php echo ($sexo == '') ? 'selected' : ''; ?>>Selecciona una opción</option>
                  <option value="m" <?php echo ($sexo == 'm') ? 'selected' : ''; ?>>Mujer</option>
                  <option value="h" <?php echo ($sexo == 'h') ? 'selected' : ''; ?>>Hombre</option>
                  <option value="o" <?php echo ($sexo == 'o') ? 'selected' : ''; ?>>Otro</option>
                  <option value="n" <?php echo ($sexo == 'n') ? 'selected' : ''; ?>>No quiero decirlo</option>
                </select>
                </br>
                Dirección:
                <textarea class="form-control" name="direccionNvo" id="" cols="30" rows="10"><?php echo $direccion?></textarea>
                </br>
                <?php echo ($_SESSION['rol']== 'admin')?"Rol: ":""; ?>
                <select class="form-select" required aria-label="Default select example"<?php echo ($_SESSION['rol'] == 'user') ? " style='display: none;' " : ""; ?> name="rolNvo">
                  <option <?php echo ($rol == '') ? 'selected' : ''; ?>>Selecciona una opción</option>
                  <option value="user" <?php echo ($rol == 'user') ? 'selected' : ''; ?>>Usuario</option>
                  <option value="admin" <?php echo ($rol == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                </select> 
                </br></br>
                <input type="hidden" name="editarUsuario" value="editarUsuario">
                <div class="row">
                    <input type="submit" class="btn light-blue darken-3" value="ACTUALIZAR"></br></br>
                    <input type="reset" class="btn white light-blue-text text-darken-3" value="RESTAURAR VALORES">
                </div>
                </br>
                           
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include '../../templates/footer.php';?>