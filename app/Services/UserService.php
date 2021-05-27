<?php

namespace App\Services;

use App\EModels\Comment;
use App\EModels\Post;
use App\EModels\Rating;
use App\EModels\Subscriber;
use App\User;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Facades\UserAvatarService;

class UserService extends AdminService
{

    public function change_profile($path, $data) {
        $data['password'] = request('password') == null ? Auth::user()->password : Hash::make($data['password']);
        $data['img'] = isset($path) ? $path : Auth::user()->img;
        User::where('id', Auth::user()->id)->first()->update($data);
        Session::flash('message', 'Профиль успешно обновлен');
        return;
    }

    public function profile_update($data) {
        if(!Auth::user()) {
            $data['role'] = 'user';
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
        } else {
            $user = User::where('id', Auth::user()->id)->first();
            $user->update($data);
        }
        return $user;
    }

    public function actionsStoreUser($item, $data, $model, $mode) {
        if($mode == 'save') {
            $data['password'] = Hash::make($data['password']);
            $data['img'] = UserAvatarService::store_avatar($data);
        }
        if($mode == 'update') {
            if($data['password'] != $item->password) $data['password'] = Hash::make($data['password']);
            $path = UserAvatarService::update_avatar($data, $item->id);
            $data['img'] = $path == null ? $item->img : $path;
        }
        return $data;
    }

    public function checkDestroyUser($item, $model) {
        $result = array(
            'type' => 'success',
        );
        // Check, if user is admin
        $one_admin = $this->check_admin($item);
        if ($one_admin != null) {
            $result = array(
                'type' => 'error',
                'message' => $one_admin
            );
        }
        // Check, if user is author
        $author = $this->check_author($item);
        if ($author != null) {
            $result = array(
                'type' => 'error',
                'message' => $author
            );
        }
        return $result;
    }

    public function actionsDestroyUser($item, $model) {
        UserAvatarService::delete_avatar($item);
    }

    public function check_admin($user) {
        if($user->role == 'admin') {
            $admins = User::where('role', 'admin')->count();
            if($user->role == 'admin' && $admins == 1) {
                return 'Невозможно удалить пользователя. В системе должен быть как минимум один администратор.';
            }
        }
        return null;

    }

    public function check_author($user) {
        // User is author of posts
        $posts = Post::where('user_id', $user->id)->first();
        if($posts) {
            return 'Невозможно удалить пользователя. Пользователь является автором постов блога.';
        }
        // User is author of comments
        $comments = Comment::where('commenter_id', $user->id)->first();
        if($comments) {
            return 'Невозможно удалить пользователя. Пользователь является автором отзывов.';
        }
        // User is author of ratings
        $rating = Rating::where('user_id', $user->id)->first();
        if($rating) {
            return 'Невозможно удалить пользователя. Пользователь является автором рейтингов.';
        }
        // User is subscriber
        $subscriber = Subscriber::where('user_id', $user->id)->first();
        if($subscriber) {
            return 'Невозможно удалить пользователя. Пользователь является подписчиком.';
        }
        return null;
    }

}
