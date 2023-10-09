<?php

class Conexion{
    static public function conectar(){
        $host = 'localhost';
        $dbname = 'weddingafr';
        $user = 'root';

        $conectar = new PDO("mysql:host=$host;dbname=$dbname", "$user", "");

        $conectar -> exec("set names utf8");
        
        return $conectar;
    }
}