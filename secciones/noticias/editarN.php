<?php 
//ESTO LO PUEDEN VER SOLO LOS ADMIN DE LA PAGINA
include '../../templates/header.php';
include 'controllerNoticias.php';
?>

<br><br>
<main class="imagenFondo"><br><br>
  <div class="row">
    <div class="col-md-12 center">
        <h5>EDITAR NOTICIA</h5>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Editar:
        </div>
        <div class="card-body">
          <form action="controllerNoticias.php" enctype="multipart/form-data" method="POST">
                ID:
                <input type="text" readonly class="form-control" name="idNoticia" value="<?php echo $idNoticia?>">
                </br>
                Titulo Noticia:
                <input type="text" class="form-control" name="tituloNvo" value="<?php echo $titulo?>">
                </br>
                Imagen:
                <input type="text" id="file-name" readonly value="<?php echo $imagen ?>">
                <label for="file-input" class="btn white light-blue-text text-darken-3">Seleccionar archivo</label>
                <input type="file" id="file-input" name="imagenNvo" style="display: none;">
                
                </br></br>
                Fecha Publicacion:
                <input type="date" class="form-control" name="fechaNoticiaNvo" value="<?php echo $fechaNoticia?>">
                </br>
                Contenido:
                <textarea class="form-control" name="textoNvo"  rows="30"><?php echo $texto?></textarea>
                </br>
                <input type="hidden" name="editarNoticia" value="editarNoticia">
                <div class="row">
                  <input type="submit" class="btn light-blue darken-3" value="ACTUALIZAR"></br></br>
                  <input type="reset" class="btn white light-blue-text text-darken-3" value="RESTAURAR VALORES">
                </div>
                <a class="btn white blue-text right" href="adminNoticias.php" role="button">Volver</a>
                
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  //Aqui hacemos que se actualice automaticamente el nombre del archivo seleccionado a ser cargado
  document.getElementById('file-input').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('file-name').value = fileName;
  });
</script>
<?php include '../../templates/footer.php';?>