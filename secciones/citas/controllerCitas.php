<?php
include '../../bd.php';
$emailUsuario=null;//Para que no precargue el email del usuario si es admin en crear citas

//QUEREMOS CREAR UNA CITA PERO SI ES UN USUARIO REGISTRADO PRIMERO ENTRAMOS AQUI
if(isset($_POST['citaUsuarioConocido'])){ 
    //Si el susuario ya esta logueado mantenemos el email del usuario 
    if(isset($_POST['email'])){
        $emailIngresado=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $emailUsuario=filter_var($emailIngresado, FILTER_VALIDATE_EMAIL);  
    }

    $sql1=("SELECT idUser FROM users_data WHERE email=:emailUsuario");
    $stmt1 = $conexion->prepare($sql1);
    $stmt1->bindParam(':emailUsuario', $emailUsuario);
    $stmt1->execute();
    $resultado1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
    $idUser=$resultado1[0]['idUser'];
}

//CREAMOS UNA NUEVA CITA
if(isset($_POST['nuevaCita'])){  
    $emailIngresado=filter_input(INPUT_POST, 'usuarioRegis', FILTER_SANITIZE_EMAIL)?filter_input(INPUT_POST, 'usuarioRegis', FILTER_SANITIZE_EMAIL):filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL);
    $email=filter_var($emailIngresado, FILTER_VALIDATE_EMAIL);

    $sql1=("SELECT idUser FROM users_data WHERE email=:email");
    $stmt1 = $conexion->prepare($sql1);
    $stmt1->bindParam(':email', $email);
    $stmt1->execute();
    $resultado1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $idUser=$resultado1[0]['idUser'];
 
    if($idUser){
        $fechaIngresada = $_POST['diaCita'];
        $horaIngresada = $_POST['horaCita'];
        $cadenaFecha = date("Y-m-d", strtotime($fechaIngresada));
        $cadenaHora = $horaIngresada.":00";
        $fecha = $cadenaFecha." ".$cadenaHora;
        $motivo=htmlspecialchars($_POST['motivoCita']);

        $sql2=("INSERT INTO citas(idCita,_idUserCita,fechaCita,motivoCita) VALUES (NULL, :idUser, :fecha, :motivo)");
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->bindParam(':idUser', $idUser);
        $stmt2->bindParam(':fecha', $fecha);
        $stmt2->bindParam(':motivo', $motivo);
        $stmt2->execute();

        $mensaje="La cita se ha guardado con exito.";
        session_start();
        if($_SESSION['logueado'] == true && $_SESSION['rol'] == 'user'){
            header("location:indexC.php?idU=$idUser&success=$mensaje");
        }else if ($_SESSION['logueado'] == true && $_SESSION['rol'] == 'admin') {
            header("location:adminCitas.php?success=$mensaje"); 
        } 
    }else{
        $mensaje="Usuario no registrado.";
        if ($_SESSION['logueado'] == true && $_SESSION['rol'] == 'admin') {
            header("location:adminCitas.php?error=$mensaje"); 
        } else{
            header("location:../../index.php?error=$mensaje"); 
        }
    }
}
   
//BORRAMOS UNA CITA
else if(isset($_GET['notID'])){ 
    //Primero buscamos el idCita en la base de datos
    $idCita=$_GET['notID'];
    $sql=("SELECT fechaCita FROM citas WHERE idCita=:idCita");
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idCita', $idCita);
    $stmt->execute();
    $registro=$stmt->fetch(PDO::FETCH_LAZY);
   
    $timestampActual = strtotime(date('Y-m-d H:i:s'));
    $timestampCita = strtotime($registro['fechaCita']);

    session_start();
    if ($timestampCita > $timestampActual) {
        //Aqui borramos el registro de la base de datos
        $sql1=("DELETE FROM citas WHERE idCita=:idCita");
        $stmt1 = $conexion->prepare($sql1);
        $stmt1->bindParam(':idCita', $idCita);
        $stmt1->execute();

        $mensaje="La cita se ha borrado con exito.";
        //DEPENDIENDO DE LAS CREDENCIALES DEL USUARIO REDIRECCIONARA A ADMINUSERS O A INDEX
        
        if($_SESSION['rol']=='admin'){
            header("location:adminCitas.php?success=$mensaje");  
        }else if (($_SESSION['rol']=='user')){
            $idUs = $_SESSION['idUser'];
            header("location:indexC.php?idU=$idUs&success=$mensaje");
        }

    } else if ($timestampCita < $timestampActual) {
        $idUs = $_SESSION['idUser'];
        $mensaje= 'Esta cita ya ha pasado. No puede ser borrada.';
        if($_SESSION['rol']=='admin'){
            header("location:adminCitas.php?error=$mensaje");  
        }else if (($_SESSION['rol']=='user')){
            header("location:indexC.php?idU=$idUs&error=$mensaje");
        }
    } else {
        $mensaje= 'La cita es ahora. No puede ser borrada.';
        if($_SESSION['rol']=='admin'){
            header("location:adminCitas.php?error=$mensaje");  
        }else if (($_SESSION['rol']=='user')){
            header("location:indexC.php?idU=$idUs&error=$mensaje");
        }
    }

}

