<?php

namespace App\Listeners;

use App\Events\CreateProjectDatabase;
use App\Events\DataBaseCreated;
// use App\Traits\CreateDataBaseTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CreateProjectDatabaseListener implements ShouldQueue
{

    // use CreateDataBaseTrait;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateProjectDatabase  $event
     * @return void
     */
    public function handle(CreateProjectDatabase $event)
    {
        //
        // dd($event->project);
        $project = $event->project;

        if (!DB::statement("CREATE DATABASE {$project->db_name} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
            throw new \ErrorException('Could not create database');
        }

        event(new DataBaseCreated($project));
    }
}
