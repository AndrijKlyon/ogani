<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class CheckoutRequest extends FormRequest
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
            'name' => Auth::user() ? Auth::user()->name : $this->name,
            'email' => Auth::user() ? Auth::user()->email : $this->email,
            'password' => Auth::user() ? Auth::user()->password : $this->password,
            'password_confirmation' => Auth::user() ? Auth::user()->password : $this->password_confirmation,
            'note' =>  $this->note ? $this->note : '',
            'shipping_method' => $this->shipping_method ? $this->shipping_method : 'не определен',
            'pay_method' => $this->pay_method ? $this->pay_method : 'не определен',
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
                'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore(Auth::user())],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()) ],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'firstname' => ['required', 'string'],
                'lastname' => ['required', 'string'],
                'phone' => ['required'],
                'address' => ['required', 'string'],
                'shipping_method' => ['required', 'string'],
                'pay_method' => ['required', 'string'],
                'note' => []
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Имя пользователя обязательно',
            'email.required'    => 'Email пользователя обязателен',
            'password.required'    => 'Пароль пользователя обязателен',
            'phone.required'    => 'Телефон получателя обязателен',
            'address.required'    => 'Адрес получателя обязателен',
            'firstname.required'    => 'Имя получателя обязательно',
            'lastname.required'    => 'Фамилия получателя обязательна',
            'pay_method.required'    => 'Не указан способ оплаты',
            'shipping_method.required'    => 'Не указан способ доставки',
            'email'    => 'Введите корректный адрес электронной почты',
            'string'    => 'Значение поля должно быть строчным',
            'confirmed'    => 'Пароли не совпадают',
            'name.unique'    => 'Пользователь с таким именем уже есть',
            'email.unique'    => 'Пользователь с таким email уже есть',
            'rules_checkbox.required' => 'Подтвердите свое согласие с условиями предоставления услуг'
        ];
    }
}


