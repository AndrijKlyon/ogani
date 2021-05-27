<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

use App\EModels\Post;
use App\EModels\PostCategory;
use App\EModels\PostTag;
use App\Facades\PostService;
use App\Http\Controllers\Site\SiteController;

class PostController extends SiteController
{
    public function index(Request $request) {
        return view('site.posts.index', [
            'meta' => [
                'title' => config('template_settings.site.title') . ' - Блог',
                'keywords' => config('template_settings.site.keywords'),
                'description' => config('template_settings.site.description'),
            ],
            'posts' => PostService::getPosts($request),
            'post_count' => Post::count(),
            'categories' => PostCategory::withCount('posts')->get(),
            'tags' => PostTag::all(),
            'popular_posts' => PostService::getPopularPosts(),
            'breadcrumb_title' => 'Блог'
        ]);
    }

    public function show($alias) {

        $post = PostService::getPost($alias);
        views($post)->record();
        return view('site.post.index', [
            'meta' => [
                'title' => config('template_settings.site.title') . ' - ' . $post->title,
                'keywords' => config('template_settings.site.keywords'),
                'description' => config('template_settings.site.description'),
            ],
            'post' => $post,
            'tags' => PostTag::all(),
            'categories' => PostCategory::withCount('posts')->get(),
            'post_count' => Post::count(),
            'popular_posts' => PostService::getPopularPosts()
            ]);
    }
}

