<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog\Product;

class SelectionController extends Controller
{
    public function index()
    {
        return view('catalog.selection');
    }

    public function search(Request $request)
    {
        $params = $request->params;
        $sections = range(55, 89);

        $res = Product::whereHas('sections', function ($query) use ($sections) {
            $query->whereIn('id', $sections);
        });

        if ($params) {
            \Debugbar::info("TRUE");
            foreach ($params as $property_id => $value_id) {
                $res = $res->whereHas('properties', function ($query) use ($property_id, $value_id){
                    $query->where('property_id', $property_id)->where('value_id',  $value_id);
                });
            }
        }

        return $res->with('properties')->paginate(20);
    }
}
