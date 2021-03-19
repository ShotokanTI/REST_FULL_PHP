<?php

namespace App\Models;

use App\Database\Connect;

class Migration
{

    public static function CreateDatabase()
    {
        $conn = new \PDO(DBDRIVE . ': host=' . DBHOST, DBUSER, DBPASS);
        $sql = "CREATE DATABASE " . DBNAME;
        if ($conn->exec($sql)) {
            $conn = null;
            self::CreateAllTables();
            return "Migrations criou a base de dados e as tabelas necessarias";
        } else {
            throw new \Exception("Migration já foi realizado,dê uma olhada no banco de dados.");
        }
    }

    public static function CreateAllTables()
    {
        $conn = Connect::conectar();
        $sql = ALLTABLES;
        $conn->exec($sql);
    }
}
