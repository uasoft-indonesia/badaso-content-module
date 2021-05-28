<?php

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Permission;

class ContentPermissionsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'fill_content',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key' => $key,
                'table_name' => 'content',
                'description' => 'Fill content',
            ]);
        }

        Permission::generateFor('content');
    }
}
