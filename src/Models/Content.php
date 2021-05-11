<?php

namespace Uasoft\Badaso\Module\Content\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $fillable = [
        'section_slug',
        'label',
        'value',
    ];
}
