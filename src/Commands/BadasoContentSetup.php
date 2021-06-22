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

        $this->call('l5-swagger:generate');
    }

    private function hiddenTableHandle()
    {
        $table_name = 'content';
        $config_name_file = 'badaso-hidden-tables';
        $hidden_table = config($config_name_file);
        if (!in_array($table_name, $hidden_table)) {
            $hidden_table[] = $table_name;
            $content_config = VarExporter::export($hidden_table);
            $content_config = <<<PHP
            <?php
            
            return {$content_config} ;
            PHP;

            file_put_contents(config_path("{$config_name_file}.php"), $content_config);
        }
    }
}
