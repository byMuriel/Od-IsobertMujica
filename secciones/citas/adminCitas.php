<?php
include '../../templates/header.php';
include 'controllerCitas.php';
?>
<br><br>
<main>
  <div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3"><a class="btn green darken-1" href="<?php echo $url_base?>/secciones/citas/crearC.php">Añadir Nueva Cita</a></div>
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <table class="table" id="tabla_id">
        <thead>
          <tr>
            <th scope="col">ID User</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
            <th scope="col">ID Cita</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Motivo</th>
            <th scope="col">Citas</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($citas as $unoPorUno) {?>
          <tr class="">
            <td><?php echo $unoPorUno['_idUserCita'];?></td>
            <td><?php echo $unoPorUno['nombre'];?></td>
            <td><?php echo $unoPorUno['apellidos'];?></td>
            <td><?php echo $unoPorUno['email'];?></td>
            <td><?php echo $unoPorUno['idCita'];?></td>
            <?php
              //Cambiamos el formato de fecha y horas a mostrar
              $fechaHora =$unoPorUno['fechaCita'];
              list($fechaSQL, $horaLarga) = explode(' ', $fechaHora);
              $fecha = date("d-m-Y", strtotime($fechaSQL));
              $hora = substr($horaLarga, 0, -3);
            ?>
            <td><?php echo $fecha;?></td>
            <td><?php echo $hora;?></td>
            <td><?php echo $unoPorUno['motivoCita'];?></td>

            <td> 
              <div class="row">
                <div class="col-md-3">
                  <form action="<?php echo $url_base;?>secciones/citas/crearC.php?elId=<?php echo $unoPorUno['email']?>" method="POST">
                    <input type="hidden" name="email" value="<?php echo $unoPorUno['email']?>">
                    <input type="hidden" name="citaUsuarioConocido" value="citaUsuarioConocido">
                    <button type="submit" class="btn green darken-1"> Nueva </button>  
                  </form>
                </div>
                <div class="col-md-3">
                  <a class="btn light-blue darken-3" href="<?php echo $url_base?>/secciones/citas/editarC.php?idC=<?php echo $unoPorUno['idCita']?>">Editar</a>
                </div>
                <div class="col-md-3">
                  <a class="btn red accent-3 col" href="javascript:borrarCita(<?php echo $unoPorUno['idCita']; ?>)">Eliminar</a>
                </div>
              </div>
              <div  class="col-md-12 center">
                <a class="textMenuDer" href="<?php echo $url_base?>/secciones/usuarios/perfil.php?idMostrarU=<?php echo $unoPorUno['_idUserCita']?>">Ver Datos de Usuario</a>
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