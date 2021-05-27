<?php

namespace App\Services;

use App\EModels\Banner;
use Illuminate\Support\Facades\Cache;

class BannerService extends AdminService {

    public function getBanners() {
        $banners = Cache::get('banners');
        if(!$banners) {
            $banners = $this->getItems();
            Cache::put('banners', $banners, 3600);
        }
        return $banners;
    }

    protected function getItems() {
        $banners_list = Banner::latest('id')->limit(2)->get();
        if($banners_list->isNotEmpty() && $banners_list[0] != null) {
            for($i = 0; $i < 2; $i++) {
                $banners[$i] = $this->getContent($banners_list[$i]);
            }
        } else {
            $banners = null;
        }
        return $banners;
    }

    protected function getContent($banner) {
        $banner_type = class_basename($banner->model_type);
        if($banner_type == 'Product') {
            $item = app($banner->model_type)::where('id', $banner->model_id)->with('images')->first();
        }
        else {
            $item = app($banner->model_type)::where('id', $banner->model_id)->first();
        }
        $item->banner_type = $banner_type;
        return $item;
    }

}
