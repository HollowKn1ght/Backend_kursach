<?php
/**
 ** Класс конфигурации базы данных
 */
namespace App\Models;

class DataBase
{
    public static function connToDB()
    {
        $conn = new \mysqli('mysql', 'root', 'root', 'appDB') or die("Could not connect to mysql" . mysqli_error($conn));
        return $conn;
    }
}