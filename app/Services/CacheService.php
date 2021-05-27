<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;

class CacheService extends AdminService {

    public function getFromCache($model, $key) {
        $items = Cache::get($key);
        if(!$items) {
            $items = app("App\\EModels\\".$model)::all();
            Cache::put($key, $items, 3600);
        }
        return $items;
    }


    public function clearCache($keys) {
        if(!empty($keys)) {
            foreach($keys as $item) {
                Cache::forget($item);
                Session::flash('message', 'Кэш с заданным ключом очищен');
                Session::flash('alert-class', 'alert-success');
            }
        } else {
            Session::flash('message', 'Кэш с заданным ключом пуст или не найден');
            Session::flash('alert-class', 'alert-danger');
        }
        return;
    }

    public function clearTempFolder($folders) {
        if(!empty($folders)) {
            foreach($folders as $item) {
                $this->deleteTempFiles($item);
                Session::flash('message', 'Папка с временными изображениями очищена');
                Session::flash('alert-class', 'alert-success');
            }
        }
        else {
            Session::flash('message', 'Папка с временными изображениями пуста');
            Session::flash('alert-class', 'alert-danger');
        }
    }


    protected function deleteTempFiles($folder) {
        $files = Storage::disk('local_public')->files('img/'. $folder);
        if($files) {
            Storage::disk('local_public')->delete($files);
        }
        $child_folders = Storage::disk('local_public')->allDirectories('img/'. $folder);
            if($child_folders) {
                foreach($child_folders as $item) {
                    File::deleteDirectory(public_path($item));
                }
            }
        return;
    }

}
