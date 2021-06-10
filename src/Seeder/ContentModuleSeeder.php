<?php

namespace Database\Seeders;

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
        $this->call(ContentPermissionsSeeder::class);
        $this->call(ContentRolePermissionsSeeder::class);
        $this->call(ContentMenusSeeder::class);
        $this->call(ContentFixedMenuItemSeeder::class);
    }
}
