<?php 
include("conex.php");
if(!empty($_POST["btningresar"])) {
    if(!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        $sql = $conn->query("SELECT `usuario`, `Contrasena`, `Locals` FROM `usuarios` WHERE usuario = '$usuario' and Contrasena= '$password'");
        if($sql->num_rows > 0) {
            $datos = $sql->fetch_object();
            $local = $datos->Locals;
            if($local === "Local 1") {
                header("location: Local_1/User_1.php");
                exit; // Es importante terminar el script después de redirigir
            } elseif($local === "Local 2") {
                header("location: Local_2/User_2.php");
                exit;
            } elseif($local === "Admin") {
                header("location: Admin/Administrador.php");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Usuario no encontrado </div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Contraseña Incorrecta</div>";
        }
    } else {
            echo "Campos Vacios";
    }
}


?>