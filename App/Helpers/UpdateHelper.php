<?php

namespace App\Helpers;

use App\Models\Models;
use Error;

class UpdateHelper
{
    public static function UpdateUser()
    {
        $sql = "UPDATE usuarios SET ";
        foreach (Models::$user as $user) {
            $sql .= "$user=:$user,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " WHERE id=:id";

        return $sql;
    }

    public static function UpdateEndereco()
    {
        $sql = "UPDATE enderecos SET ";
        foreach (Models::$adress as $adress) {
            $sql .= "$adress=:$adress,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " WHERE id=:id";

        return $sql;
    }


    public static function extractModelArray($remove, $data)
    {
        $removed = array();
        foreach ($remove as $removes) {
            if (key_exists($removes, $data)) {
                $removed[$removes] = $data[$removes];
            }
        }
        return $removed;
    }
}
