<?php

namespace App\Catalog;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductsRepository
{
    public function search(string $query = ''): Collection;
}