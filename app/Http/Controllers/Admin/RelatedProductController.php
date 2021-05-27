<?php

namespace App\Http\Controllers\Admin;

use App\EModels\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Facades\RelatedService;

class RelatedProductController extends Controller
{
    public function related(Request $request) {
        $query = $request->query('q') ? $request->query('q') : '';
        $data['items'] = [];
        $products = Product::where([
            ['status', '=', '1'],
            ['title', 'like', '%'.$query.'%']
            ])->limit(8)->get();
        if(count($products)>0) {
            $i = 0;
            foreach($products as $product) {
                $data['items'][$i]['id'] = $product['id'];
                $data['items'][$i]['text'] = $product['title'];
                $i++;
            }
        }
        return json_encode($data);
    }
}
