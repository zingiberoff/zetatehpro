<?php

namespace App\Catalog;

use Illuminate\Database\Eloquent\Model;


class PropertyValue extends Model
{
    //
    public $timestamps = false;

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

}
