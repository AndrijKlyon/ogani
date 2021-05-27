<?php

namespace App\Services;

use App\EModels\Post;
use App\EModels\User;

class LikeService extends AdminService {

    public function dispatchLike($request) {
        $post_id = isset($request->post_id) ? $request->post_id : null;
        $user_id = isset($request->user_id) ? $request->user_id : null;
        $type = isset($request->type) ? $request->type : null;
        if($post_id && $user_id && $type) {
            $this->updateDB($type, $post_id, $user_id);
        }
        return;
    }

    protected function updateDB($type, $post_id, $user_id) {
        $post = Post::where('id', $post_id)->first();
        $user = User::where('id', $user_id)->first();
        if($type == 'like') {
            $user->like($post);
        }
        elseif($type == 'dislike') {
            $user->unlike($post);
        }
        return;
    }

}
