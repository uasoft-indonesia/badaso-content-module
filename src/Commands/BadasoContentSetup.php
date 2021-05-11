<?php

namespace Uasoft\Badaso\Module\Content\Commands;

use Illuminate\Console\Command;
use Uasoft\Badaso\Module\Content\Seeder\ContentModuleSeeder;

class BadasoContentSetup extends Command
{
    private $isGenerateSeeder;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badaso-content:setup {--generateSeeder=false}';

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
            $this->isGenerateSeeder = $this->option('generateSeeder');
            if ($this->isGenerateSeeder == null) {
                $this->isGenerateSeeder = true;
            }

            $this->generateSeeder();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function generateSeeder()
    {
        $this->call('db:seed', [
            '--class' => ContentModuleSeeder::class,
        ]);

        if ($this->isGenerateSeeder == 'true') {
            $this->call('badaso:generate-seeder', [
                'tables' => 'menus,menu_items,permissions',
            ]);
        }
    }
}
