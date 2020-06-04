<?php

namespace App\Catalog;

use Illuminate\Database\Eloquent\Model;


class PropertyValue extends Model
{
    protected $fillable = ['value', 'property_id'];

    public $timestamps = false;

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

}
