<?php

namespace App\Helpers;


class Json
{
    public static function Format($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
