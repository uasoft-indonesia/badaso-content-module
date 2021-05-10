<?php

use Illuminate\Database\Seeder;

class ContentModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContentTableSeeder::class);
        $this->call(ContentPermissionsSeeder::class);
        $this->call(ContentModuleSeeder::class);
        $this->call(ContentFixedMenuItemSeeder::class);
    }
}