//EDITAMOS UNA CITA AQUI LO BUSCAMOS Y MOSTRAMOS
else if(isset($_GET['idC'])){
    $idCita=$_GET['idC'];
    $sql=("SELECT fechaCita FROM citas WHERE idCita=:idCita");
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idCita', $idCita);
    $stmt->execute();
    $registro=$stmt->fetch(PDO::FETCH_LAZY);
   
    $timestampActual = strtotime(date('Y-m-d H:i:s'));
    $timestampCita = strtotime($registro['fechaCita']);

    if($timestampCita > $timestampActual){
        //Aqui mostramos en el formulario los datos del id que queremos editar
        $idCita=$_GET['idC'];
        $sql=("SELECT * FROM citas WHERE idCita=:idCita");
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idCita', $idCita);
        $stmt->execute();
        //Con esto regresamos el primer registro que en este caso por ser un id sera unico
        $registro=$stmt->fetch(PDO::FETCH_LAZY);
        //Aqui los capturo cada uno en una variable
        $fechaHoraPrevia = $registro['fechaCita'];
        //Separar la cadena en fecha y hora
        list($fechaSQL, $horaLarga) = explode(' ', $fechaHoraPrevia);
        //Cambiar formato de fecha y hora
        $fechaPrevia = date("Y-m-d", strtotime($fechaSQL));
        $horaPrevia = substr($horaLarga, 0, -3);
        $motivoPrevio=$registro['motivoCita'];
    }else{
        $idUser = $_SESSION['idUser'];
        $mensaje="Nos se puede modificar esta cita por haber transcurrido previamente.";
        //Redireccionamos dependiendo de las credenciales
        if($_SESSION['logueado'] == true && $_SESSION['rol'] == 'user'){
            header("location:indexC.php?idU=$idUser&error=$mensaje");
        }else if ($_SESSION['logueado'] == true && $_SESSION['rol'] == 'admin') {
            header("location:adminCitas.php?error=$mensaje");    
        }
    }
    
}

//EDITAMOS UNA CITA AQUI CARGAMOS LOS DATOS EN LA BASE DE DATOS
else if(isset($_POST['editarCita'])){
    $idCita=$_POST['idCita'];
    
    //Recuperamos los valores previos de cada campo en la base de datos
    $sql1=("SELECT _idUserCita,fechaCita,motivoCita FROM citas WHERE idCita = :idCita");
    $stmt1 = $conexion->prepare($sql1);
    $stmt1->bindParam(':idCita', $idCita);
    $stmt1->execute();
    $registroEditar=$stmt1->fetch(PDO::FETCH_LAZY);

    //Guardamos los valores previos que arrojó la consulta en estas variables como ...Ant
    $idUser=$registroEditar['_idUserCita'];
    $fechaAnt=$registroEditar['fechaCita'];   
    $motivoAnt=$registroEditar['motivoCita'];
    
    //Reemplazamos los valores anteriores por los nuevos recibidos por el metodo POST
    //Y los que no han sido modificados quedaran igual
    $nvoDiaCita=htmlspecialchars($_POST['nvoDiaCita']);
    $nvaHoraCita=htmlspecialchars($_POST['nvaHoraCita']);

    $cadenaDia = date("Y-m-d", strtotime($nvoDiaCita));
    $cadenaHora = $nvaHoraCita.":00";
    $fechaIngresada = $cadenaDia." ".$cadenaHora;

    $nvoFechaCita=($fechaIngresada?$fechaIngresada:$fechaAnt);
    $nvoMotivoCita=(isset($_POST['nvoMotivoCita'])?(htmlspecialchars($_POST['nvoMotivoCita'])):$motivoAnt);
    
    //Actualizamos el resto de valores que hayan sido modificados
    $sql4 = "UPDATE citas SET fechaCita = :nvoFechaCita, motivoCita = :nvoMotivoCita WHERE idCita = :idCita";
    $stmt4 = $conexion->prepare($sql4);
    $stmt4->bindParam(':idCita', $idCita);
    $stmt4->bindParam(':nvoFechaCita', $nvoFechaCita);
    $stmt4->bindParam(':nvoMotivoCita', $nvoMotivoCita);
    $stmt4->execute();

    $mensaje="La cita se ha actualizado con exito.";
    session_start();
    //Redireccionamos dependiendo de las credenciales
    if($_SESSION['logueado'] == true && $_SESSION['rol'] == 'user'){
        header("location:indexC.php?idU=$idUser&success=$mensaje");
    }else if ($_SESSION['logueado'] == true && $_SESSION['rol'] == 'admin') {
        header("location:adminCitas.php?success=$mensaje");
    }   

}

//MOSTRAMOS LAS CITAS DE UN USUARIO ESPECIFICO
else if(isset($_GET['idU'])){
    $idUser=htmlspecialchars($_GET['idU']);

    $sql=("SELECT _idUserCita, nombre, apellidos, email, idCita, fechaCita, motivoCita
            FROM users_data U
            INNER JOIN citas C ON U.idUser = c._idUserCita WHERE U.idUser=:idUser;");
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    $citasdeUsuario=$stmt->fetchAll(PDO::FETCH_ASSOC);
  
    if(!count($citasdeUsuario)){
        //No tiene citas pautadas
        $mensaje= "No hay citas registradas para este usuario";
        header("location:../usuarios/perfil.php?idMostrarU=$idUser&error=$mensaje");
        
        
    } else {
        $nombre=$citasdeUsuario[0]['nombre'];
        $apellidos=$citasdeUsuario[0]['apellidos'];
        $email=$citasdeUsuario[0]['email'];
        $motivoCita = $citasdeUsuario[0]['motivoCita'];
    }
}

//AQUI MOSTRAMOS TODOS LOS REGISTROS DE CITAS DE TODOS LOS USUARIOS
else{
    //En este caso estamos en el adminNoticias y vamos a mostrarlas
    $sql=("SELECT * FROM users_data U JOIN citas C ON U.idUser = C._idUserCita");
    //$sql=("SELECT * FROM citas GROUP BY _idUserCita");
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $citas=$stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>