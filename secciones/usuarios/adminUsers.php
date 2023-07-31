<?php
//ESTO LO PUEDEN VER SOLO LOS ADMIN DE LA PAGINA
include '../../templates/header.php';
include 'controllerUsers.php';
?>
<br><br>
<main>
  <div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
      <a class="btn green darken-1" href="<?php echo $url_base?>/secciones/usuarios/crearU.php">AGREGAR NUEVO USUARIO</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <table class="table" id="tabla_id">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col">Direccion</th>
            <th scope="col">Sexo</th>
            <th scope="col">Rol</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($usuarios as $unoPorUno) {?>
          <tr class="">
            <td><?php echo $unoPorUno['idUser']; ?></td>
            <td><?php echo $unoPorUno['nombre']; ?></td>
            <td><?php echo $unoPorUno['apellidos']; ?></td>
            <td><?php echo $unoPorUno['email']; ?></td>
            <td><?php echo $unoPorUno['telefono']; ?></td>
            <td><?php echo $unoPorUno['fechaNacimiento']; ?></td>
            <td><?php echo $unoPorUno['direccion']; ?></td>
            <td><?php echo $unoPorUno['sexo']; ?></td>
            <td><?php echo $unoPorUno['rol']; ?></td>
            <td>
              <div class="row">
                <div class="col-md-4">
                  <a class="btn light-blue darken-3" href="editarU.php?idMostrarU=<?php echo $unoPorUno['idUser']; ?>" role="button">Editar</a>
                </div>
                <div class="col-md-4">
                  <a class="btn red accent-3" href="javascript:borrarUser(<?php echo $unoPorUno['idUser']; ?>)" role="button">Eliminar</a> 
                  

                </div>
              </div>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main> 
<?php include '../../templates/footer.php';?>