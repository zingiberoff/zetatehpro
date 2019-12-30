<?php

namespace App\Catalog;

use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository implements ProductsRepository
{
    public function search(string $query = ''): Collection
    {

        return Product::query()
            ->where('name', 'like', "%{$query}%")
            ->orWhere('article', 'like', "%{$query}%")
            ->get();
    }
}