<?php
    session_start();
    session_destroy();
    if($_SESSION['pag']=='index'){
        header("location:../index.php");
    }else if($_SESSION['pag']=='promociones'){
        header("location:../promociones.php");
    }else if($_SESSION['pag']=='detallePromo'){
        header("location:../detallePromo.php");
    }
?>  