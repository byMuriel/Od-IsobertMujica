<?php
include '../../bd.php';

//CREAMOS UNA NUEVA NOTICIA
if(isset($_POST['nuevaNoticia'])){
    $titulo=(isset($_POST['titulo'])?$_POST['titulo']:"");
    $texto=(isset($_POST['texto'])?$_POST['texto']:"");
    $fechaNoticia=(isset($_POST['fechaNoticia'])?$_POST['fechaNoticia']:"");
    $fecha = new DateTime();
    
    $imagen=$fecha->getTimestamp()."_".$_FILES['imagen']['name']; //aqui recepcionamos el nombre del archivo de la imagen
    $imagenTemporal= $_FILES['imagen']['tmp_name']; // aqui recepcionamos el nombre de la imagen temporan que estamos recibiendo. es el nombre de la original la que adjunta el sistema
    move_uploaded_file($imagenTemporal,"../../lib/".$imagen); //esta es una funcion del sistema con la que aqui movemos el nombre de la imagen temporan a el nombre del archivo
    
    session_start();
    $creador= $_SESSION['nombreU']." ".$_SESSION['apellidosU'];

    $sql=("INSERT INTO noticias(idNoticia,_idUserNoticia,titulo,imagen,texto,fechaNoticia,creador)
            VALUES (NULL,1,:titulo,:imagen,:texto,:fechaNoticia,:creador)");
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':imagen', $imagen);
    $stmt->bindParam(':texto', $texto);
    $stmt->bindParam(':fechaNoticia', $fechaNoticia);
    $stmt->bindParam(':creador', $creador);
    $stmt->execute();

    $mensaje ="Registro agregado";
    header("location:adminNoticias.php?success=".$mensaje);
}

//BORRAMOS UNA NOTICIA
else if(isset($_GET['notID'])){ 
    //Primero buscamos el nombre de la imagen en la base de datos
    $idNoticia=$_GET['notID'];
    $sql1=("SELECT imagen FROM noticias WHERE idNoticia=:idNoticia");
    $stmt1 = $conexion->prepare($sql1);
    $stmt1->bindParam(':idNoticia', $idNoticia);
    $stmt1->execute();
    $imagen=$stmt1->fetchAll(PDO::FETCH_ASSOC);
    //Con unLink llevaremos a cabo el borrado de un archivo en una carpeta, pero tengo que agregar la ruta de donde esta guardado 
    unlink("../../lib/".$imagen[0]['imagen']); //Asi  se borra la imagen de la carpeta donde esta guardada

    //Aqui borramos el registro de la base de datos
    $sql2=("DELETE FROM noticias WHERE idNoticia=:idNoticia");
    $stmt2 = $conexion->prepare($sql2);
    $stmt2->bindParam(':idNoticia', $idNoticia);
    $stmt2->execute();
    $mensaje ="Registro Eliminado";
    header("location:adminNoticias.php?success=".$mensaje);
}

//EDITAMOS UNA NOTICIA AQUI LA BUSCAMOS Y MOSTRAMOS
else if(isset($_GET['idEditarN'])){
    //Aqui mostramos en el formulario los datos del id que queremos editar
    $idNoticia=$_GET['idEditarN'];
    $sql=("SELECT * FROM noticias WHERE idNoticia=:idNoticia");
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idNoticia', $idNoticia);
    $stmt->execute();
    //Con esto regresamos el primer registro que en este caso por ser un id sera unico
    $registro=$stmt->fetch(PDO::FETCH_LAZY);
    //Aqui los capturo cada uno en una variable
    $titulo=$registro['titulo'];
    //$imagen=$registro['imagen'];
    $texto=$registro['texto'];
    $fechaNoticia=$registro['fechaNoticia'];
    $creador=$registro['creador'];

    
    if (isset($_FILES['imagenNvo']) && $_FILES['imagenNvo']['error'] === UPLOAD_ERR_OK) {
        // Se ha seleccionado un nuevo archivo
        $imagen = $_FILES['imagenNvo']['name'];
        // Realizar el procesamiento adicional o guardar el archivo aquí
    } else {
        // No se seleccionó un nuevo archivo, mantener el valor existente
        $imagen=$registro['imagen'];
        //$imagen = $_POST['imagenNvo'];
    }
}

