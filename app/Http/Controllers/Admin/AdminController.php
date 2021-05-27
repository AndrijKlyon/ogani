<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\EModels\Comment;
use App\EModels\ContactMessage;
use App\EModels\Order;
use App\Facades\AdminService;
use Illuminate\Support\Facades\View;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class AdminController extends Controller

{
    public function __construct() {
        $new_orders = Order::where('status_id', 1)->count();
        $new_messages = ContactMessage::where('viewed', 0)->count();
        $new_comments = Comment::where('viewed',0)->count();
        View::share(['new_orders'=> $new_orders,
                     'new_messages' => $new_messages,
                     'new_comments'=>$new_comments]);
        JavaScriptFacade::put([
                    'homedir' => route('home'),
        ]);
    }

    // Change status
    public function changestatus($model, $id) {
        $item = AdminService::get_current_item($model, $id);
        AdminService::changestatus($item);
        return 'status changed';
    }

    // Change hit
    public function changehit($model, $id) {
        $item = AdminService::get_current_item($model, $id);
        AdminService::changehit($item);
        return 'hit changed';
    }

    // Change viewed
    public function changeviewed($model, $id) {
        $item = AdminService::get_current_item($model, $id);
        AdminService::changeviewed($item);
        return 'viewed changed';
    }
}
