<footer class="page-footer blue lighten-2">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <a href="<?php echo $url_base;?>secciones/clinicas/clinicas.php">
                  <h5 class="white-text">¿Donde estamos ubicados?</h5>
                  <p class="white-text text-dark-4">Clínica Dental Sonrisa Perfecta: Dirección: Av. Providencia 1234, Santiago, Chile.</p>
                  <p class="white-text text-dark-4">Centro Odontológico Dentalis: Dirección: Calle Moneda 567, Santiago, Chile.</p>
                </a>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Contáctanos</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!"><img src="<?php echo $url_base;?>assets/images/rsinstagram.png" style="width: 2rem;" alt="Twitter"> Instagram</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><img src="<?php echo $url_base;?>assets/images/rstwitter.png" style="width: 2rem;" alt="Twitter"> Twitter</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2023 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">Politica de Privacidad</a>
            </div>
          </div>
</footer>
<script src="<?php echo $url_base;?>js/javascript.js"></script>

<script>
  function borrarNoticia(id){
    Swal.fire({
      title: '¿Desea Borrar la Noticia?',
      showCancelButton: true,
      confirmButtonText: 'Si, Borrar.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location="controllerNoticias.php?notID="+id
      }
    });
  }
  function borrarUser(id){
    Swal.fire({
      title: '¿Desea Borrar el Usuario?',
      showCancelButton: true,
      confirmButtonText: 'Si, Borrar.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location="controllerUsers.php?notID="+id
      }
    });
  }
  function borrarCita(id){  Swal.fire({
      title: '¿Desea Borrar la Cita?',
      showCancelButton: true,
      confirmButtonText: 'Si, Borrar.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location="controllerCitas.php?notID="+id
      }
    });
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init();
  });
</script>

<script>
  $(document).ready(function() {
    $('#tabla_id').DataTable({
      "pageLength": 10,
      "lengthMenu": [
        [3, 10, 25, 50],
        [3, 10, 25, 50]
      ],
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
      }
    });
  });
</script>

</body>
</html>