//EDITAMOS UNA NOTICIA AQUI CARGAMOS LOS DATOS EN LA BASE DE DATOS
else if(isset($_POST['editarNoticia'])){
    //Aqui recupero los valores previos de cada campo en la base de datos
    $idNoti=$_POST['idNoticia'];   
    $sql1=("SELECT titulo, imagen, texto, fechaNoticia FROM noticias WHERE idNoticia=:idNoti");
    $stmt1 = $conexion->prepare($sql1);
    $stmt1->bindParam(':idNoti', $idNoti);
    $stmt1->execute();
    $registroEditar=$stmt1->fetch(PDO::FETCH_LAZY);
    
    //Guardo los valores previos que me arrojo la consulta en estas variables
    $tituloAnt=$registroEditar['titulo'];   
    $imagenAnt=$registroEditar['imagen'];
    $textoAnt=$registroEditar['texto'];
    $fechaNoticiaAnt=$registroEditar['fechaNoticia'];

    //Reemplazo los valores anteriores por los nuevos recibidos por el metodo POST
    //Y los que no han sido modificados quedaran igual
    $tituloNvo=(isset($_POST['tituloNvo'])?$_POST['tituloNvo']:$tituloAnt);
    $textoNvo=(isset($_POST['textoNvo'])?$_POST['textoNvo']:$textoAnt);
    $fechaNoticiaNvo=(isset($_POST['fechaNoticiaNvo'])?$_POST['fechaNoticiaNvo']:$fechaNoticiaAnt);
   
    
    if($_FILES['imagenNvo']['name'] != ''){
        //Si han incluido una imagen nueva, cambio el nombre y la reemplazo por la enterior en la libreria lib
        $fecha = new DateTime();
        $imagenNvo=$fecha->getTimestamp()."_".$_FILES['imagenNvo']['name']; //aqui recepcionamos el nombre del archivo de la imagen
        $imagenTemporal= $_FILES['imagenNvo']['tmp_name']; // aqui recepcionamos el nombre de la imagen temporal que estamos recibiendo. es el nombre de la original la que adjunta el sistema
        move_uploaded_file($imagenTemporal,"../../lib/".$imagenNvo); //esta es una funcion del sistema con la que aqui movemos el nombre de la imagen temporal a el nombre del archivo      
        unlink("../../lib/".$imagenAnt);

        $sql2=("UPDATE noticias SET imagen=:imagenNvo WHERE idNoticia=:idNoti");
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->bindParam(':idNoti', $idNoti);
        $stmt2->bindParam(':imagenNvo', $imagenNvo);
        $stmt2->execute();
    }

    session_start();
    $creador= $_SESSION['nombreU']." ".$_SESSION['apellidosU'];

    $sql3=("UPDATE noticias SET titulo=:tituloNvo, texto=:textoNvo,fechaNoticia=:fechaNoticiaNvo, creador=:creador WHERE idNoticia=:idNoti");
    $stmt3 = $conexion->prepare($sql3);
    $stmt3->bindParam(':idNoti', $idNoti);
    $stmt3->bindParam(':tituloNvo', $tituloNvo);
    $stmt3->bindParam(':textoNvo', $textoNvo);
    $stmt3->bindParam(':fechaNoticiaNvo', $fechaNoticiaNvo);
    $stmt3->bindParam(':creador', $creador);
    $stmt3->execute();
    $mensaje ="Registro Actualizado";
    header("location:adminNoticias.php?success=".$mensaje);
}

//AQUI MOSTRAMOS TODOS LOS REGISTROS DE NOTICIAS QUE TENEMOS
else{
    //En este caso estamos en el adminNoticias y vamos a mostrarlas
    $sql=("SELECT * FROM noticias");
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $noticias=$stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>