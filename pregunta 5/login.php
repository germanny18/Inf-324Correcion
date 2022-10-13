<?php
require_once("conexion.php");
//session_start();
if(!isset($_SESSION)){
    session_start();
}

if(isset($_GET['cerrar'])){
 session_unset();
 session_destroy();
}

   if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    $consulta = "SELECT*FROM acceso where usuario = '$username' and password='$password'";
    $resultado=mysqli_query($conexion,$consulta);

    $fila = mysqli_fetch_assoc($resultado);// boolean
    
    if($fila){

        $rol = $fila['rol_id'];
        $_SESSION['rol'] = $rol;
        if(isset($_SESSION['rol'])){
            switch($_SESSION['rol']){
                case 1:
                 header('location: admin.php');
                break;
     
                case 2:
                 header('location: director.php');
                 break;
                 
                 default;
            }
        }
        
    }else{
        echo "el usuario o contraseña son incorrectos";
    }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css">
    
</head>
<body>
<div class="formulario">
        <h1>Iniciar Sesion</h1>
    <form action="" method="POST">
        <div class="user">
        Nombre:
        <input type="text" name="username"><br>
        </div>
        <div class="password">
        contraseña:
        <input type="password" name="password"><br>
        </div>
        <input type="submit" value="Iniciar Sesion">
    </form>
    </div>
    
</body>
</html>