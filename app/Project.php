<?php

namespace App;

use App\Catalog\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Project
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $date_release
 * @property int $confirm
 * @property int $realise
 * @property int $user_id
 * @property int $customer_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProjectFile[] $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereConfirm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereDateRelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereRealise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Project withoutTrashed()
 * @mixin \Eloquent
 */
class Project extends Model
{
    use SoftDeletes;

    protected $appends = ['sumInclude', 'sumRealize', 'sumAll'];
    //
    protected $fillable = ['name', 'description', 'date_release', 'customer_id', 'status_id', 'status_confirmation'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function status()
    {
        $this->hasOne(ProjectStatus::class);
    }
    public function payments(){
        $this->belongsTo(Payment::class);
    }

    public function files()
    {
        return $this->hasMany(ProjectFi-le::class);
    }

    public function getSumIncludeAttribute()
    {
        $result = 0;
        foreach ($this->products as $product) {
            $result += $product->cost_include * $product->pivot->count;

        }
        return $result;
    }

    public function getSumRealizeAttribute()
    {
        $result = 0;
        foreach ($this->products as $product) {
            $result += $product->cost_realise * $product->pivot->count;

        }
        return $result;
    }

    public function getSumAllAttribute()
    {

        $result = 0;
        if ($this->confirm) {
            $result += $this->sumInclude;
        }
        if ($this->realise) {
            $result += $this->sumRealize;
        }
        return $result;
    }

}
