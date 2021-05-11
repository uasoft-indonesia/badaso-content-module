<?php

namespace Uasoft\Badaso\Module\Content\Commands;

use Illuminate\Console\Command;
use Uasoft\Badaso\Module\Content\Seeder\ContentModuleSeeder;

class BadasoContentSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badaso-content:setup';

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
            $this->call('db:seed', [
                '--class' => ContentModuleSeeder::class,
            ]);

            // $this->call('badaso:generate-seeder', [
            //     'tables' =>'menus,menu_items,permissions',
            // ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
