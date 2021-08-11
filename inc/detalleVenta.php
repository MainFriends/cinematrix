<?php
    include_once "config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();

    // CANTIDAD DE BOLETOS
    if(isset($_POST['selectADULTREGULAR'])){
        $_SESSION['cantADULTREGULAR'] = $_POST['selectADULTREGULAR'];
    }

    if(isset($_POST['selectCINEPACKPAREJA2DUO'])){
        $_SESSION['cantCINEPACKPAREJA2D'] = $_POST['selectCINEPACKPAREJA2DUO'];
    }

    // GUARDAMOS LOS ASIENTOS QUE SELECCIONO EL USUARIO
    $data = $_POST['arreglo'];
    $_SESSION['butacas'] = $data;
?>