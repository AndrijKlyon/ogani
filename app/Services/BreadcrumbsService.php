<?php

namespace App\Services;


class BreadcrumbsService
{
    public static function getBreadcrumbs($categories, $category_id) {

        if(!$category_id) return false;
        $breadcrumbs = [];
        foreach ($categories as $k => $v) {
            if (isset($categories[$category_id-1])) {
                $breadcrumbs[$categories[$category_id-1]['alias']] = $categories[$category_id-1]['title'];
                $category_id = $categories[$category_id-1]['parent_id'];
            } else break;
        }
        return array_reverse($breadcrumbs);
    }

}
