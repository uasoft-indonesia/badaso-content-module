<?php

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Module\Content\BadasoContentModule;

class ContentFixedMenuItemSeeder extends Seeder
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
            $menus = \DB::table('menus')->where('key', BadasoContentModule::moduleName());
            $menu_id = $menus->id;

            $menu_items = \DB::table('menu_items');
            $add_menus_item = [
                'menu_id' => $menu_id,
                'title' => 'Content Manager',
                'url' => '/content',
                'target' => '_self',
                'icon_class' => 'dashboard_customize',
                'color' => '',
                'parent_id' => null,
                'order' => 2,
                'permissions' => 'browse_content',
                'created_at' => '2021-01-01 15:26:06',
                'updated_at' => '2021-01-01 15:26:06',
            ];

            $menu_items->insert($add_menus_item);
        } catch (Exception $e) {
            throw new Exception('Exception occur '.$e);
            \DB::rollBack();
        }

        \DB::commit();
    }
}
