<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomDataBaseConnector
{
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
