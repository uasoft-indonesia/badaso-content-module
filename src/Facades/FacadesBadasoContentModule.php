<?php

namespace Uasoft\Badaso\Module\Content\Facades;

use Illuminate\Support\Facades\Facade;

class FacadesBadasoContentModule extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'badaso-content-module';
    }
}
