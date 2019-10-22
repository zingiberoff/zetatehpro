<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = ['name', 'inn', 'city', 'contact_person'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
