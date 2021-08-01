<?php
    function session(){
        if(isset($_SESSION['rol'])){ //Valido si ya hay una sesión abierta
            if($_SESSION['rol'] == 1){ //Administrador
                header("location:admin/tables/usuarios/index.php");
            }else{ //Cliente
                header("location:index.php");
            }
        }
    }

    function registroPais(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM PAIS";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $pais){
            echo '<option value="'.$pais['ID_PAIS'].'">'.$pais['PAIS'].'</option>';
        }
    }

    function mostrarGeneros(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM GENERO";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $genero){
            echo '<option value="'.$genero['ID_GENERO'].'">'.$genero['GENERO'].'</option>';
        }
    }

    function mostrarClasificacion(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();    
        $query = "SELECT * FROM CLASIFICACION";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $clasificacion){
            echo '<option value="'.$clasificacion['ID_CLASIFICACION'].'">'.$clasificacion['CLASIFICACION'].'</option>';
        }
    }

    function mostrarEstados(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM ESTADO";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $estado){
            echo '<option value="'.$estado['ID_ESTADO'].'">'.$estado['DESCRIPCION'].'</option>';
        }
    }

    function mostrarPeliculas(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM PELICULA";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $pelicula){
            echo '<option value="'.$pelicula['ID_PELICULA'].'">'.$pelicula['TITULO'].'</option>';
        }
    }

    function mostrarSalas(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM SALA";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $sala){
            echo '<option value="'.$sala['ID_SALA'].'">'.$sala['NOMBRE'].'</option>';
        }
    }

    function mostrarIdiomas(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM IDIOMA";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $idioma){
            echo '<option value="'.$idioma['ID_IDIOMA'].'">'.$idioma['NOMBRE'].'</option>';
        }
    }

    function mostrarFormatos(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM FORMATO";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $formato){
            echo '<option value="'.$formato['ID_FORMATO'].'">'.$formato['FORMATO'].'</option>';
        }
    }

    function mostrarPromos(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM PROMOCION";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $promo){
            echo '<option value="'.$promo['ID_PROMO'].'">'.$promo['NOMBRE'].'</option>';
        }
    }

    function mostrarRoles(){
        require_once "config.php";
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $query = "SELECT * FROM ROLES";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $rol){
            echo '<option value="'.$rol['ID_ROL'].'">'.$rol['NOMBRE'].'</option>';
        }
    }
?>