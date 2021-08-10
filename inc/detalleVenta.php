<?php
    session_start();
    if(isset($_POST['valorSelect'])){
        $_SESSION['cant_boletos'] = $_POST['valorSelect'];
    }
?>