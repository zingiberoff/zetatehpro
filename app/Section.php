<?php

namespace App;

use App\Catalog\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Section extends Model
{
    use \Kalnoy\Nestedset\NodeTrait;
    //
    protected $fillable = ['name', 'slug'];

    public static function firstOrCreateForPath(string $path)
    {
        $path = array_map('trim', explode('/', $path));
        $parent_id = null;
        $section = false;
        foreach ($path as $name) {
            $section = self::firstOrCreate(['name' => $name, 'parent_id' => $parent_id], ['slug' => Str::slug($name)]);
            $parent_id = $section->id;
        }
        return $section;

    }

    public function allProducts()
    {
        $sections = $this->descendants()->pluck('id');
        $sections[] = $this->getKey();

        return Product::whereHas('sections', function ($q) use ($sections) {
            $q->whereIn('id', $sections);
        })->get();


    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    // Генерация пути
    public function generatePath()
    {
        $slugs = $this->ancestors()->lists('slug');
        $slugs[] = $this->slug;

        $this->path = implode('/', $slugs);

        return $this;
    }

// Получение ссылки
    public function getUrl()
    {
        return 'catalog/' . $this->path;
    }
}
