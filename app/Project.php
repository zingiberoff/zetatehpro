<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name', 'description', 'date_release', 'customer_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
