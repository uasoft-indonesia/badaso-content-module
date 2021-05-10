<?php

namespace Uasoft\Badaso\Module\Content\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BadasoContentSetup extends Command
{
    protected $file;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'badaso-content:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Badaso Content Manager Modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->file = app('files');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->publishSeeder();
    }

    public function publishSeeder()
    {
        Artisan::call('vendor:publish', ['--tag' => 'BadasoContentModule', '--force' => true]);
        $this->info('Success publish seeder');
    }
}
