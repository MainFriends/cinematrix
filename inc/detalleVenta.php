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
    if(isset($_POST['arreglo'])){
        $data = $_POST['arreglo'];
        $_SESSION['butacas'] = $data;
    }

    // GUARDAMOS LOS COMBOS QUE SELECCIONO EL USUARIO
    if(isset($_POST['combo1'])){
        $_SESSION['COMBO1'] = $_POST['combo1'];
    }
    if(isset($_POST['combo2'])){
        $_SESSION['COMBO2'] = $_POST['combo2'];
    }
    if(isset($_POST['combo3'])){
        $_SESSION['COMBO3'] = $_POST['combo3'];
    }
    if(isset($_POST['combo4'])){
        $_SESSION['COMBO4'] = $_POST['combo4'];
    }
    if(isset($_POST['combo5'])){
        $_SESSION['COMBO5'] = $_POST['combo5'];
    }
    if(isset($_POST['combo6'])){
        $_SESSION['COMBO6'] = $_POST['combo6'];
    }
    if(isset($_POST['combo7'])){
        $_SESSION['COMBO7'] = $_POST['combo7'];
    }
    
?>