<?php
include '../../templates/header.php';
include 'controllerUsers.php';
?>

<main class="imagenFondo"></br></br></br></br></br>
  <div class="container">
    <div class="row">
      <div class="col-9">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $nombre." ".$apellidos?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Datos Personales:</h6>
            <p class="card-text">Email: <?php echo $email?></p>
            <p class="card-text">Telefono: <?php echo $telefono?></p>
            <p class="card-text">Fecha de Nacimiento: <?php echo $fechaNacimiento?></p>
            <p class="card-text">Direccion: <?php echo $direccion?></p>
              <p class="card-text">Sexo: <?php
                                            if ($sexo == 'h'){ echo "Hombre";}
                                            else if ($sexo == 'm'){ echo "Mujer";}
                                            else if ($sexo == 'o'){ echo "Otro";}
                                            else if ($sexo == 'n'){ echo "No quiero decirlo";}
                                          ?></p>
            <div class="center">
              <a href="<?php echo $url_base;?>secciones/usuarios/editarU.php?idMostrarU=<?php echo$idUser;?>" class="card-link">Modificar Datos</a>
              <a href="<?php echo $url_base;?>secciones/usuarios/seguridad.php" class="card-link">Cambiar Contraseña</a>
            <div>
          </div>
        </div>
        </div>
      </div>
      </div>
      <div class="col-3">
        </br>


        <a href="<?php echo $url_base;?>secciones/citas/indexC.php?idU=<?php echo$idUser;?>">
          <div class="card cardIndex">
            <div class="card-body">
                <h5 class="card-title center">CONSULTAR CITAS PAUTADAS</h5>       
            </div>
          </div>
        </a>

        <form action="<?php echo $url_base;?>secciones/citas/crearC.php" method="POST">
            <input type="hidden" name="email" value="<?php echo $email?>">
            <input type="hidden" name="citaUsuarioConocido" value="citaUsuarioConocido">
            <button type="submit" class="card cardIndex">
              <div class="card-body">
                <h5 class="card-title center">SOLICITAR UNA NUEVA CITA</h5>
              </div>
            </button>  
        </form>

      </div>
    </div>
  </div>
</main>
<a class="creditos" href="https://www.freepik.es/foto-gratis/equipos-e-instrumentos-dentales-oficina-dentista-primer-plano-herramientas_1621655.htm#query=consultorio%20dental&position=1&from_view=search&track=ais">Creditos Imagen de Fondo</a>
<?php include '../../templates/footer.php'; ?>