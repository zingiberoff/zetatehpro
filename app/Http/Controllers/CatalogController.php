<?php

namespace App\Http\Controllers;

use App\Catalog\EloquentProductRepository;
use App\Catalog\Product;
use App\Catalog\Section;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('properties')->paginate(24);

        return view('catalog.index', ['products' => $products]);
    }   //

    public function getTree()
    {
        return Section::get()->toTree();
    }

    public function section(Section $section)
    {

        $products = $section->allProducts()->paginate(24);

        return view('catalog.index', ['products' => $products, 'title' => $section->name]);
    }   //

    public function search(EloquentProductRepository $productRepository, Request $request)
    {
        $products = $productRepository->search($request->q, 20);
        if ($request->ajax()) {
            return $products;
        }
        return view('catalog.search', ['products' => $products]);
    }

}
