<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\EModels\Subscriber;
use Illuminate\Support\Facades\Session;
use Spatie\Newsletter\NewsletterFacade;

class SubscriberService extends AdminService {

    public function subscribe($email) {
        $user = User::where('email', $email)->first();
        $subscriber = new Subscriber();
        $subscriber->email = $email;
        $subscriber->user_id = $user ? $user->id : null;
        $subscriber->unsubscribed_at = null;
        $subscriber->created_at = Carbon::now();
        $subscriber->updated_at = Carbon::now();
        $subscriber->save();
        if($user && $user->firstname != null) {
            NewsletterFacade::subscribe($email, ['FNAME'=>$user->firstname, 'LNAME'=>$user->lastname]);
        } else {
            NewsletterFacade::subscribe($email);
        }
        Session::flash('message', 'Подписчик подписан');
        Session::flash('alert-class', 'alert-success');
        return;
    }

    public function resubscribe($subscriber) {
        $subscriber->unsubscribed_at = null;
        $subscriber->save();
        NewsletterFacade::subscribeOrUpdate($subscriber->email);
        Session::flash('message', 'Подписчик подписан');
        Session::flash('alert-class', 'alert-success');
        return;
    }


    public function unsubscribe($subscriber) {
        $subscriber->unsubscribed_at = Carbon::now();
        $subscriber->save();
        NewsletterFacade::unsubscribe($subscriber->email);
        Session::flash('message', 'Подписчик отписан');
        Session::flash('alert-class', 'alert-success');
        return;
    }

}
