<?php
//ESTO LO PUEDEN VER TODOS LOS QUE INGRESEN A LA PAGINA
include '../../templates/header.php';
include 'controllerNoticias.php';
?>
</br></br>
<main>
  <div class="container">

  <?php foreach($noticias as $unoPorUno) {?>
    <div class="card">
      <div class="container">
          <div class="row">
            <div class="col-8">
              
            <h5 class="card-title center"><?php echo $unoPorUno['titulo']; ?></h5>
              <p class="card-text left">
                <?php
                  // Obtener el texto completo
                  $textoCompleto = $unoPorUno['texto'];
                  
                  // Obtener el texto truncado (primeros 100 caracteres)
                  $textoTruncado = substr($textoCompleto, 0, 100);

                  // Imprimir el texto truncado
                  echo $textoTruncado;
                ?>
                <span id="textoCompleto" style="display: none;"><?php echo $textoCompleto; ?></span>
              </p>
              
              <button class="btn-continuar-leyendo">Continuar leyendo</button>
            </div>




              <h5 class="card-title center"><?php echo $unoPorUno['titulo']; ?></h5>
              <p class="card-text left"><?php echo $unoPorUno['texto']; ?></p></br></br>
              <p class="card-text right"><?php echo $unoPorUno['fechaNoticia']; ?></p>
            </div>
            <div class="col-4 right">
              </br></br>
              <img width="200" src="../../lib/<?php echo $unoPorUno['imagen']; ?>" alt="">
              </br></br>
            </div>
          </div>
      </div>
    </div>
  <?php } ?>

  </div>
</main>
<?php include '../../templates/footer.php'; ?>