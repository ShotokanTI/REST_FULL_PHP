<?php

namespace App\Helpers;

use App\Models\Models;

class InsertHelper
{
    private static $usersTable = 'usuarios';
    private static $enderecoTable = 'enderecos';

    public static function iterateModelUser()
    {
        $sql = 'INSERT INTO ' . self::$usersTable . " ";
        $sql .= "(";
        foreach (Models::$user as $usuarios) {
            $sql .= "$usuarios" . ",";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ")";
        $sql .= " VALUES ";
        $sql .= "(";
        foreach (Models::$user as $usuarios) {
            $sql .= ":" . "$usuarios" . ",";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ")";
        return $sql;
    }

    public static function iterateEnderecolUser()
    {
        $sql = 'INSERT INTO ' . self::$enderecoTable . " ";
        $sql .= "(";
        foreach (Models::$adress as $adress) {
            $sql .= "$adress" . ",";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ")";
        $sql .= " VALUES ";
        $sql .= "(";
        foreach (Models::$adress as $adress) {
            $sql .= ":" . "$adress" . ",";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ")";
        return $sql;
    }

}
