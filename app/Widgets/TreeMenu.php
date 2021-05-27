<?php

namespace App\Widgets;

use App\Facades\CategoryService;
use Arrilot\Widgets\AbstractWidget;

class TreeMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'tree' => '-',
        'tpl' => 'tree_menu',
        'prepend' => '',
        'current_category' => 0,
        'parent_category' => 0,
        'active_category' => 0,
        'parent_element' => 'ul',
        'child_element' => 'li',
        'name' => 'default_name',
        'cache' => true,
        'categories' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if($this->config['categories'] != null) {
            $categories = $this->config['categories'];
        }else {
            $categories = CategoryService::getCategories();
        }
        $categories = $categories->groupBy('parent_id')->sortKeys();
        //  dd($categories);
        return view('widgets.' . $this->config['tpl'], [
            'config' => $this->config,
            'categories' => $categories,
            'tree' => '',
        ]);
    }

}


