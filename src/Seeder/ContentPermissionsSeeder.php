<?php

namespace Uasoft\Badaso\Module\Content\Seeder;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Permission;

class ContentPermissionsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        Permission::generateFor('content');
    }
}
