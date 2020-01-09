<?php

namespace App\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Product
 *
 * @property int $id
 * @property string $article
 * @property string $vendorArticle
 * @property string $name
 * @property string $description
 * @property string $cost_include
 * @property string $cost_realise
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCostInclude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCostRealise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereVendorArticle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{

    use SoftDeletes;

    protected $fillable = ['*'];

    public function loadPropertyFromRaec()
    {
        $client = RaecClient::getInstance();

        $response = $client->get('product',
            [
                'query' => ['filter[supplierId]' => $this->vendorArticle,
                    'filter[brand]' => 515,
                    'limit' => 1
                ]
            ]
        );
        if ($response->getStatusCode() != 200) {


            return;
        }
        $content = json_decode($response->getBody()->getContents());
        if (count($content) < 1) {

            echo $this->vendorArticle . PHP_EOL;
            return;
        }


        $raekData = $content[0];
        foreach ($raekData->features as $features) {

            $feature = Property::firstOrCreate(
                ['etim_id' => $features->id],
                [
                    'name' => $features->descriptionRu,
                    'type' => $features->type,
                ]);
            if ($features->type == 'A') {
                $value = PropertyValue::firstOrCreate(
                    ['etim_id' => $features->value, 'property_id' => $feature->id],
                    ['value' => $features->valueDescriptionRu]
                );

            } else {
                $value = PropertyValue::firstOrCreate(
                    ['value' => $features->value, 'property_id' => $feature->id]
                );
            }
            $this->properties()->detach($feature->id);
            $this->properties()->attach(
                $feature->id,
                ['value_id' => $value->id, 'value' => $value->value]
            );

        }
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'product_property_values')->withPivot('value_id', 'value');
    }

}