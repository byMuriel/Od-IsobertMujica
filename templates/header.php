<?php
$currentPage = basename($_SERVER['PHP_SELF']);
//Incluimos una url absoluta para poder movernos entre las carpetas de los directorios
$url_base= "http://localhost/ProyectoFinalPHP/";

include 'C:\xampp\htdocs\ProyectoFinalPHP\controllerLogin.php';
if(!$_SESSION){
    $_SESSION['logueado']=false;
    $_SESSION['rol']= "noLog";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if ($currentPage === 'index.php' || $currentPage === 'servicios.php' || $currentPage === 'clinicas.php'){
            echo "Inicio";
        }else if($currentPage === 'indexN.php'){
            echo "Noticias";
        }else if($currentPage === 'indexC.php' || $currentPage === 'editarC.php' || $currentPage === 'crearC.php'){
            echo "Citaciones";
        }else if($currentPage === 'adminUsers.php' || $currentPage === 'adminCitas.php' || $currentPage === 'adminNoticias.php' || $currentPage === 'crearN.php' || $currentPage === 'editarN.php'){
            echo "Administrador";
        }else if($currentPage === 'perfil.php' || $currentPage === 'crearU.php' || $currentPage === 'editarU.php'){
            echo "Usuarios";
        }else if($currentPage === 'registro.php'){
            echo "Registro de Usuario";
        }else if($currentPage === 'seguridad.php'){
            echo "Seguridad";
        }else{
            echo"Clinica Odontologica";
        }
        ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $url_base;?>css/estilos.css">
    <script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid blue lighten-4">
            <a class="navbar-brand" href="<?php echo $url_base;?>index.php"><img src="<?php echo $url_base;?>assets/images/logoIsobert.png" width="80px" class="img-fluid rounded-top" alt="logo Karguash"></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item menuIzq <?php echo ($currentPage === 'index.php' || $currentPage === 'servicios.php' || $currentPage === 'clinicas.php') ? 'active' : '';?>"><a class="nav-link textMenuIzq" href="<?php echo $url_base;?>index.php">Inicio</a></li>
                    <li class="nav-item menuIzq <?php echo $currentPage === 'indexN.php' ? 'active' : '';?>"><a class="nav-link textMenuIzq" href="<?php echo $url_base;?>secciones/noticias/indexN.php">Noticias</a></li>

                    <?php if($_SESSION['logueado'] == true && $_SESSION['rol'] == "user") { ?>
                        <li class='nav-item menuIzq
                                <?php echo ($currentPage === 'indexC.php' || $currentPage === 'editarC.php' || $currentPage === 'crearC.php') ? 'active' : '';?>'>
                                <a class='nav-link textMenuIzq'
                                href='<?php echo $url_base ?>secciones/citas/indexC.php?idU=<?php echo $_SESSION['idUser']?>'>Citaciones</a>
                        </li>
                    <?php } ?>

                    <?php if($_SESSION['logueado'] == true && $_SESSION['rol'] == "admin") { ?>
                        <li class='nav-item menuIzq
                            <?php echo ($currentPage === 'adminUsers.php'|| $currentPage === 'crearU.php' || $currentPage === 'editarU.php') 
                            ? ' active' : ''; ?>'>
                            <a class='nav-link textMenuIzq'
                                href='<?php echo $url_base; ?>secciones/usuarios/adminUsers.php'>Usuarios-Admin</a>
                        </li>

                        <li class='nav-item menuIzq <?php echo ($currentPage === 'adminCitas.php' || $currentPage === 'crearC.php' || $currentPage === 'editarC.php') ? ' active' : ''; ?>'>
                            <a class='nav-link textMenuIzq'
                                href='<?php echo $url_base; ?>secciones/citas/adminCitas.php'>Citas-Admin</a>
                        </li>

                        <li class='nav-item menuIzq <?php echo ($currentPage === 'adminNoticias.php' || $currentPage === 'crearN.php' || $currentPage === 'editarN.php') ? ' active' : ''; ?>'>
                            <a class='nav-link textMenuIzq '
                                href='<?php echo $url_base; ?>secciones/noticias/adminNoticias.php'>Noticias-Admin</a>
                        </li>
                    <?php } ?>

                
                    <?php if($_SESSION['logueado'] == true) { ?>
                        <li class='nav-item menuIzq <?php echo ($currentPage === 'perfil.php' || $currentPage === 'editarU.php' || $currentPage === 'seguridad.php') ? 'active' : ''; ?>'>
                            <a class='nav-link textMenuIzq'

                            
                                href="<?php echo $url_base; ?>secciones/usuarios/perfil.php?idMostrarU=<?php echo $_SESSION['idUser']; ?>">Perfil</a>
                        </li>

                    <?php } ?>

                </ul>
                <div class="d-flex" >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if($_SESSION['logueado'] == false) { ?>
                            <li class='nav-item menuDer'><a class='nav-link textMenuDer' aria-current='page' href='<?php echo $url_base?>registro.php'>Registrarse</a></li>
                            <li class='nav-item mtop06'><a class='btn btn-outline-light cardIndex' aria-current='page' href='<?php echo $url_base?>login.php'>Iniciar Sesion</a></li>";
                        <?php } ?>   
                        <?php if($_SESSION['logueado'] == true) { ?>
                            <spam class='nav-item mtop06 blue-text text-darken-2'>Hola, <?php echo $_SESSION['nombreU']." ".$_SESSION['apellidosU']; ?> </spam><i class='material-icons  mtop06 blue-text text-darken-2'>person</i><li class='nav-item menuDer'><a class='nav-link textMenuDer' aria-current='page' href='<?php echo $url_base?>cerrar.php'>Salir</a></li>";
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Side Nav configuramos las opciones-->
    <ul class="sidenav" id="id-menu-side">
      <li>
        <div class="user-view">
          <div class="background">
            <img src="../assets/image/fondoSideNav.jpg" alt="Menu de opciones">
          </div>
          <a href="../index.html">
            <img class="circle" src="../assets/image/logoFT.png" alt="Logo Aleko Express">
          </a>
          <a href="../index.html">
            <span class="name white-text">Aleko Express</span>
          </a>
          <a href="./contacto.html">
            <span class="email white-text">info@alekoexpress.com</span>
          </a>
        </div>
      </li>
      <li>
        <a href="../index.html">INICIO</a>
      </li>
      <li>
        <div class="divider"></div>
      </li>
      <li>
        <a href="./servicios.html">SERVICIOS</a>
      </li>
      <li>
        <div class="divider"></div>
      </li>
      <li>
        <a href="./presupuesto.html">PRESUPUESTOS</a>
      </li>
      <li>
        <div class="divider"></div>
      </li>
      <li>
        <a href="./galeria.html">GALERIA</a>
      </li>
      <li>
        <div class="divider"></div>
      </li>
      <li>
        <a href="#">CONTACTO</a>
      </li>
    </ul>

    <!-- Estructura del Dropdown -->
    <ul class="dropdown-content" id="id_drop">
      <li><a href="#" class="elDrop yellow-text text-accent-4 ">SERVICIOS</a></li>
      <li class="divider"></li>
      <li><a href="./servicios.html" id="dropPS" class="elDrop">PERSONAL SHOPPER</a></li>
      <li><a href="./servicios.html" id="dropEI" class="elDrop">ENVIOS</a></li>
      <li><a href="./servicios.html" id="dropM" class="elDrop ">MUDANZAS</a></li>
      <li><a href="./servicios.html" id="dropRC" class="elDrop">RENTAL CAR</a></li>
    </ul>



    </br>
    <!-- Con esto manejamos los mensajes a mostrar con SweetAlert2-->
    <?php if(isset($_GET['success'])){?>
        <script>
        Swal.fire({icon:"success", title:"<?php echo $_GET['success'];?>"});
        </script>

    <?php } if(isset($_GET['error'])){?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "<?php echo $_GET['error'];?>"
            });
        </script>
    <?php } if (isset($_GET['alertaOpcion'])) {
        echo $_GET['alertaOpcion'];
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Importante:',
                text: '<?php echo $_GET['alertaOpcion'] ?>',
                footer: "<a href='registro.php' class='light-blue-text text-darken-4'>Registrarse aquí.</a>"
            });
        </script>
        <?php } ?>