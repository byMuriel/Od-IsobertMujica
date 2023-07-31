<?php
session_start();

class ControllerLogin {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function login() {
        if (isset($_POST['loguearse'])) {
            //Con esto validamos el usuario ingresado y comprobamos que corresponda con un registro de la base de datos
            $emailIngresado = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $usuario = filter_var($emailIngresado, FILTER_VALIDATE_EMAIL);

            $sqlLogin = "SELECT count(*) as n_usuarios FROM users_login WHERE usuario = :usuario";
            $stmtLogin = $this->conexion->prepare($sqlLogin);
            $stmtLogin->bindParam(":usuario", $usuario);
            $stmtLogin->execute();
            $registroLogin = $stmtLogin->fetch(PDO::FETCH_LAZY);

            if ($registroLogin['n_usuarios'] == 1) {
                //Si hay un usuario registrado procedemos a validar la contraseña
                $contraseniaIngresadaLogin = htmlspecialchars($_POST['contrasenia']);

                $sql1 = "SELECT contrasenia FROM users_login WHERE usuario=:usuario";
                $stmt1 = $this->conexion->prepare($sql1);
                $stmt1->bindParam(":usuario", $usuario);
                $stmt1->execute();
                $registro1 = $stmt1->fetch(PDO::FETCH_LAZY);

                //Recordamos que la contraseña fue hasheada antes de guardarla en la base de datos por lo que hay que verificarla con la funcion password_verify()
                $hashedContraseniaLogin = $registro1['contrasenia'];
                if (password_verify($contraseniaIngresadaLogin, $hashedContraseniaLogin)) {
                    // La contraseña es válida, el inicio de sesión es exitoso
                    // Revisamos su rol y creamos las variables de sesión
                    try {
                        $sql2 = "SELECT d.nombre, d.apellidos, l._idUserLogin, l.usuario, l.rol FROM users_login l JOIN users_data d ON l.usuario = d.email WHERE l.usuario=:usuario;";
                        $stmt2 = $this->conexion->prepare($sql2);
                        $stmt2->bindParam(":usuario", $usuario);
                        $stmt2->execute();
                        $registro2 = $stmt2->fetch(PDO::FETCH_LAZY);

                        $_SESSION['nombreU'] = $registro2['nombre'];
                        $_SESSION['apellidosU'] = $registro2['apellidos'];
                        $_SESSION['emailU'] = $usuario;
                        $_SESSION['usuario'] = $registro2['usuario'];
                        $_SESSION['idUser'] = $registro2['_idUserLogin'];
                        $_SESSION['logueado'] = true;
                        $_SESSION['rol'] = $registro2['rol'];

                        $mensaje = "Gracias por ingresar.";
                        header("location:index.php?success=$mensaje");
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }

                } else {
                    // La contraseña es incorrecta, maneja el error correspondiente
                    $mensaje = "Contraseña invalida.";
                    header("location:login.php?error=$mensaje");
                }
            } else {
                // Usuario no registrado
                $mensaje = "Usuario no encontrado.";
                header("location:login.php?error=$mensaje");
            }
        }
    }
}

// Inicializar la conexión a la base de datos
include "bd.php";
$objConexion = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $contrasenia);

// Crear una instancia de la clase ControllerLogin y llamar al método login()
$controllerLogin = new ControllerLogin($objConexion);
$controllerLogin->login();
?>
