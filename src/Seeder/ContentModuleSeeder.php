<?php

namespace Uasoft\Badaso\Module\Content\Seeder;

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
        $this->call(ContentMenusSeeder::class);
        $this->call(ContentFixedMenuItemSeeder::class);
    }
}
