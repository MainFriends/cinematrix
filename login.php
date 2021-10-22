<?php
    require_once 'inc/functions.php';
    require_once 'inc/session.php';
    $_SESSION['pag'] = 'login';
    session_start();
    session(); 

    //Error de logueo
    if(isset($_GET['error'])){
       echo "<div class='alert alert-danger text-center'>
            <strong>¡Ups!</strong> El correo o la contraseña que ingresaste no coinciden con nuestros registros. Por favor, revisa e inténtalo de nuevo.
            </div>";
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinematrix - Inicia sesión o regístrate por favor</title>
    <link rel="shortcut icon" href="assets/img/logos/cinematrix_ico.png">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

            </div>

            <div class="col bg-white p-5 rounded-end">
                <div class="text-end">  
                    <img src="assets/img/logos/cinematrix.svg" width="80" class="mb-1" alt="">
                </div>

                <h3 class="fw-bold text-center py-1">Bienvenido de nuevo David.</h3>
                <hr style="color: #0056b2;" />
                <!-- LOGIN -->
                <form method="POST">
                    <div class="mb-4">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="correo" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label ">Contraseña</label>
                        <input type="password" class="form-control" name="pass" required>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" name="connected" class="form-check-input">
                        <label for="connected" class="form-check-label">Mantenerme conectado</label>
                    </div>

                    <div class="d-grid"> <!-- d-grid para que el botón abarque todo el ancho -->
                        <button type="submit" name="login" class="btn btn-dark">Iniciar sesión</button>
                    </div>
                    <div class="my-3">
                        <span><a href="#">¿Olvidaste tu contraseña?</a></span> <br>
                        <span>¿No tienes una cuenta? <a href="signup.php">Regístrate</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>