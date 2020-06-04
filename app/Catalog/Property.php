<?php

namespace App\Catalog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Property
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Property extends Model
{
    //
    protected $fillable = ['*'];

    public function getValueAttribute()
    {
        if (!$this->relations) return null;

        $value = $this->relations['pivot']->value;
        if ($value != null) return $value;

        $valueId = $this->relations['pivot']->value_id;

        return PropertyValue::find($valueId)->get->value;
    }

    public function values()
    {
        return $this->hasMany(PropertyValue::class);
    }
}
