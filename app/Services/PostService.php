<?php

namespace App\Services;

use App\EModels\Post;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

use App\Facades\ImageService;
use App\Facades\RelatedService;

class PostService extends AdminService {

    // site
    public function getLatestPosts() {
        return Post::with('author', 'comments')
                    ->where(['status' => '1', 'hit'=> '1'])
                    ->latest('id')
                    ->limit(3)
                    ->get();
    }

    public function getPopularPosts() {
        return Post::orderByViews()
                    ->where(['status' => '1'])
                    ->limit(5)
                    ->get();
    }

    public function getPosts($request) {

        $posts = QueryBuilder::for(Post::class)
        ->allowedFilters('title', AllowedFilter::exact('category.alias'),
        AllowedFilter::exact('tags.alias'),
        AllowedFilter::exact('author.id'))
        ->where('status', '1')
        ->with('comments', 'tags', 'author')
        ->latest('id')->paginate(4);

        JavaScriptFacade::put([
            'product_count' => $posts->total(),
            'paginate_pages' => $posts->lastPage(),
            'cat_alias' => isset($request->filter['category.alias']) ? $request->filter['category.alias'] : null,
            'tags_alias' => isset($request->filter['tags.alias']) ? $request->filter['tags.alias'] : null,
            'title' => isset($request->filter['title']) ? $request->filter['title'] : null,
            ]);
        return $posts;
    }

    public function getPost($post_alias) {

        $post = Post::where('alias', $post_alias)->with('tags', 'related')
        ->firstOrFail();

        if(isset($post)) {
            JavaScriptFacade::put([
                'product_count' => null,
                'paginate_pages' => null,
                'cat_alias' => $post->category->alias,
                'tags_alias' => $post->tags,
                'title' => $post->title,
                ]);
        }
        return $post;
    }

    // admin

    public function actionsStorePost($item, $data, $model, $mode,  $imgs) {

        // Post store
        $id = $this->store_item($item, $model, $data, $mode);
        if($mode == 'save') {
            // Related tags store
            RelatedService::storeRelated($data['tags'], $id, 'tag_id', 'post_id', 'Post_Tag');
        }
        if($mode == 'update') {
            // Related tags update
            RelatedService::updateRelated($data['tags'], $item->id, 'tag_id', 'post_id', 'Post_Tag');
        }
        return 'finish';
    }

    public function actionsDestroyPost($item, $model) {
          // Croppa variations
          ImageService::deleteImageVariations($item['img'], 'thumbs/posts', ['60x60', '80x80']);
    }

}
