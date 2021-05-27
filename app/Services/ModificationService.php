<?php

namespace App\Services;
use App\EModels\Modification;

class ModificationService extends AdminService {

    public function getModification($product_id, $option_id) {
        return Modification::where(['product_id' => $product_id,
                                    'option_id' => $option_id,
                                    ])->firstOrFail();
    }

    public function storeModifications($data, $id) {
        $modifications = $this->getModifications($data, $id);
        if ($modifications != null && !empty($modifications)) {
            Modification::insert($modifications);
        }
        return;
    }

    protected function getModifications($data, $id) {
        if(isset($data['option'])) {
            $i=0;
            $modifications = array();
            foreach($data['option'] as $item) {
                if($data['option'][$i] != null) {
                    array_push($modifications, [
                                                'product_id' => $id,
                                                'option_id'=> $data['option'][$i],
                                                'modification_price' => $data['modification_price'][$i] != null ? (float)$data['modification_price'][$i] : null,
                                                ]);
                }
                $i++;
            }
            // check unique elements (remove duplicate)
            $modifications = array_map("unserialize", array_unique(array_map("serialize", $modifications)));
        }
        return isset($modifications) ? $modifications : null;
    }

    public function updateModifications($data, $id) {
        $modifications = $this->getModifications($data, $id);
        $product_modifications = Modification::where('product_id', $id)
        ->select('product_id','option_id', 'modification_price')->get()->toArray();

            // New specifications was added - insert it to DB
            if (empty($product_modifications) && $modifications != null && !empty($modifications)) {
                Modification::insert($modifications);
            }
            // Exists modifications was deleted - delete it from DB
            if ((empty($modifications) || $modifications == null) && !empty($product_modifications)) {
                Modification::where('product_id', $id)->delete();
            }
            // Product modifications was changed - delete old values and store new values
            if (!empty($modifications)) {
                $result = strcmp(json_encode($product_modifications), json_encode($modifications));
                if (!empty($result) || count($product_modifications) != count($modifications)) {
                    //delete old values
                    Modification::where('product_id', $id)->delete();
                    // store new values
                    Modification::insert($modifications);
                }
            }
        return;
    }

}
