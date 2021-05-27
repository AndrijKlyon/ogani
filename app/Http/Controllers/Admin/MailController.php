<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Spatie\QueryBuilder\QueryBuilder;
use App\Mail\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\EModels\ContactMessage;
use App\User;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Facades\MailService;
use Illuminate\Support\Facades\Auth;

class MailController extends AdminController
{
    public function messages() {
        return view('admin.mail.messages', [
            'messages' => QueryBuilder::for(ContactMessage::class)
            ->allowedFilters(['folder', 'subject'])
            ->with('user')
            ->orderBy('id', 'DESC')
            ->jsonPaginate(10),
            'new_messages' => ContactMessage::where('viewed', 0)->where('folder', 'inbox')->count(),
            'meta' => ['title' => 'Панель управления - Почтовые сообщения'],
        ]);
    }

    public function new($id = null) {
        if($id != null) {
            $message = ContactMessage::where('id', $id)->first();
        } else {
            $message = null;
        }
        return view('admin.mail.new', [
            'new_messages' => ContactMessage::where('viewed', 0)->where('folder', 'inbox')->count(),
            'meta' => ['title' => 'Панель управления - Новое сообщение'],
            'message' => $message
        ]);
    }

    public function prev(Request $request) {
        $message = ContactMessage::where('id', '<', $request->input('current'))->first();
        if($message != null) return $this->read($message->id);
        return $this->read($request->input('current'));
    }

    public function next(Request $request) {
        $message = ContactMessage::where('id', '>', $request->input('current'))->first();
        if($message != null) return $this->read($message->id);
        return $this->read($request->input('current'));
    }

    public function read($id) {
        $message = ContactMessage::where('id', $id)->first();
        MailService::viewed($message);
        return view('admin.mail.read', [
            'new_messages' => ContactMessage::where('viewed', 0)->where('folder', 'inbox')->count(),
            'message' => $message
        ]);
    }

    public function reads($id) {
        $message = ContactMessage::where('id', $id)->first();
        MailService::viewed($message);
        return view('admin.mail.sent', [
            'new_messages' => ContactMessage::where('viewed', 0)->where('folder', 'inbox')->count(),
            'message' => $message
        ]);
    }

    public function answer(Request $request) {
        if($request->input('id') != null) {
            if($request->input('mode') == 'reply') {
                $title = 'Ответить на сообщение';
            } else if($request->input('mode') == 'share') {
                $title = 'Переслать сообщение';
            }

            return view('admin.mail.answer', [
                'mode' => $request->input('mode'),
                'message' => ContactMessage::where('id', $request->input('id'))->first(),
                'new_messages' => ContactMessage::where('viewed', 0)->where('folder', 'inbox')->count(),
                'meta' => ['title' => $title],
            ]);
        }
        return abort(404);
    }

    public function draft(Request $request) {
        $message = new ContactMessage();
        $message->subject = $request->data['subject'];
        $user = User::where('email', $request->data['to'])->first();
        $message->user_name = $user != null ? $user->name : $request->data['user_name'];
        $message->user_name = $message->user_name != null ? $message->user_name : '';
        $message->user_email = $request->data['to'];
        $message->user_email = $message->user_email != null ? $message->user_email : '';
        $message->text = $request->data['mailtext'];
        $message->folder = 'draft';
        $message->type = 'draft';
        $message->viewed = 1;
        $message->created_at = Carbon::now();
        $message->updated_at = Carbon::now();
        $message->save();
        return 'ok';
    }

    public function send(Request $request) {
        $to = $request->input('to');
        $messages = [
            'to.required' => 'Адрес получателя обязателен.',
            'to.email' => 'Введите корректный адрес получателя.',
        ];
        Validator::make($request->all(), [
            'to' => 'required|email',
        ], $messages)->validate();
        $user = User::where('email', $to)->first();
        $user_name = $user != null ? $user->name : '';
        $subject = $request->input('subject');
        $text = $request->input('mailtext');
        // $sender = env('MAIL_USERNAME', Auth::user()->email);
        $message = [
            'subject' => $subject,
            'text' => $text
        ];
        Mail::to($to)->send(new Message($message));
        if($request->input('id') == null) {
            $message = new ContactMessage();
            $message->subject = $subject;
            $message->user_name = $user_name;
            $message->user_email = $to;
            $message->user_id = Auth::user()->id;
            $message->text = $text;
            $message->folder = 'sent';
            $message->type = 'sent';
            $message->viewed = 1;
            $message->created_at = Carbon::now();
            $message->updated_at = Carbon::now();
            $message->save();
        } else {
            $message = ContactMessage::where('id',$request->input('id'))->first();
            $message->folder = 'sent';
            $message->type = 'sent';
            $message->save();
        }

        return redirect(url('/admin/mail/messages?filter[folder]=sent'));
    }

    public function delete(Request $request, $id = null) {
        if($id != null) {
            $message = ContactMessage::where('id', $id)->first();
            if($message->folder != 'trash') {
                $message->update(['folder' => 'trash' ]);
                $message->update(['deleted_at' => Carbon::now()]);
            }
            else {
                $message->delete();
            }
            return redirect(url('/admin/mail/messages?filter[folder]=inbox'));
        }
        $ids = $request->input('ids');
        ContactMessage::whereIn('id', $ids)->where('folder', 'trash')->delete();
        ContactMessage::whereIn('id', $ids)->where('folder', '!=', 'trash')
                        ->update(['folder' => 'trash', 'deleted_at' => Carbon::now()]);

        return $ids;
    }
}
