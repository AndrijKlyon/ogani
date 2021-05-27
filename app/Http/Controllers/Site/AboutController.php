<?php

namespace App\Http\Controllers\Site;

use App\EModels\Aboutrecord;

use App\Http\Controllers\Site\SiteController;

class AboutController extends SiteController
{
    public function about() {
        return view('site.about.index', [
            'aboutrecords' => Aboutrecord::all(),
            'meta' => [
                'title' => config('template_settings.site.title') . ' - О магазине',
                'keywords' => 'о магазине',
                'description' => 'о магазине',
            ],
            'breadcrumb_title' => 'О магазине'
        ]);
    }
}
