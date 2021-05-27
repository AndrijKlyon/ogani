<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\EModels\Subscriber;
use App\Facades\SubscriberService;

class SubscribeController extends Controller
{
    public function index(Request $request) {
        $email = $request->email;
        $subscriber = Subscriber::where('email', $email)->first();
        if($subscriber && $subscriber->unsubscribed_at == null) {
            SubscriberService::unsubscribe($subscriber);
            return 'unsubscribed';
        }
        elseif($subscriber && $subscriber->unsubscribed_at != null) {
            SubscriberService::resubscribe($subscriber);
            return 'resubscribed';
        }
        else {
            SubscriberService::subscribe($email);
            return 'subscribed';
        }
    }

}
