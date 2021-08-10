<?php
    session_start();
    if(isset($_POST['selectADULTREGULAR'])){
        $_SESSION['cantADULTREGULAR'] = $_POST['selectADULTREGULAR'];
    }

    if(isset($_POST['selectCINEPACKPAREJA2DUO'])){
        $_SESSION['cantCINEPACKPAREJA2D'] = $_POST['selectCINEPACKPAREJA2DUO'];
    }
?>