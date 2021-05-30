<?php

namespace Uasoft\Badaso\Module\Content\Commands;

use Illuminate\Console\Command;

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
}
