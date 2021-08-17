<?php
    session_start();
    session_destroy();
    if($_SESSION['pag']=='index'){
        header("location:../index.php");
    }else if($_SESSION['pag']=='promociones'){
        header("location:../promociones.php");
    }else if($_SESSION['pag']=='detallePromo'){
        header("location:../detallePromo.php");
    }else if($_SESSION['pag']=='admin'){
        header("location:../login.php");
    }else if($_SESSION['pag']=='cartelera'){
        header("location:../cartelera.php");
    }else if($_SESSION['pag']=='pelicula'){
        header("location:../pelicula.php");
    }else if($_SESSION['pag']=='peliculas'){
        header("location:../peliculas.php");
    }else if($_SESSION['pag']=='quienes-somos'){
        header("location:../quienes-somos.php");
    }else if($_SESSION['pag']=='terminos'){
        header("location:../terminos.php");
    }
?>  