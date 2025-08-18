<?php


class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=nerdadas_horas;charset=utf8', 'appcomp', 'appcomp');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}

/*
class Database{
    public static function Connect(){
        $db = new mysqli("localhost", "appcomp", "appcomp", "app_compresores");
        $db->query("SET NAMES 'utf8'");
    }
}*/
