<?php
    // CONEXIÓN MEDIANTE PDO
    class Conexion{
        public static function Conectar() {
            define('servidor','localhost:3306');
            define('nombre_db','cinematrix');
            define('usuario','root');
            define('password','');

            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

            try{
                $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_db, usuario, password, $opciones);
                return $conexion;
            }catch(Exception $e){
                die("No se ha podido conectar a la base de datos ".$e->getMessage());
            }
        }
    }
?>