<?php
include '../../templates/header.php';
include 'controllerCitas.php';
session_start();
?>
<br><br>
<main class="container">
  <div class="row">
    <div class="col-md-12 center">
        <h5>CREAR NUEVA CITA</h5>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <a href="indexC.php?idU=<?php echo $_SESSION['idUser']?>" class="btn btn-primary cardIndex" <?php echo $_SESSION['rol']=='admin'?"style='display: none;'":''?>>Ver tus citas</a>
        <div class="card-header">
          Insertar nueva cita:
        </div>
        <div class="card-body">
          <form action="controllerCitas.php" enctype="multipart/form-data" method="POST">
                Correo Usuario:
                <!-- Aqui con operadores ternarios precolocamos el email si es un usuario logueado y lo dejamos en blanco si es admin para que pueda añadir una cita a cualquier usuario-->
                <input type="mail" required class="form-control" name="usuario" value=" <?php echo $_SESSION['rol'] == 'user' ? $_SESSION['emailU'] : ($_SESSION['rol'] == 'admin' && isset($_GET['elId']) ? $_GET['elId'] : "");?>" <?php echo $_SESSION['rol']=='user' ? 'disabled' : ''; ?>>
                           
                
                
                <input type="hidden" name="usuarioRegis" value="<?php echo $emailUsuario;?>"?>
                </br>
                Fecha:
                <input type="date" required class="form-control diaCita" name="diaCita" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+30 days')); ?>">

                </br>
                Hora:
                <select class="form-select" required aria-label="Default select example" name="horaCita" >
                  <option selected>Selecciona una opción</option>
                  <option value="9:00">9:00 am</option>
                  <option value="9:30">9:30 am</option>
                  <option value="10:00">10:00 am</option>
                  <option value="10:30">10:30 am</option>
                  <option value="11:00">11:00 am</option>
                  <option value="11:30">11:30 am</option>
                  <option value="12:00">12:00 pm</option>
                  <option value="12:30">12:30 pm</option>
                  <option value="13:00">1:00 pm</option>
                  <option value="15:00">3:00 pm</option>
                  <option value="15:30">3:30 pm</option>
                  <option value="16:00">4:00 pm</option>
                  <option value="16:30">4:30 pm</option>
                  <option value="17:00">5:00 pm</option>
                  <option value="17:30">5:30 pm</option>
                  <option value="18:00">6:00 pm</option>
                  <option value="18:30">6:30 pm</option>
                  <option value="19:00">7:00 pm</option>
                </select>
                </br>
                Motivo Cita:
                <textarea class="form-control" name="motivoCita" id="" rows="3"></textarea>
                </br>
                <input type="hidden" class="form-control" name="nuevaCita" value="nuevaCita">
                <div class="row">
                    <button type="submit" class="waves-effect waves-light btn blue align-self-center">AGREGAR</button></br></br>
                    <button type="reset" class="waves-effect waves-light btn white  blue-grey-text text-darken-2 align-self-center">Borrar</button>
                </div> 
               
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init();
  });
</script>
<?php include '../../templates/footer.php';?>