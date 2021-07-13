<?php

namespace App\Listeners;

use App\Events\DataBaseCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class DataBaseCreatedListener implements ShouldQueue
{
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
     * @param  DataBaseCreated  $event
     * @return void
     */
    public function handle(DataBaseCreated $event)
    {
        //
        $project = $event->project;
        $migrations = Artisan::call('tenant:migrate', [
            'id' => $project->id,
        ]);

        return $migrations === 0;
    }
}
