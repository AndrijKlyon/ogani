<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class UserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name' =>  $this->name ==null ? Auth::user()->name : $this->name,
            'email' => $this->email == null ? Auth::user()->email : $this->email ,
            'password' =>  $this->password == null ? Auth::user()->password : $this->password,
            'password_confirmation' => $this->password == null ? Auth::user()->password : $this->password_confirmation,

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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user())],
            'password' => ['required', 'confirmed', 'min:8'],
            'file' => ['image'],
            'firstname' => [],
            'lastname' => [],
            'address' => [],
            'phone' => [],
            'description' => []
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Имя обязательно',
            'file.image'    => 'Файл должен быть изображением',
            'name.unique'    => 'Пользователь с таким именем уже есть',
            'password.required'    => 'Пароль обязателен',
            'password.confirmed'    => 'Пароли не совпадают',
            'email.required'    => 'Электронная почта обязательна',
            'email.unique'    => 'Пользователь с таким адресом электронной почты уже есть',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'file' => 'Файл'
        ];
    }
}
