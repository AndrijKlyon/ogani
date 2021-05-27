<?php

namespace App\Services;

use App\EModels\Modification;
use App\EModels\Option;

class OptionService extends AdminService {

    public function getOption($title) {
        return Option::where('title', $title)->first();
    }

    public function getOptions() {
        return Option::all();
    }

    public function checkDestroyOption($item, $model) {
        $result = array(
            'type' => 'success',
        );
        // Check, if modifications has this option
        $modifications = Modification::where('option_id', $item->id)->get();
        if ($modifications->isNotEmpty()) {
            $result = array(
                'type' => 'error',
                'message' => 'Удаление невозможно. Следующие товары содержат удаляемую опцию: ' . $modifications->pluck('product_id')->implode(', ')
            );
        }
        return $result;
    }

}
