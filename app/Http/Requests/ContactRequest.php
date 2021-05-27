<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
 * Prepare the data for validation.
 *
 * @return void
 */
protected function prepareForValidation()
{
    $this->merge([
        'user_name' =>  Auth::check() ? Auth::user()->name : $this->name,
        'user_email' => Auth::check() ?  Auth::user()->email : $this->email,
        'user_id' => Auth::check() ? Auth::user()->id : null,
        'subject' => $this->subject ? $this->subject : 'без темы',
    ]);
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required',
            'user_email' => 'required|email',
            'subject' => 'required',
            'text' => 'required',
            'user_id' => []
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'Имя',
            'user_email' => 'Email',
            'subject' => 'Тема',
            'text' => 'Сообщение'
        ];
    }

}
