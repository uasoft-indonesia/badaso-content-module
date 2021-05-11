<?php

namespace Uasoft\Badaso\Module\Content\Commands;

use Illuminate\Console\Command;
use Uasoft\Badaso\Module\Content\Seeder\ContentTableSeeder;

class BadasoContentDummySeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badaso-content:dummy-seed-content';

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
        $this->call('db:seed', [
            '--class' => ContentTableSeeder::class,
        ]);
    }
}
