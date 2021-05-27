<?php

namespace App\Services;

class RecentlyViewedService extends AdminService {

    public function recently($product) {
        $this->set($product->id);
        return $this->get();
    }

    protected function set($id) {
        $recentlyViewed = $this->getAll();
        if(!$recentlyViewed) {
            setcookie('recentlyViewed', $id, time()+3600*24, '/');
        }
        else {
            $recentlyViewed = explode('.', $recentlyViewed);
            if(!in_array($id, $recentlyViewed)) {
                $recentlyViewed[] = $id;
                $recentlyViewed = implode('.', $recentlyViewed);
                setcookie('recentlyViewed', $recentlyViewed, time() + 3600*24, '/');
            }
        }
    }

    protected function get() {
        if (!empty($_COOKIE['recentlyViewed'])) {
            $recentlyViewed = $_COOKIE['recentlyViewed'];
            $recentlyViewed = explode('.', $recentlyViewed);
            // return 10 last results: viewed products
            return array_slice($recentlyViewed, -10);
        }
        return false;
    }

    public function getAll() {
        if(!empty($_COOKIE['recentlyViewed'])) {
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }

}
