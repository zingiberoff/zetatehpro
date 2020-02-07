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
        $section->parens = $section->ancestors()->get('id');
        $products = $section->allProducts()->paginate(24);

        return view('catalog.index', ['products' => $products, 'section' => $section]);
    }   //

    public function search(EloquentProductRepository $productRepository, Request $request)
    {
        $products = $productRepository->search($request->q);
        if ($request->ajax()) {
            return $products;
        }
        return view('catalog.index', ['products' => $products]);
    }

}
