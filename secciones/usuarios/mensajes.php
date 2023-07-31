<?php
include '../../templates/header.php';
include 'controllerUsers.php';
?>

</br></br>
<main>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <p class="card-text container"><?php echo $mensaje;?></p></br></br>
                </div>
                <a class="btn white blue-text right" href="<?php echo $direccion;?>" role="button">Ingresar</a>
            </div>
        </div>
    </div> 
</main> 
<?php include '../../templates/footer.php'; ?>