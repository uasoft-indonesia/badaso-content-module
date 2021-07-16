<?php

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Menu;
use Uasoft\Badaso\Models\MenuItem;

class BadasoContentFixedMenuItemSeeder extends Seeder
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
            $menus = Menu::where('key', 'content-module')->first();
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
            ];

            MenuItem::firstOrCreate($add_menus_item);
        } catch (Exception $e) {
            \DB::rollBack();
        }

        \DB::commit();
    }
}
