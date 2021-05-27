<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\User;
use App\EModels\PayMethod;

use App\Facades\PayMethodService;
use Illuminate\Support\Facades\Auth;

class PayMethodRequest extends FormRequest
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
        $this->merge([
            'alias' => $this->alias ? $this->alias : PayMethodService::UniqueAlias(new PayMethod(), $this->title)
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
            'title' => 'required|max:255',
            'alias' => Rule::unique('pay_methods','alias')->ignore($this->pay_method),
            'description' => []
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Название обязательно',
            'title.max'    => 'Название очень длинное',
            'alias.unique'    => 'Способ оплаты с таким псевдонимом уже есть! Можно оставить это поле пустым для автоматического создания псевдонима.',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Название',
            'alias' => 'Псевдоним',
        ];
    }
}
