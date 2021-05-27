<?php

namespace App\Services;

use App\EModels\Post_Tag;

class PostTagService extends AdminService {

    public function checkDestroyPostTag($item, $model) {
        $result = array(
            'type' => 'success',
        );
        // Check, if modifications has this option
        $posts = Post_Tag::where('tag_id', $item->id)->get();
        if ($posts->isNotEmpty()) {
            $result = array(
                'type' => 'error',
                'message' => 'Удаление невозможно. Удаляемый тег привязан к следующим постам: ' . $posts->pluck('post_id')->implode(', ')
            );
        }
        return $result;
    }

}
