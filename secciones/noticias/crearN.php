<?php
//ESTO LO PUEDEN VER SOLO LOS ADMIN DE LA PAGINA
include '../../templates/header.php';
?>

<br><br>
<main class="container">
  <div class="row">
    <div class="col-md-12 center">
        <h5>INSERTAR NOTICIA</h5>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Insertar nueva noticia:
        </div>
        <div class="card-body">
          <form action="controllerNoticias.php" enctype="multipart/form-data" method="POST">
                Titulo Noticia:
                <input type="text" required class="form-control" name="titulo" id="">
                </br>
                Imagen:
                <input type="file" required class="form-control" name="imagen" id="">
                </br>
                Fecha Publicacion:
                <input type="date" required class="form-control" name="fechaNoticia" id="">
                </br>
                Contenido:
                <textarea class="form-control" required name="texto" id="" rows="3"></textarea>
                </br>
                <input type="hidden" name="nuevaNoticia" value="nuevaNoticia">
                <div class="row">
                    <input type="submit" class="waves-effect waves-light btn blue align-self-center" value="AGREGAR"></br></br>
                    <input type="reset" class="waves-effect waves-light btn white  blue-grey-text text-darken-2 align-self-center" value="Borrar">
                </div>
                <a class="btn white blue-text right" href="adminNoticias.php" role="button">Volver</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include '../../templates/footer.php';?>