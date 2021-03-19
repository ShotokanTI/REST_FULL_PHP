<?php

namespace App\Services;

use App\Models\Migration;

class MigrationService 
{
    public function get()
    {
       return Migration::CreateDatabase();
    }

}
