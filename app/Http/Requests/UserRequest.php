<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::where('id', Auth::user()->id)->first()->hasRole('admin');
    }

    protected function prepareForValidation()
    {
        $current_password = ($this->id) ? User::where('id', $this->id)->first()->password : null;
        $current_confirmation = ($this->id) ? User::where('id', $this->id)->first()->password : null;
        $this->merge([
            'password' => $this->password ? $this->password : $current_password,
            'password_confirmation' => $this->password_confirmation ? $this->password_confirmation : $current_confirmation,
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
            'name' => ['required', Rule::unique('users','name')->ignore($this->user)],
            'password' => 'required|confirmed',
            'email' => ['required', 'email', Rule::unique('users','email')->ignore($this->user)],
            'file' => ['image'],
            'id' => [],
            'firstname' => [],
            'lastname' => [],
            'phone' => [],
            'address' => [],
            'role' => [],
            'img' => [],
            'description' => []
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Имя обязательно',
            'name.unique'    => 'Пользователь с таким именем уже есть',
            'file.image'    => 'Файл должен быть изображением',
            'password.required'    => 'Пароль обязателен',
            'password.confirmed'    => 'Пароли не совпадают',
            'email.required'    => 'Электронная почта обязательна',
            'email.unique'    => 'Пользователь с таким адресом электронной почты уже есть',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'password' => 'Псевдоним',
            'email' => 'Email'
        ];
    }
}
