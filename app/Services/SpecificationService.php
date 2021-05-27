<?php

namespace App\Services;
use App\EModels\Specification;

class SpecificationService extends AdminService {
    public function storeSpecifications($data, $id) {
        $specifications = $this->getSpecifications($data);
        if ($specifications != null && !empty($specifications)) {
            $this->formAndSaveSpecifications($specifications, $id);
        }
        return;
    }

    protected function getSpecifications($data) {
        if(isset($data['specifications_feature'])) {
            $i=0;
            $specifications = array();
            foreach($data['specifications_feature'] as $item) {
                if($data['specifications_feature'][$i] != null && $data['specifications_value'][$i] != null) {
                    array_push($specifications, ['feature'=> $data['specifications_feature'][$i],
                    'value' => $data['specifications_value'][$i]]);
                }
                $i++;
            }
        }
        return isset($specifications) ? $specifications : null;
    }

    protected function formAndSaveSpecifications($specifications, $id) {
        // dd($specifications, $id);
        $query = array();
        foreach($specifications as $item) {
            array_push($query, ['product_id' => $id,
                                'feature' => $item['feature'],
                                'value' => $item['value']]);
        }
        Specification::insert($query);
    }

    public function updateSpecifications($data, $id) {
        $specifications = $this->getSpecifications($data);
        $product_specifications = Specification::where('product_id', $id)->select('feature', 'value')->get()->toArray();

        // New specifications was added - insert it to DB
        if (empty($product_specifications) && !empty($specifications) && $specifications != null) {
            $this->formAndSaveSpecifications($specifications, $id);
        }
        // Ixists specifications was deleted - delete it from DB and disk
        if (empty($specifications) && !empty($product_specifications)) {
            Specification::where('product_id', $id)->delete();
        }
         // product specifications was changed - delete old values and store new values
         if (!empty($specifications)) {
            $result = strcmp(json_encode($product_specifications), json_encode($specifications));
            // $result = array_diff($product_specifications, $specifications);
            // dd($result);
            if (!empty($result) || count($product_specifications) != count($specifications)) {
                //delete old values
                Specification::where('product_id', $id)->delete();
                // store new values
                $this->formAndSaveSpecifications($specifications, $id);
            }
        }
        return;
    }
}
