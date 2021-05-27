<?php

namespace App\Services;

use App\Facades\CacheService;

class ShopinfoService extends AdminService {

    public function getShopinfo() {
        return CacheService::getFromCache('Shopinfo', 'shopinfos');
    }

}
