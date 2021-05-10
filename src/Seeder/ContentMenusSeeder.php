<?php

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Module\Content\BadasoContentModule;

class ContentMenusSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
        \DB::beginTransaction();
        try {
            $menus = \DB::table('menus');
            $last_menu = $menus->orderBy('id', 'desc')->first();
            $menu_id_now = $last_menu->id + 1;

            $new_menus = [
                'id' => $menu_id_now,
                'key' => BadasoContentModule::moduleName(),
                'display_name' => 'Content Manager',
                'created_at' => '2021-01-01 15:26:06',
                'updated_at' => '2021-01-01 15:26:06',
            ];

            $menus->insert($new_menus);
        } catch (Exception $e) {
            throw new Exception('Exception occur '.$e);
            \DB::rollBack();
        }

        \DB::commit();
    }
}
