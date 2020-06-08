<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog\Product;
use App\Catalog\Property;

class SelectionController extends Controller
{
    public function index()
    {
        return view('catalog.selection');
    }

    public function search(Request $request)
    {
        $params = $request->params;
        $sections = range(55, 89); //local
        // $sections = range(119, 153); //prod

        $res = Product::whereHas('sections', function ($query) use ($sections) {
            $query->whereIn('id', $sections);
        });

        if ($params) {
            foreach ($params as $property_id => $value_id) {
                $res = $res->whereHas('properties', function ($query) use ($property_id, $value_id) {
                    $query->where('property_id', $property_id)->where('value_id',  $value_id);
                });
            }
        }

        return $res->with('properties')->paginate(20);
    }

    public function properties()
    {
        //ID свойств у муфт
        $props_id = [97, 111, 112, 113, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 1410, 114]; //local
        // $props_id = [11525, 11526, 11527, 11529, 11546, 11547, 11548, 11596, 11597, 11598, 11599, 11600, 11601, 11602, 11603, 11604, 11605, 11607, 11608, 11609]; //prod

        $properties = Property::whereIn('id', $props_id)->with('values')->get();

        return $properties;
    }
}
