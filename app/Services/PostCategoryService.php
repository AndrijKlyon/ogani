<?php

namespace App\Services;

use App\EModels\Post;

class PostCategoryService extends AdminService {

    public function checkDestroyPostCategory($category) {
        $posts = Post::where('category_id', $category->id)->get();
        if($posts->isNotEmpty()) {
            $result = array(
                'type' => 'error',
                'message' => 'Удаление невозможно: с категорей "'.$category->title.'" связаны посты: ' . $posts->pluck('id')->implode(', ')
            );
        }
        else {
            $result = array(
                'type' => 'success',
                'message' => ''
            );
        }
        return $result;
    }

}
