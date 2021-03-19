<?php

namespace App\Services;

use App\Models\Total;

class TotalService
{
    public function get($param)
    {
        if(strlen($param) == 2){
            return Total::totalUsersByState($param);
        }else{
            return Total::totalUsersByCity($param);
        }
    }
}
