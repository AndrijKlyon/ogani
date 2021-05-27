<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\SiteController;

use App\Mail\ContactMessage;
use App\Http\Requests\ContactRequest;

use App\EModels\ContactMessage as EModelsContactMessage;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends SiteController
{
    public function get() {
            return view('site.contact.index', [
                'meta' => [
                    'title' => config('template_settings.site.title') . ' - Контакты',
                    'keywords' => config('template_settings.site.keywords'),
                    'description' => config('template_settings.site.description'),
                ],
                'breadcrumb_title' => 'Контакты'
            ]);
    }

    public function post(ContactRequest $request) {

            $message = $request->validated();
            Mail::to(config('template_settings.contacts.email') )->send(new ContactMessage($message));
            EModelsContactMessage::create($message);
            Session::flash('message', 'Спасибо, Ваше сообщение отправлено!');
            Session::flash('alert-class', 'help-block with-success');
            return redirect()->route('contact');

    }
}

