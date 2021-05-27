<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;

class UserAvatarService extends AdminService
{
    public function store_avatar($request) {
        if(isset($request['file'])) {
            $file = $request['file'];
            $userCount = User::count();
            $path = $file->storeAs(
                'img/users',  ($userCount + 1). '.'.$file->extension(), 'local_public'
            );
            $this->save_avatar($path);
            return $path;
        }
        return null;

    }

    public function update_avatar($request, $user_id) {

        $edit_user = User::where('id', $user_id)->first();
        if(isset($request['file'])) {
            if($edit_user['img'] != null) {
                Storage::disk('local_public')->delete($edit_user['img']);
            }
            $file = $request['file'];
            $path = $file->storeAs(
                'img/users', $edit_user->id. '.'.$file->extension(), 'local_public'
            );
            $this->save_avatar($path);
            return $path;
        }
        return null;
    }

    protected function save_avatar($path) {
        $imageFile = Image::make(public_path($path));
        if($imageFile) {
            $imageFile->fit(90, 90);
            $imageFile->save();
        }
        return;
    }

    public function delete_avatar($user) {
        if($user['img'] != null) {
            Storage::disk('local_public')->delete($user['img']);
        }
    }

}
