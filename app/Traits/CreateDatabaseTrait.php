<?php

namespace App\Traits;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

trait CreateDataBaseTrait
{

    public function createDatabase(Project $project)
    {
        return DB::statement("CREATE DATABSE {$project->db_name} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }
}
