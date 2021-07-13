<?php

namespace App\Console\Commands;

use App\Helpers\CustomDataBaseConnector;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Queue\Connectors\DatabaseConnector;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TenantsMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrate {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates tenants migrations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($id = $this->argument('id')) {
            $project = Project::findOrFail($id);
            if ($project) $this->execCommand($project);
        }

        return;
    }

    function execCommand(Project $project)
    {
        $command = 'migrate';
        $connector = new CustomDataBaseConnector();
        $connector->configure($project->db_name)->use();
        $this->info("Connecting to database {$project->db_name}");
        Artisan::call($command, [
            '--force' => true,
            '--path' => "/database/migrations/tenants"
        ]);

        $this->info("Ending connection to {$project->db_name}");
        $this->info('_________________________________');
    }
}
