<?php
    include_once "config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();

    //QUERYS
    //CONSULTA ASIENTOS
    $query = "SELECT * FROM ASIENTO";
    $stm = $conexion->prepare($query);
    $stm->execute();
    $asientos = $stm->fetchAll(PDO::FETCH_ASSOC);

    //FACTURA
    $userID = $_SESSION['id_usuario'];
    $subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
    $total = (isset($_POST['total'])) ? $_POST['total'] : '';

    //INSERTAR FACTURA
    $query = "CALL SP_ADD_FACTURA(?,?,?)";
    $statement = $conexion->prepare($query);
    $statement->bindParam(1, $userID, PDO::PARAM_INT);
    $statement->bindParam(2, $subtotal, PDO::PARAM_STR);
    $statement->bindParam(3, $total, PDO::PARAM_STR);
    $statement->execute();


    //DETALLE VENTA
    $idCartelera = (isset($_POST['idCartelera'])) ? $_POST['idCartelera'] : '';
    $userAsientos = $_SESSION['butacas'];

    //INSERTAR ASIENTOS
    if($_SESSION['cantADULTREGULAR']>0){
        $cantidad1 = $_SESSION['cantADULTREGULAR'];
        $inserts = 0;
        foreach($userAsientos as $asientosUser){
            if($inserts<$cantidad1){
                $idBoleto = 1;
                $asientoID = $asientosUser;
                $idCombo = 0;

                $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
                $statement = $conexion->prepare($query);
                $statement->bindParam(1, $userID, PDO::PARAM_INT);
                $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
                $statement->bindParam(3, $idBoleto, PDO::PARAM_INT);
                $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
                $statement->bindParam(5, $asientoID, PDO::PARAM_STR);
                $statement->execute();
                $inserts++;
            }
        }
    }
    if($_SESSION['cantCINEPACKPAREJA2D']>0){
        $cantidad = $_SESSION['cantCINEPACKPAREJA2D'] + $cantidad1;
        $inserts = 0;
        foreach($userAsientos as $asientosUser){
            if($inserts<$cantidad){
                $idBoleto = 2;
                $asientoID = $asientosUser;
                $idCombo = 0;

                $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
                $statement = $conexion->prepare($query);
                $statement->bindParam(1, $userID, PDO::PARAM_INT);
                $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
                $statement->bindParam(3, $idBoleto, PDO::PARAM_INT);
                $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
                $statement->bindParam(5, $asientoID, PDO::PARAM_STR);
                $statement->execute();
                $inserts++;
            }
        }
    }

    //INSERTAR COMBOS
    $combo1 = $_SESSION['COMBO1'];
    $combo2 = $_SESSION['COMBO2'];
    $combo3 = $_SESSION['COMBO3'];
    $combo4 = $_SESSION['COMBO4'];
    $combo5 = $_SESSION['COMBO5'];
    $combo6 = $_SESSION['COMBO6'];
    $combo7 = $_SESSION['COMBO7'];

    if($combo1[0][0]=1){
        $cantidad = $combo1[0][1];
        $idCombo = $combo1[0][0];
        $insert=0;
        while($insert<$cantidad){
            $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $userID, PDO::PARAM_INT);
            $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
            $statement->bindParam(3, $idAsiento, PDO::PARAM_INT);
            $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
            $statement->bindParam(5, $nombreAsiento, PDO::PARAM_STR);
            $statement->execute();
            $insert++;
        }
    }
    if($combo2[0][0]=2){
        $cantidad = $combo2[0][1];
        $idCombo = $combo2[0][0];
        $insert=0;
        while($insert<$cantidad){
            $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $userID, PDO::PARAM_INT);
            $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
            $statement->bindParam(3, $idAsiento, PDO::PARAM_INT);
            $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
            $statement->bindParam(5, $nombreAsiento, PDO::PARAM_STR);
            $statement->execute();
            $insert++;
        }
    }
    if($combo3[0][0]=3){
        $cantidad = $combo3[0][1];
        $idCombo = $combo3[0][0];
        $insert=0;
        while($insert<$cantidad){
            $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $userID, PDO::PARAM_INT);
            $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
            $statement->bindParam(3, $idAsiento, PDO::PARAM_INT);
            $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
            $statement->bindParam(5, $nombreAsiento, PDO::PARAM_STR);
            $statement->execute();
            $insert++;
        }
    }
    if($combo4[0][0]=4){
        $cantidad = $combo4[0][1];
        $idCombo = $combo4[0][0];
        $insert=0;
        while($insert<$cantidad){
            $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $userID, PDO::PARAM_INT);
            $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
            $statement->bindParam(3, $idAsiento, PDO::PARAM_INT);
            $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
            $statement->bindParam(5, $nombreAsiento, PDO::PARAM_STR);
            $statement->execute();
            $insert++;
        }
    }
    if($combo5[0][0]=5){
        $cantidad = $combo5[0][1];
        $idCombo = $combo5[0][0];
        $insert=0;
        while($insert<$cantidad){
            $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $userID, PDO::PARAM_INT);
            $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
            $statement->bindParam(3, $idAsiento, PDO::PARAM_INT);
            $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
            $statement->bindParam(5, $nombreAsiento, PDO::PARAM_STR);
            $statement->execute();
            $insert++;
        }
    }
    if($combo6[0][0]=6){
        $cantidad = $combo6[0][1];
        $idCombo = $combo6[0][0];
        $insert=0;
        while($insert<$cantidad){
            $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $userID, PDO::PARAM_INT);
            $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
            $statement->bindParam(3, $idAsiento, PDO::PARAM_INT);
            $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
            $statement->bindParam(5, $nombreAsiento, PDO::PARAM_STR);
            $statement->execute();
            $insert++;
        }
    }
    if($combo7[0][0]=7){
        $cantidad = $combo7[0][1];
        $idCombo = $combo7[0][0];
        $insert=0;
        while($insert<$cantidad){
            $query = "CALL SP_ADD_DETALLE(?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $userID, PDO::PARAM_INT);
            $statement->bindParam(2, $idCartelera, PDO::PARAM_INT);
            $statement->bindParam(3, $idAsiento, PDO::PARAM_INT);
            $statement->bindParam(4, $idCombo, PDO::PARAM_INT);
            $statement->bindParam(5, $nombreAsiento, PDO::PARAM_STR);
            $statement->execute();
            $insert++;
        }
    }

    


?>