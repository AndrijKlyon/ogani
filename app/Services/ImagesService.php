<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class ImagesService extends AdminService {

    public function storeImages($data, $model, $img_params, $id) {
        $model_field = $this->getModelField($model);
        $model_image = $this->getModelImage($model);

        if(isset($data['new_images']) && !empty($data['new_images'])) {
            $image_model = new ImageService;
            $query = array();
                foreach($data['new_images'] as $img) {
                    $img = $image_model->storeImage($img, $model['resource'], $img_params);
                    array_push($query, [
                                        $model_field => $id,
                                        'img' => $img,
                                        ]);
                }
                $model_image::insert($query);
        }
        return;
    }

    protected function getModelField($model) {
        return strtolower ( $model['name'] ) . '_id';

    }

    protected function getModelImage($model) {
        return app("App\\EModels\\".$model['name'] . 'Image');
    }

    public function updateImages($data, $model, $img_params, $id) {
        $model_field = $this->getModelField($model);
        $model_image = $this->getModelImage($model);

        $product_img = $model_image::where($model_field, $id)->get();
        $product_images = $product_img->map(function ($image) {
            return collect($image->toArray())
                ->only(['img'])
                ->all();
        });

        $product_images = Arr::flatten($product_images);
        // Delete all exists images, that was deleted
        if(!isset($data['images']) || empty($data['images']) && !empty($product_images)) {
            $images = array();
            foreach($product_images as $item) {
                $path = 'img/'. $model['resource'] .'/'.$item;
                array_push($images, $path);
            }
            Storage::disk('local_public')->delete($images);
            $model_image::where( $model_field, $id)->delete();
        }
        // Delete images, that was deleted
        if(isset($data['images']) && !empty($data['images']) && !empty($product_images)) {
            $query = array();

            foreach($product_img as $item) {
                if(!in_array($item['img'], $data['images'])) {
                    $path = 'img/'. $model['resource'] .'/'.$item['img'];
                    Storage::disk('local_public')->delete($path);
                    array_push($query, $item->id);
                }
            }
            if(!empty($query)) {
                $model_image::destroy(collect($query));
            }
        }

        // Add new images
        if(isset($data['new_images']) && !empty($data['new_images'])) {
            $data['images'] = $data['new_images'];
            $this->storeImages($data, $model, $img_params, $id);
        }
        return;
    }
}
