<?php
  include '../../templates/header.php';
  include 'controllerNoticias.php';
?>

<br><br>
<main>
  <div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
      <a class="btn green darken-1" href="<?php echo $url_base?>/secciones/noticias/crearN.php">AGREGAR NUEVA NOTICIA</a>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <table class="table" id="tabla_id">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Titulo</th>
            <th scope="col">Imagen</th>
            <th scope="col">Texto</th>
            <th scope="col">Fecha Noticia</th>
            <th scope="col">Publicado/Editado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($noticias as $unoPorUno) {?>
          <tr class="">
            <td><?php echo $unoPorUno['idNoticia']; ?></td>
            <td><?php echo $unoPorUno['titulo']; ?></td>
            <td>
              <?php //con esto podemos agregar la imagen 
              //si solo queremos agregar el nombre ponemos solo <?php echo $unoPorUno['imagen']; ?> 
              <img width="100" src="../../lib/<?php echo $unoPorUno['imagen']; ?>" alt=""> 
            </td>
            <td><?php echo $unoPorUno['texto']; ?></td>
            <td><?php echo $unoPorUno['fechaNoticia']; ?></td>
            <td><?php echo $unoPorUno['creador']; ?></td>
            <td class="row">
              <a class="btn light-blue darken-3 col-md-9" href="editarN.php?idEditarN=<?php echo $unoPorUno['idNoticia']; ?>" role="button">Editar</a>
              <a class="btn red accent-3 col-md-9" href="javascript:borrarNoticia(<?php echo $unoPorUno['idNoticia']; ?>)" role="button">Eliminar</a>   
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
<?php include '../../templates/footer.php';?>