<?php

namespace App\Http\Controllers\Site;

use App\Facades\CategoryService;
use App\Facades\ProductService;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Http\Request;

class SearchController extends SiteController
{
    public function getresults(Request $request) {

        $query = !empty($request->query) ? $request->input('query') : null;
        $cat_id = !empty($request->cat_id) ? $request->cat_id : null;
        $cat_ids = $cat_id != null ? CategoryService::getChildren($cat_id) : [];

        if($query && $query != null) {
            if($request->ajax()) {
                return json_encode(array('products' => ProductService::getLivesearchedProducts($query, $cat_ids)));
            } else {
                $category = $request->input('cat_alias') != null ? CategoryService::getCategories()->where('alias', $request->input('cat_alias'))->first()['alias'] : '';
                return redirect()->route('products',
                                    ['filter[title]=]' => $query,
                                    'filter[category.alias]' => $category ]);
            }
        }
        die();
    }

}
