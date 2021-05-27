<?php

namespace App\Http\Controllers\Admin;

use App\EModels\Subscriber;
use App\Facades\SubscriberService;
use App\Http\Controllers\Admin\AdminController;

use Illuminate\Http\Request;
use Spatie\Newsletter\NewsletterFacade;

class SubscriberController extends AdminController
{
    protected $model = array(
        'resource' => 'subscribers',
        'name' => 'Subscriber',
        'local_name' => 'Подписчик',
        'field' => 'email'
    );
    protected $img = false;

    /**
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Подписчики'],
            'subscribers' => Subscriber::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание подписки'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $email = $request->input('email');
        SubscriberService::subscribe($email);
            return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subscriber = Subscriber::where('id', $id)->first();
        if($subscriber && $subscriber->unsubscribed_at == null) {
            SubscriberService::unsubscribe($subscriber);
        }
        elseif($subscriber && $subscriber->unsubscribed_at != null) {
            SubscriberService::resubscribe($subscriber);
        }
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        foreach(explode(",", $ids) as $id) {
            $item = SubscriberService::get_current_item($this->model['name'], $id);
            NewsletterFacade::delete($item->email);
        }

        // Delete item
        SubscriberService::destroy($this->model, $ids);
        return redirect(route($this->model['resource'].'.index'));
    }

}
