<?php

use Illuminate\Database\Seeder;

class BadasoContentModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BadasoContentPermissionsSeeder::class);
        $this->call(BadasoContentRolePermissionsSeeder::class);
        $this->call(BadasoContentMenusSeeder::class);
        $this->call(BadasoContentFixedMenuItemSeeder::class);
    }
}
