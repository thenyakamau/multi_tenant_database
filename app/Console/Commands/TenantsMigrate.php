<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
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
        // Config::set('database.connections.mysql.database', $project->db_name);
        // Config(['database.connections.onthefly' => [
        //     'driver' => 'mysql',
        //     'host' => $project->db_host,
        //     'port' => $project->db_port,
        //     'database' => $project->db_name,
        //     'username' => $project->db_user,
        //     'password' => $project->db_password
        // ]]);
        // DB::connection('onthefly');
        $project->configure($project->db_name)->use();
        $this->info("Connecting to database {$project->db_name}");
        Artisan::call($command, [
            '--force' => true,
            '--path' => "/database/migrations/tenants"
        ]);

        $this->info("Ending connection to {$project->db_name}");
        $this->info('_________________________________');
    }
}
