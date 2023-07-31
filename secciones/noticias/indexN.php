<?php
//ESTO LO PUEDEN VER TODOS LOS QUE INGRESEN A LA PAGINA
include '../../templates/header.php';
include 'controllerNoticias.php';
?>
</br></br>
<main>
  <div class="container">
   <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php foreach($noticias as $unoPorUno) {?>
          
          <div class="col">
            <div class="card">
              <img src="../../lib/<?php echo $unoPorUno['imagen']; ?>" class="card-img-top" width="5rem" alt="<?php echo $unoPorUno['titulo']; ?>">
              <div class="card-body">
                <h5 class="card-title"><?php echo $unoPorUno['titulo']; ?></h5>
                <p class="card-text"><?php echo $unoPorUno['texto']; ?>.</p>
                <p class="card-text right"><small class="text-muted">Fecha de Publicación: <?php echo $unoPorUno['fechaNoticia']; ?></small></p>
                <p class="card-text left"><small class="text-muted">Publicado / Editado: <?php echo $unoPorUno['creador']; ?></small></p>
              </div>
            </div>
          </div>
        
      <?php } ?>
    </div>
  </div>
</main>
<?php include '../../templates/footer.php'; ?>