<?php
    require_once 'inc/signup.php';
    require_once 'inc/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinematrix - Regístrate</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style-signup.css">
    <style>
        span{ color:red}
    </style>
</head>
<body>
    <div class="container-lg mt-2 p-5">
        <div class="text-center">
            <a href="login.php"><img src="assets/img/logos/cinematrix.svg" width="200" alt=""></a>
            <h3 class="fw-bold">CINEMATRIX</h3>
            <p class="small text-center mb-5" style="color:gray">
                Donde la ficción se transporta a la realidad.
            </p>
        </div>
        <form class="row g-3" method="post" class="register">
            <div class="col-md-6">
                <label for="inputName" class="form-label">Nombre
                    <span class="required">*</span>
                </label>
                <input type="text" name="nombre" class="form-control" id="inputName" required>
            </div>
            <div class="col-md-6">
                <label for="inputLastname" class="form-label">Apellido
                <span class="required">*</span>
                </label>
                <input type="text" name="apellido" class="form-control" id="inputLastname" required>
            </div>  
            <div class="col-md-12">
                <label for="inputEmail" class="form-label">Correo electrónico
                <span class="required">*</span>
                </label>
                <input type="email" name="correo" class="form-control" id="inputEmail" required>
            </div>
            <div class="col-md-12">
                <label for="inputPassword" class="form-label">Contraseña
                <span class="required">*</span>
                </label>
                <input type="password" name="pass" class="form-control" id="inputPassword" required>
            </div>
            <div class="col-md-4">
                <label for="inputTel" class="form-label">Telefóno
                <span class="required">*</span>
                </label>
                <input type="tel" name="telefono" class="form-control" id="inputTel" required>
            </div>
            <div class="col-8">
                <label for="inputCity" class="form-label">Ciudad
                <span class="required">*</span>
                </label>
                <input type="text" name="ciudad" class="form-control" id="inputCity" required>
            </div>
            <div class="col-md-7">
                <label for="inputCountry" class="form-label">Pais
                <span class="required">*</span>
                </label>
                <select name="pais" id="inputCountry" class="form-select" required>
                    <option value="">Seleccione un país</option>
                    <?php
                        // Llenar la lista de opciones con paises de la DB
                        registroPais();
                    ?>
                </select>
            </div>
            <div class="col-md-5">
                <label for="inputDate" class="form-label">Fecha de nacimiento
                <span class="required">*</span>
                </label>
                <input type="date" name="date" class="form-control" id="inputDate" required>
            </div>
            <div class="col-md-12">
                <label for="radioG" class="form-label">Genero
                <span class="required">*</span>
                </label>
            </div>
            <div class="row">
                <div class="col-md-6 btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn">
                        <input type="radio" id="radioG" name="sexo" value="H" autocomplete="off" required> Hombre
                    </label>
                    <label class="btn">
                        <input type="radio" id="radioG" name="sexo" value="M" autocomplete="off"> Mujer
                    </label>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" name="registrarse" class="btn btn-dark">Registrarse</button>
            </div>
            <span class="small text-center mb-5" style="color:gray">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></span>
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>