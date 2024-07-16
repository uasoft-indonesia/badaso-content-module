<?php

namespace Uasoft\Badaso\Module\Content\Commands;

use Illuminate\Console\Command;
use Symfony\Component\VarExporter\VarExporter;

class BadasoContentSetup extends Command
{
    private $force;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badaso-content:setup {--force=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->force = $this->option('force');
            if ($this->force == null) {
                $this->force = true;
            }
            $this->generateSeeder();
            $this->hiddenTableHandle();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function generateSeeder()
    {
        $this->call('vendor:publish', [
            '--tag' => 'badaso-content-module',
            '--force' => $this->force,
        ]);

        try {
            $this->call('l5-swagger:generate');
        } catch (\Exception $e) {
            //throw $th;
        }
    }

    private function hiddenTableHandle()
    {
        $table_name = 'contents';
        $except_tables = ['migrations', 'activity_log', 'failed_jobs', 'personal_access_tokens', 'users', 'password_resets'];
        $config_name_file = 'badaso-hidden-tables';
        $hidden_table = config($config_name_file);

        $filter_hidden_tables = array_diff($hidden_table, $except_tables);
        $filter_hidden_table=[];
        foreach ($filter_hidden_tables as $value) {
            $filter_hidden_table[] = str_replace(ENV('BADASO_TABLE_PREFIX'), "", $value);
        }

        if (!in_array($table_name, $filter_hidden_table)) {
            $filter_hidden_table[] = $table_name;

            $prefixed_hidden_table = array_map(function ($item) use ($filter_hidden_table) {
                return
                "env('BADASO_TABLE_PREFIX', 'badaso_').'{$item}'";
            }, $filter_hidden_table);

            $default_table = array_map(function ($item) use ($except_tables) {
                return
                    "'{$item}'";
            }, $except_tables);

            $content_config = implode(",\n    ", $prefixed_hidden_table);
            $except_table = implode(",\n    ", $default_table);

            $content_config = "[\n    // badaso default table\n    {$content_config},\n\n// laravel default table\n    {$except_table},\n]";

            $content_config = <<<PHP
            <?php

            return {$content_config} ;
            PHP;

            file_put_contents(config_path("{$config_name_file}.php"), $content_config);
        }

    }
}
