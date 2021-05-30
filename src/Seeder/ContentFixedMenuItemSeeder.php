<?php

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\MenuItem;

class ContentFixedMenuItemSeeder extends Seeder
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
            $menus = \DB::table('menus')->where('key', 'badaso-content-module')->first();
            $menu_id = $menus->id;

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

            MenuItem::firstOrCreate($add_menus_item);
        } catch (Exception $e) {
            \DB::rollBack();
        }

        \DB::commit();
    }
}
