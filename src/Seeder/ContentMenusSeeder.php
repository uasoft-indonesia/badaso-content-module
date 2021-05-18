<?php

namespace Uasoft\Badaso\Module\Content\Seeder;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Menu;
use Uasoft\Badaso\Module\Content\BadasoContentModule;

class ContentMenusSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @throws Exception
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();

        try {
            $new_menus = [
                'key'          => BadasoContentModule::moduleName(),
                'display_name' => 'Content Manager',
                'created_at'   => '2021-01-01 15:26:06',
                'updated_at'   => '2021-01-01 15:26:06',
            ];

            Menu::firstOrCreate($new_menus);
        } catch (Exception $e) {
            \DB::rollBack();
        }

        \DB::commit();
    }
}
