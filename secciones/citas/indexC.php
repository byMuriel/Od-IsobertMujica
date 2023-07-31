<?php
include 'controllerCitas.php';
include '../../templates/header.php';

?>
<main class="imagenFondo"></br></br></br></br></br>
  <div class="container row">
    <h4><?php echo $nombre." ".$apellidos?></h4>
    <h5>Citas Pautadas:</h5>
  
    <div class="col-9">
      <?php foreach($citasdeUsuario as $unoPorUno) {?>
      <section>
        <div class="card ">
          <div class="row">
            <div class="col-7">
              <h5 class="card-title">Numero de identificador:</h5><p class="card-text"><?php echo $unoPorUno['idCita'];?></p>
              

              <h6>Fecha de la cita:</h6><p class="card-text"><?php echo date("d-m-Y", strtotime($unoPorUno['fechaCita'])); ?></p>
              <h6>Hora de la cita:</h6><p class="card-text"><?php echo substr($unoPorUno['fechaCita'], 11, 5); ?> h</p>
              <h6>Motivo de la cita:</h6><p class="card-text"><?php echo $unoPorUno['motivoCita']; ?></p>
            </div>
            <div class="col-4">
              <h5 class="card-title">Debe acudir a la siguiente direccion: </h5>
              <p class="card-text">Clinica del Sur. Av de las Americas Nº22 Bajo 2.</p>
            </div>
          </div>
          <div class="center">
            <a href="<?php echo $url_base;?>secciones/citas/editarC.php?idC=<?php echo $unoPorUno['idCita'];?>" class="card-link">Modificar Cita</a>
            <a href="<?php echo $url_base;?>secciones/citas/controllerCitas.php?notID=<?php echo $unoPorUno['idCita'];?>&fechaCita=<?php echo $unoPorUno['fechaCita'];?>" class="card-link">Cancelar Cita</a>
          <div>
        </div>
      </section>
      <?php } ?>
    </div>
  
    <aside class="col-3">
      <form action="<?php echo $url_base;?>secciones/citas/crearC.php" method="POST">
        <input type="hidden" name="email" value="<?php echo $email?>">
        <input type="hidden" name="citaUsuarioConocido" value="citaUsuarioConocido">
        <button type="submit" class="card cardIndex">
          <div class="card-body">
            <h5 class="card-title center">SOLICITAR UNA NUEVA CITA</h5>
          </div>
        </button>  
      </form>
    </aside>
  </div>
</main>
<a class="creditos" href="https://www.freepik.es/foto-gratis/equipos-e-instrumentos-dentales-oficina-dentista-primer-plano-herramientas_1621655.htm#query=consultorio%20dental&position=1&from_view=search&track=ais">Creditos Imagen de Fondo</a>
<?php include '../../templates/footer.php'; ?>