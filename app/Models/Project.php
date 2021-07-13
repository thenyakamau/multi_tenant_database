<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Project extends Model
{
    use HasFactory;


    public function configure($project_name)
    {
        config([
            'database.connections.mysql.database' => $project_name,
        ]);

        DB::purge('mysql');

        DB::reconnect('mysql');

        Schema::connection('mysql')->getConnection()->reconnect();

        return $this;
    }

    public function use()
    {
        app()->forgetInstance('mysql');

        app()->instance('mysql', $this);

        return $this;
    }
}
