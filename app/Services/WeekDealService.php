<?php

namespace App\Services;

use App\EModels\WeekDeal;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class WeekDealService extends AdminService {

    public function getWeekDeal() {
        $weekdeal = WeekDeal::first();
        if($weekdeal) {
            JavaScriptFacade::put([
                'timerdate' => $weekdeal->ended_at,
            ]);
            return $weekdeal;
        }
        return null;
    }
}
