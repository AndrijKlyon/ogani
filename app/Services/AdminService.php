<?php

namespace App\Services;

use App\Facades\ImageService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Schema;

class AdminService {

    public function get_current_item($model, $id) {
        return app("App\\EModels\\".$model)->where('id', $id)->first();
    }

    public function store($item, $data, $model, $img=false, $mode = 'save', $additional_actions = false) {
        // Store model image
        if(Schema::hasColumn($model['resource'],'img') && $img) {
            $data['img'] = $this->store_image($item, $data, $model, $img, $mode);
        }
        // Do additional actions
        if($additional_actions) {
            $additional_actions_method = 'actionsStore'.$model['name'];
            $data = app("App\\Facades\\".$model['name']."Service")::$additional_actions_method($item, $data, $model, $mode, $additional_actions);
            if ($data == 'finish') {
                return;
            }
        }
        // Store item
        $this->store_item($item, $model, $data, $mode);
        return;
    }


    protected function store_image($item, $data, $model, $img, $mode) {
        if($mode == 'save' && $data['img']) {
            $image = ImageService::storeImage($data['img'], $model['resource'], $img);
        }
        if($mode == 'update' && ($data['img'] != $item['img'])) {
            $image = ImageService::updateImage($data['img'], $item, 'img', $model['resource'], $img);
        }
        if($mode == 'update' && ($data['img'] == $item['img'])) {
            $image = $item['img'];
        }
        return isset($image) ? $image : null;
    }


    public function store_item($item, $model, $data, $mode) {
        try {
            $item->fill($data);
            $item->save();
            $message_success = $this->get_success_message($item, $model, $mode);
            Session::flash('message', $message_success);
            Session::flash('alert-class', 'alert-success');
        }
        catch(Exception $e) {
            $message_error = $this->get_error_message($item, $model, $mode);
            Session::flash('message', $message_error);
            Session::flash('alert-class', 'alert-danger');
        }
        return $item->id;
    }

    protected function get_success_message($item, $model, $mode) {
        if($mode == 'save') {
            $message = $model['local_name'].' "'. $item[$model['field']] .'" : Успешно сохранено';
        }
        else if($mode == 'update') {
            $message = $model['local_name'].' "'. $item[$model['field']] .'" : Успешно обновлено';
        }
        else {
            $message = '';
        }
        return $message;
    }

    protected function get_error_message($item, $model, $mode) {
        if($mode == 'save') {
            $message = $model['local_name'].' "'. $item[$model['field']] .'" : Ошибки при сохранении';
        }
        else if($mode == 'update') {
            $message = $model['local_name'].' "'. $item[$model['field']] .'" : Ошибки при обновлении';
        }
        else {
            $message = '';
        }
        return $message;
    }

    public function viewed($item) {
        if($item['viewed'] == 0) {
            $item['viewed'] = 1;
            $item->save();
        }
    }

    public function UniqueAlias($model, $title) {
        $alias = Str::slug($title, '-');
        $category = $model->where('alias', $alias)->first();
            if($category) {
                $last_id = $model->latest('id')->first()->id;
                $alias = $alias . strval($last_id + 1);
                $category = $model->where('alias', $alias)->first();
                if($category) {
                    $alias = $this->UniqueAlias($model, $alias);
                }
            }
        return $alias;
    }

     // params
    public function destroy($model, $ids,
                            $additional_check = false,
                            $additional_actions = false) {
        $ids = explode(",", $ids);
        $items =  app("App\\EModels\\".$model['name'])->whereIn('id', $ids)->get();
        $success_messages = array();
        $error_messages = array();
        foreach($ids as $id) {
            $item = $items->firstWhere('id', $id);
            // Additional check before deleting
            if($additional_check) {
                $additional_check_method = 'checkDestroy'.$model['name'];
                $result = app("App\\Facades\\".$model['name']."Service")::$additional_check_method($item, $model);
                if($result['type'] == 'error') {
                    array_push($error_messages, $result['message']);
                    continue;
                }
            }
            // Delete model image
            if(Schema::hasColumn($model['resource'],'img')) {
                if($item['img'] != null && $item['img'] != '') {
                    ImageService::deleteImage($item['img'], $model['resource']);
                }
            }
            // Do additional actions
            if($additional_actions) {
                $additional_actions_method = 'actionsDestroy'.$model['name'];
                $result = app("App\\Facades\\".$model['name']."Service")::$additional_actions_method($item, $model);
            }
            // Delete model
            $result = $this->deleteItem($item);
            if($result == 'success') {
                $message_success = $model['local_name'].' "'. $item[$model['field']] .'" : Успешно удалено';
                array_push($success_messages, $message_success);
            }
            else {
                $message_error = $model['local_name'].' "'. $item[$model['field']] .'" : Ошибки при удалении';
                array_push($error_messages, $message_error);
            }
        }
        return $this->formMessage($success_messages, $error_messages);
    }

    protected function deleteItem($item) {
        try {
            $item->delete();
            $message = 'success';
        }
        catch (Exception $e) {
           $message = 'error';
        }
        return $message;
    }

    public function formMessage($success, $error) {
        if(!empty($success) && empty($error)) {
            $message = $success;
            Session::flash('message', $message);
            Session::flash('alert-class', 'alert-success');
        }
        if(empty($success) && !empty($error)) {
            $message = $error;
            Session::flash('message', $message);
            Session::flash('alert-class', 'alert-danger');
        }
        if(!empty($success) && !empty($error)) {
            $message = array_merge($success, $error);
            Session::flash('message', $message);
            Session::flash('alert-class', 'alert-warning');
        }
        return;
    }

    public function changestatus($item) {
        $item_status = $item->status == '0' ? '1' : '0';
        $item->update([
            'status' => $item_status
        ]);
        return;
    }

    public function changehit($item) {
        $item_hit = $item->hit == '0' ? '1' : '0';
        $item->update([
            'hit' => $item_hit
        ]);
        return;
    }

    public function changeviewed($item) {
        $item_viewed = $item->viewed == '0' ? '1' : '0';
        $item->update([
            'viewed' => $item_viewed
        ]);
        return;
    }


}
