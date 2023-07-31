<?php
include '../../templates/header.php';
include 'controllerUsers.php';
?>

<main class="imagenFondo"></br>
  <div class="container">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title center">Cambio de Contraseña</h5>


            <form action="seguridad.php" method="post" id="miformulario">
                <div class="password-input">
                <br>Correo:<br>
                  <input type="email" required name="emailUser" placeholder="Escribe tu direccion de correo electronico">
                <br>Contraseña Actual:<br>
                  <input type="password" required name="passAnterior" placeholder="Escribe la contraseña anterior">
                </div><br><br><br>
                <div class="password-input">

                <!-- Mensajes de Verificación de Contraseñas nuevas -->
                <div id="msg"></div>
                <div id="error" class="alert alert-danger ocultar" role="alert">
                  Las contraseñas deben coincidir.
                </div>
                <div id="ok" class="alert alert-success ocultar" role="alert">
                  Las contraseñas coinciden.
                </div>

                Nueva Contraseña:
                <input type="password" required id="passNueva1" name="passNueva1" placeholder="Escribe la nueva contraseña"
                        onkeyup="verificarPasswords();">
                <br><br>
                Repite:
                <input type="password" required id="passNueva2" name="passNueva2" placeholder="Repite la nueva contraseña"
                        onkeyup="verificarPasswords();">
                <input type="hidden" name="cambiarC" value="cambiarC">
                <div class="row">
                  <input type="submit" id= "cambiar" class="btn light-blue darken-3" value="CAMBIAR"></br></br>
                  <input type="reset" class="btn white light-blue-text text-darken-3" value="RESTAURAR VALORES">
                </div> 
            </form>    
          </div>
        </div>
        </div>
      </div>
      </div>
      
    </div>
  </div>
</main>
<a class="creditos" href="https://www.freepik.es/foto-gratis/equipos-e-instrumentos-dentales-oficina-dentista-primer-plano-herramientas_1621655.htm#query=consultorio%20dental&position=1&from_view=search&track=ais">Creditos Imagen de Fondo</a>
<?php include '../../templates/footer.php'; ?>