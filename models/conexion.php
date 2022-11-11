<?php

class Conexion
{

    public static function conectar()
    {
        // try {
        //     $mbd = new PDO('mysql:host=localhost;dbname=alquiler_carros', 'eliot', '123eliot22*');
        // } catch (PDOException $e) {
        //     print "¡Error!: " . $e->getMessage() . "<br/>";
        //     die();
        // }
        $mbd = new PDO('mysql:host=localhost;dbname=alquiler_carros', 'eliot', '123eliot22*');
        $mbd->exec('set names utf8');
        return $mbd;
    }

}

?>