<?php

namespace App\Http\Controllers;

use App\Catalog\EloquentProductRepository;
use App\Catalog\Product;
use App\User;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('properties')->paginate(24);

        return view('catalog.index', ['products' => $products]);
    }   //

    public function search(EloquentProductRepository $productRepository, Request $request)
    {
        $products = $productRepository->search($request->q, 20);

        return view('catalog.search', ['products' => $products]);
    }

}
