<?php
    include_once "config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // CONSULTAMOS EL PRECIO DE LOS SNACKS SELECCIONADOS
    $id = $_POST['id'];
    $query = "SELECT * FROM COMBO WHERE ID_COMBO = ?";
    $statement = $conexion->prepare($query);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    print json_encode($data, JSON_UNESCAPED_UNICODE);
?>