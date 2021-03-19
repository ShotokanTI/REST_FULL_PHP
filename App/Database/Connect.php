<?php

namespace App\Database;


class Connect
{

    public static function conectar()
    {
        return new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
    }

}
