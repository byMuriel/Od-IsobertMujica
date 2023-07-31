<?php
include 'templates/header.php';
?>

  </br></br>

  <main>
    <div class="slider">
        <a href="<?php echo $url_base;?>/secciones/noticias/indexN.php">
            <ul class="slides">
                <li>
                    <img src="assets/images/img5.jpg" alt="Freepik">
                    <div class="caption center-align z-depth-5">
                        <h3 class="grey-text text-darken-4">DISEÑO DE SONRISA</h3>
                        <h5 class="grey-text text-darken-4 textoSlider container">Deslumbra con una sonrisa perfecta. Nuestro servicio de diseño de sonrisa te ofrece la oportunidad de transformar tu apariencia dental de manera integral. Con un enfoque personalizado y el uso de tecnología de vanguardia.</h5><br>
                    </div>
                </li>
                <li>
                    <img src="assets/images/img5.jpg" alt="Freepik">
                    <div class="caption center-align z-depth-5">
                        <h3 class="grey-text text-darken-4">ENDODONCIAS</h3>
                        <h5 class="grey-text text-darken-4 textoSlider container">¡Sonríe sin dolor! Obtén una sonrisa saludable con nuestra endodoncia de alta calidad. Nuestro equipo de expertos en odontología te brindará un tratamiento seguro y sin dolor.</h5><br>
                    </div>
                </li>
                <li>
                    <img src="assets/images/img5.jpg" alt="Freepik">
                    <div class="caption center-align z-depth-5">
                        <h3 class="grey-text text-darken-4">IMPLANTES</h3>
                        <h5 class="grey-text text-darken-4 textoSlider container">Nuestros implantes dentales te brindan una solución duradera y estética para reemplazar dientes perdidos. Recupera la funcionalidad y la belleza de tus dientes.</h5><br>
                    </div>
                </li>
            </ul>
        </a>
    </div>
    <div class="card-deck row container mtop06">
    <?php
        $mensaje = "Para pautar una cita debe estar previamente registrado";
        if($_SESSION['logueado']){
            $citasUrl = "/secciones/citas/crearC.php";
        }else{
            $citasUrl = "index.php?alertaOpcion=$mensaje";
        }
        
    ?>
    <a href="<?php echo $url_base . $citasUrl; ?>" class="col-md-3 col-sm-12">
        <div class="card cardIndex">
            <div class="card-body">
                <h5 class="card-title">AGENDAR CITA</h5>
                <p class="card-text">Consulta la disponibilidad</p>
                <p class="card-text"><small class="text-muted">Tenemos flexibilidad horaria para atenderte.</small></p>
            </div>
            </div>
        </a>
        <div class="col-1"></div>
        <a href="<?php echo $url_base;?>/secciones/noticias/indexN.php" class="col-md-3 col-sm-12">
            <div class="card cardIndex">
                <div class="card-body">
                    <h5 class="card-title">TRATAMIENTOS</h5>
                    <p class="card-text">Conoce las últimas novedades</p>
                    <p class="card-text"><small class="text-muted">Acompañadas del uso de las ultimas tecnologías.</small></p>
                </div>
            </div>
        </a>
        <div class="col-1"></div>
        <a href="<?php echo $url_base;?>/secciones/clinicas/clinicas.php" class="col-md-3 col-sm-12">
            <div class="card cardIndex">
                <div class="card-body">
                    <h5 class="card-title">CLINICAS</h5>
                    <p class="card-text">Ubicaciones</p>
                    <p class="card-text"><small class="text-muted">Visita tu clinica mas cercana.</small></p>
                </div>
            </div>
        </a>
    </div>
    <div class="parallax-container">
        <div class="parallax">
            <img src="assets/images/img6.jpg" alt="">
            <a
                href="https://www.freepik.es/foto-gratis/dentista-sonrisa_5904232.htm#query=dentista&position=29&from_view=search&track=sph">Imagen
                de Racool_studio</a> en Freepik
        </div>
    </div>
    <div class="white black-text center">
        <div class="container section">
            <h4>Preguntas Frecuentes</h4>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            ¿Cuáles son los tratamientos odontológicos más comunes?
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">En nuestra clínica dental, ofrecemos una amplia gama de tratamientos
                            odontológicos comunes para satisfacer las necesidades de nuestros pacientes. Algunos de los tratamientos 
                            más comunes incluyen limpiezas dentales profesionales para mantener una buena salud bucal, obturaciones 
                            para tratar las caries, extracciones de dientes dañados o problemáticos, blanqueamiento dental para mejorar 
                            la estética de la sonrisa, implantes dentales para reemplazar dientes perdidos, ortodoncia para corregir 
                            problemas de alineación dental y muchos otros tratamientos personalizados según las necesidades individuales 
                            de cada paciente.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            ¿Cuánto tiempo tarda en completarse un tratamiento dental?
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">La duración de un tratamiento dental varía según la complejidad y el tipo de procedimiento. 
                            Algunos tratamientos, como una limpieza dental, pueden completarse en una sola visita de aproximadamente una hora. 
                            Otros tratamientos más extensos, como los implantes dentales o la ortodoncia, pueden requerir varias citas 
                            distribuidas a lo largo de varios meses. En nuestra clínica, nos comprometemos a proporcionar una estimación 
                            clara del tiempo requerido para cada tratamiento, para que nuestros pacientes puedan planificar en consecuencia.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            ¿Cuáles son los costos asociados con los tratamientos odontológicos?
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Los costos de los tratamientos odontológicos varían según el tipo de procedimiento y las 
                            necesidades específicas de cada paciente. En nuestra clínica, ofrecemos opciones de tratamiento personalizadas y 
                            transparentes. Antes de comenzar cualquier tratamiento, realizamos una evaluación completa y proporcionamos un plan 
                            de tratamiento detallado con los costos asociados. Además, ofrecemos opciones de financiamiento flexibles y 
                            trabajamos con nuestros pacientes para encontrar soluciones que se ajusten a sus necesidades y presupuestos.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>

<?php include 'templates/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.parallax');
        var instances = M.Parallax.init(elems);
        M
            .AutoInit(); //cambio las variables que salen por este autonit para que se inicialicen los JS para los carruceles tambien
        elSlider();

        function elSlider() {
            var elems = document.querySelectorAll('.slider');
            var instances = M.Slider.init(elems);
        }
    });
  </script>

</body>
</html>