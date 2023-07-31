<?php include 'controllerLogin.php';?>

<!doctype html>
<html lang="es">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="estilos.css">
  <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php if(isset($_GET['success'])){?>
    <script>
        Swal.fire({icon:"success", title:"<?php echo $_GET['success'];?>"});
    </script>
<?php } if(isset($_GET['error'])){?>
    <script>
        Swal.fire({
        icon: 'error',
        title: 'Error:',
        text: "<?php echo $_GET['error'];?>"});
    </script>
<?php } ?>
    </br></br>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card blue lighten-5">
                    </br>
                    <div class="card-header"><br>
                    <div class="row g-0 text-center">
                            <div class="col-sm-6 col-md-8 align-self-center">INICIO DE SESIÓN</div>
                            <div class="col-6 col-md-4 align-self-center"><img src="assets/images/logoIsobert.png" width="100px" class="img-fluid rounded-top" alt="logo Karguash"></div>
                    </div>
                    <div class="card-body">
                    <form action="controllerLogin.php" method="POST">
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Ingrese el email">
                            
                            <label for="" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="contrasenia" id="" aria-describedby="helpId" placeholder="Ingrese la contraseña"></br></br></br>
                            

                            <?php if (isset($mensaje)): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong class="red-text"><?php echo $mensaje; ?></strong>
                                    </div>
                            <?php endif; ?>

                            <div class="d-grid gap-2">
                                <button class="btn  blue lighten-3" type="submit">Ingresar</button>
                                <button type="reset" class="waves-effect waves-light btn white  blue-grey-text text-darken-2 align-self-center">Borrar</button>
                            </div></br>

            
                            <div class="center">
                                <p><a href="registro.php" class="card-link">¿No estas registrado? REGISTRATE AQUI</a></p>
                                <p><a href="index.php" class="right link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">VOLVER</a></p>
                            <div>
                        </div>
                        <input type="hidden" name='loguearse' value='loguearse'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>