<?php

namespace App\Services;

use App\Facades\ShopinfoService;
use Lavary\Menu\Facade as LavaryMenu;
use Illuminate\Support\Facades\Cache;

class MenuService {

    public function getMenu() {
        $menu = Cache::get('menu');
        if(!$menu) $menu = $this->createMenu();
        return $menu;
    }

    public function getFooterMenu() {
        $footer_menu = Cache::get('footer_menu');
        if(!$footer_menu) $footer_menu = $this->createFooterMenu();
        return $footer_menu;
    }

    protected function createMenu() {
        $menu = LavaryMenu::make('Menu', function($menu) {
            $menu->add('Главная', ['route'  => 'home']);
            $menu->add('Каталог', ['route'  => 'products']);
            $menu->add('Блог', ['route'  => 'posts']);
            $menu->add('Магазин', [])->nickname('shop');
            $menu->item('shop')->add('О магазине', ['route'  => 'about']);
            foreach(ShopinfoService::getShopinfo() as $item) {
                $menu->item('shop')->add($item->title, ['route'  => ['shop', 'alias' => $item->alias]]);
            }
            $menu->add('Контакты', 'contact');
        });
        Cache::put('menu',  $menu, 3600);
        return $menu;
    }

    protected function createFooterMenu() {
        $footer_menu = LavaryMenu::make('MyFooterBar', function($menu) {
            $menu->add('Каталог', ['route'  => 'products']);
            $menu->add('Блог', ['route'  => 'posts']);
            $menu->add('О магазине', ['route'  => 'about']);
            foreach(ShopinfoService::getShopinfo() as $item) {
                $menu->add($item->title, ['route'  => ['shop', 'alias' => $item->alias]]);
            }
            $menu->add('Контакты', 'contact');
        });
        Cache::put('footer_menu',  $footer_menu, 3600);
        return $footer_menu;
    }


}
