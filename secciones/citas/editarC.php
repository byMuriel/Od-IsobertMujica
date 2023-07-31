<?php
include '../../templates/header.php';
include 'controllerCitas.php';
?>
<br><br>
<main class="container">
  <div class="row">
    <div class="col-md-12 center">
        <h5>MODIFICAR CITA</h5>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Datos de la Cita:
        </div>
        <div class="card-body">
          <form action="controllerCitas.php" enctype="multipart/form-data" method="POST">
            Fecha:
            <input type="date" required class="form-control diaCita" name="nvoDiaCita" value="<?php echo $fechaPrevia?$fechaPrevia:''; ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+30 days')); ?>">
            </br>
            Hora:
            <select class="form-select" required aria-label="Default select example" name="nvaHoraCita" >
                <option selected>Selecciona una opción</option>
                <option value="9:00" <?php echo ($horaPrevia == '9:00') ? 'selected' : ''; ?>>9:00 am</option>
                <option value="9:30" <?php echo ($horaPrevia == '9:30') ? 'selected' : ''; ?>>9:30 am</option>
                <option value="10:00" <?php echo ($horaPrevia == '10:00') ? 'selected' : ''; ?>>10:00 am</option>
                <option value="10:30" <?php echo ($horaPrevia == '10:30') ? 'selected' : ''; ?>>10:30 am</option>
                <option value="11:00" <?php echo ($horaPrevia == '11:00') ? 'selected' : ''; ?>>11:00 am</option>
                <option value="11:30" <?php echo ($horaPrevia == '11:30') ? 'selected' : ''; ?>>11:30 am</option>
                <option value="12:00" <?php echo ($horaPrevia == '12:00') ? 'selected' : ''; ?>>12:00 pm</option>
                <option value="12:30" <?php echo ($horaPrevia == '12:30') ? 'selected' : ''; ?>>12:30 pm</option>
                <option value="13:00" <?php echo ($horaPrevia == '13:00') ? 'selected' : ''; ?>>1:00 pm</option>
                <option value="15:00" <?php echo ($horaPrevia == '15:00') ? 'selected' : ''; ?>>3:00 pm</option>
                <option value="15:30" <?php echo ($horaPrevia == '15:30') ? 'selected' : ''; ?>>3:30 pm</option>
                <option value="16:00" <?php echo ($horaPrevia == '16:00') ? 'selected' : ''; ?>>4:00 pm</option>
                <option value="16:30" <?php echo ($horaPrevia == '16:30') ? 'selected' : ''; ?>>4:30 pm</option>
                <option value="17:00" <?php echo ($horaPrevia == '17:00') ? 'selected' : ''; ?>>5:00 pm</option>
                <option value="17:30" <?php echo ($horaPrevia == '17:30') ? 'selected' : ''; ?>>5:30 pm</option>
                <option value="18:00" <?php echo ($horaPrevia == '18:00') ? 'selected' : ''; ?>>6:00 pm</option>
                <option value="18:30" <?php echo ($horaPrevia == '18:30') ? 'selected' : ''; ?>>6:30 pm</option>
                <option value="19:00" <?php echo ($horaPrevia == '19:00') ? 'selected' : ''; ?>>7:00 pm</option>
            </select>
            </br>
            Motivo Cita:
            <textarea class="form-control"  name="nvoMotivoCita" id="" rows="3"><?php echo $motivoPrevio?></textarea>
            </br>
            <input type="hidden" class="form-control" name="idCita" value="<?php echo $idCita;?>">
            <input type="hidden" class="form-control" name="editarCita" value="editarCita">
            <div class="row">
                <button type="submit" class="waves-effect waves-light btn blue align-self-center">ACTUALIZAR</button></br></br>
                <button type="reset" class="waves-effect waves-light btn white  blue-grey-text text-darken-2 align-self-center">Restablecer Valores</button>
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