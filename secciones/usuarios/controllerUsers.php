<?php
include '../../bd.php';

//CREAMOS UN NUEVO USUARIO
if(isset($_POST['nuevoUsuario'])){
    //PRIMERO VERIFICAMOS QUE EL USUARIO NO ESTE REGISTRADO
    $emailIngresado=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $email=filter_var($emailIngresado, FILTER_VALIDATE_EMAIL);
    $sql3=("SELECT idUser FROM users_data WHERE email=:email");
    $stmt3 = $conexion->prepare($sql3);
    $stmt3->bindParam(':email', $email);
    $stmt3->execute();
    $resultado3=$stmt3->fetchAll(PDO::FETCH_ASSOC);

    if(!count($resultado3)){
        //Si no esta registrado lo incluimos
        $nombre=htmlspecialchars($_POST['nombre']);
        $apellidos=htmlspecialchars($_POST['apellidos']);
        $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefono= filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_NUMBER_INT);
        $fechaNacimiento= $_POST['fechaNacimiento'];
        $sexo=$_POST['sexo'];
        $direccion= $_POST['direccion'];

        $pass= htmlspecialchars($_POST['contrasenia']);
        $contrasenia= password_hash($pass,PASSWORD_BCRYPT);

        //Insertamos los datos en la tabla users_data
        $sql1=("INSERT INTO users_data(idUser,nombre,apellidos,email,telefono,fechaNacimiento,direccion,sexo)
                VALUES (NULL,:nombre,:apellidos,:email,:telefono,:fechaNacimiento,:direccion,:sexo)");
        $stmt1 = $conexion->prepare($sql1);
        $stmt1->bindParam(':nombre', $nombre);
        $stmt1->bindParam(':apellidos', $apellidos);
        $stmt1->bindParam(':email', $email);
        $stmt1->bindParam(':telefono', $telefono);
        $stmt1->bindParam(':fechaNacimiento', $fechaNacimiento);
        $stmt1->bindParam(':direccion', $direccion);
        $stmt1->bindParam(':sexo', $sexo);
        $stmt1->execute();
        $idUser = $conexion->lastInsertId();
        
        //E insertamos los datos en la tabla users_login
        session_start();
        
       if($_SESSION['rol']=='admin'){
            $mensaje="Usuario registrado con exito.";
            $rol=$_POST['rol'];
            $sql2=("INSERT INTO users_login(idLogin,_idUserLogin,usuario,contrasenia,rol)
                VALUES (NULL,:idUser,:email,:contrasenia,:rol)");
            $stmt2 = $conexion->prepare($sql2);
            $stmt2->bindParam(':idUser', $idUser);
            $stmt2->bindParam(':email', $email);
            $stmt2->bindParam(':contrasenia', $contrasenia);
            $stmt2->bindParam(':rol', $rol);
            $stmt2->execute();
            header("location:adminUsers.php?success=$mensaje"); 
        } else {
            $mensaje="Registro exitoso.";
            $sql2=("INSERT INTO users_login(idLogin,_idUserLogin,usuario,contrasenia,rol)
                VALUES (NULL,:idUser,:email,:contrasenia,'user')");
            $stmt2 = $conexion->prepare($sql2);
            $stmt2->bindParam(':idUser', $idUser);
            $stmt2->bindParam(':email', $email);
            $stmt2->bindParam(':contrasenia', $contrasenia);
            $stmt2->execute();
            $_SESSION['nombreU']=$nombre;
            $_SESSION['apellidosU']=$apellidos;
            $_SESSION['emailU']=$email;
            $_SESSION['usuario']=$$email;
            $_SESSION['idUser']=$idUser;
            $_SESSION['logueado']=true;
            $_SESSION['rol']='user';
            header("location:perfil.php?idMostrarU=$idUser&success=$mensaje");
        }
    }else{
        $mensaje="El usuario ha sido registrado previamente, intente con un nuevo correo.";
        //Redireccionamos dependiendo de las credenciales
        session_start();
        if($_SESSION['logueado']=='true'){
            header("location:crearU.php?error=$mensaje"); 

        }  else if ($_SESSION['logueado']== NULL){
            header("location:../../registro.php?error=$mensaje");   
        }
    }
    
}

//BORRAMOS UN USUARIO
else if(isset($_GET['notID'])){ 
    //Primero buscamos el idUser en la base de datos
    $idUser=$_GET['notID'];
    session_start();

    //Aqui borramos el registro de la base de datos
    $sql2=("DELETE FROM citas WHERE _idUserCita=:idUser");
    $stmt2 = $conexion->prepare($sql2);
    $stmt2->bindParam(':idUser', $idUser);
    $stmt2->execute();
    $sql1=("DELETE FROM users_login WHERE _idUserLogin=:idUser");
    $stmt1 = $conexion->prepare($sql1);
    $stmt1->bindParam(':idUser', $idUser);
    $stmt1->execute();

    $sql2=("DELETE FROM users_data WHERE idUser=:idUser");
    $stmt2 = $conexion->prepare($sql2);
    $stmt2->bindParam(':idUser', $idUser);
    $stmt2->execute();

    //No es necesario verificar credenciales porque a esta opcion solo tienen acceso los administradores
    $mensaje="Usuario eliminado con exito.";
    header("location:adminUsers.php?success=$mensaje");       
}

//EDITAMOS UN USUARIO AQUI LO BUSCAMOS Y MOSTRAMOS
else if(isset($_GET['idMostrarU'])){
    $idUser=$_GET['idMostrarU'];
    $sql=("SELECT * FROM users_data U JOIN users_login L ON U.idUser = L._idUserLogin WHERE U.idUser=:idUser");
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    //Con esto regresamos el primer registro que en este caso por ser un id sera unico
    $registro=$stmt->fetch(PDO::FETCH_LAZY);
    //Aqui los capturo cada uno en una variable
    $nombre=$registro['nombre'];
    $apellidos=$registro['apellidos'];
    $email=$registro['email'];
    $telefono=$registro['telefono'];
    $fechaNacimiento= $registro['fechaNacimiento'];
    $direccion=$registro['direccion'];
    $sexo=$registro['sexo'];
    $rol=$registro['rol'];    
}

//EDITAMOS UN USUARIO AQUI CARGAMOS LOS DATOS EN LA BASE DE DATOS
else if(isset($_POST['editarUsuario'])){
    //Recuperamos los valores previos de cada campo en la base de datos para poder comparar
    $idUser=$_POST['idUser'];   
    $sql1=("SELECT * FROM users_data U JOIN users_login L ON U.idUser = L._idUserLogin WHERE U.idUser=:idUser");
    $stmt1 = $conexion->prepare($sql1);
    $stmt1->bindParam(':idUser', $idUser);
    $stmt1->execute();
    $registroEditar=$stmt1->fetch(PDO::FETCH_LAZY);

    //Guardamos los valores previos que arrojó la consulta en estas variables como ...Ant
    $nombreAnt=$registroEditar['nombre'];   
    $apellidosAnt=$registroEditar['apellidos'];
    $telefonoAnt=$registroEditar['telefono'];
    $fechaNacimientoAnt=$registroEditar['fechaNacimiento'];
    $direccionAnt=$registroEditar['direccion'];
    $sexoAnt=$registroEditar['sexo'];

    //Reemplazamos los valores anteriores por los nuevos recibidos por el metodo POST
    //Y los que no han sido modificados quedaran igual
    $nombreNvo=(isset($_POST['nombreNvo'])?$_POST['nombreNvo']:$nombreAnt);
    $apellidosNvo=(isset($_POST['apellidosNvo'])?$_POST['apellidosNvo']:$apellidosAnt);
    $telefonoNvo=(isset($_POST['telefonoNvo'])?$_POST['telefonoNvo']:$telefonoAnt);
    $fechaNacimientoNvo=(isset($_POST['fechaNacimientoNvo'])?$_POST['fechaNacimientoNvo']:$fechaNacimientoAnt);
    $direccionNvo=(isset($_POST['direccionNvo'])?$_POST['direccionNvo']:$direccionAnt);
    $sexoNvo=(isset($_POST['sexoNvo'])?$_POST['sexoNvo']:$sexoAnt);
    
    //Actualizamos el resto de valores que hayan sido modificados
    $sql2 = "UPDATE users_data 
    SET nombre = :nombreNvo, 
        apellidos = :apellidosNvo,  
        telefono = :telefonoNvo, 
        fechaNacimiento = :fechaNacimientoNvo, 
        direccion = :direccionNvo, 
        sexo = :sexoNvo 
    WHERE idUser = :idUser";
    $stmt2 = $conexion->prepare($sql2);
    $stmt2->bindParam(':idUser', $idUser);
    $stmt2->bindParam(':nombreNvo', $nombreNvo);
    $stmt2->bindParam(':apellidosNvo', $apellidosNvo);
    $stmt2->bindParam(':telefonoNvo', $telefonoNvo);
    $stmt2->bindParam(':fechaNacimientoNvo', $fechaNacimientoNvo);
    $stmt2->bindParam(':direccionNvo', $direccionNvo);
    $stmt2->bindParam(':sexoNvo', $sexoNvo);
    $stmt2->execute();

    
    //Actualizamos el rol de haberlo modificado y redireccionamos dependiendo de las credenciales
    session_start();
    if($_SESSION['rol']=='admin'){
        //$idUser=$_POST['idUser'];
        $mensaje="Usuario actualizado con exito.";
        $rolAnt=$registroEditar['rol'];
        $rolNvo=(isset($_POST['rolNvo'])?$_POST['rolNvo']:$rolAnt);

        if($rolAnt != $rolNvo){
            $sql3 = "UPDATE users_login SET rol = :rolNvo WHERE _idUserLogin = :idUser";
            $stmt3 = $conexion->prepare($sql3);
            $stmt3->bindParam(':idUser', $idUser);
            $stmt3->bindParam(':rolNvo', $rolNvo);
            $stmt3->execute();
        }
        header("location:adminUsers.php?success=$mensaje");

    }else if ($_SESSION['rol']=='user'){
        $mensaje="Modificación exitosa.";
        header("location:perfil.php?idMostrarU=$idUser&success=$mensaje");
    } 

}

//REVISION DE CONTRASEÑA Y DATOS
else if(isset($_POST['cambiarC'])){
    $emailIngresado=filter_input(INPUT_POST, 'emailUser', FILTER_SANITIZE_EMAIL);
    $email=filter_var($emailIngresado, FILTER_VALIDATE_EMAIL);
    $sql=("SELECT contrasenia FROM users_login WHERE usuario=:email");
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(!count($resultado)){
        //Si no esta registrado el email
        $mensaje="El correo electronico ".$email." no sido registrado previamente.";
        header("location:href=seguridad.php?error=$mensaje");
    }else{
        //Usuario encontrado, verificamos las contraseñas
        $passBD = $resultado[0]['contrasenia'];
        $passAnterior=htmlspecialchars($_POST['passAnterior']);

        // Verificar si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($passAnterior, $passBD)) {
            // La contraseña es correcta, puedes realizar las acciones necesarias
            $passNueva1 = htmlspecialchars($_POST['passNueva1']);
            $passNueva2 = htmlspecialchars($_POST['passNueva2']);
            if($passNueva1===$passNueva2){
                //Actualizamos la contraseña en users_login
                $pass= htmlspecialchars($passNueva1);
                $contraseniaNva= password_hash($pass,PASSWORD_BCRYPT);

                $sql = "UPDATE users_login SET contrasenia=:contraseniaNva WHERE usuario=:email";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':contraseniaNva', $contraseniaNva);
                $stmt->execute();
                $elId=$_SESSION['idUser'];
                $mensaje="Contraseña modificada con exito.";
                header("location:perfil.php?success=$mensaje&idMostrarU=$elId");
            }
        }else{
            $mensaje="Contraseña inválida.";
            header("location:seguridad.php?error=$mensaje");
        }    
    }
}

//AQUI MOSTRAMOS TODOS LOS REGISTROS DE USUARIOS QUE TENEMOS

else{
    //En este caso estamos en el adminNoticias y vamos a mostrarlas
    echo "estas aqui";
    $sql=("SELECT * FROM users_data U JOIN users_login L ON U.idUser = L._idUserLogin");
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $usuarios=$stmt->fetchAll(PDO::FETCH_ASSOC);
    session_start();
}

?>