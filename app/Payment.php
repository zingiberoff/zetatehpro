<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable =['name','description','payment_type'];
    public function project(){
        return $this->hasOne(Project::class);
    }
}
