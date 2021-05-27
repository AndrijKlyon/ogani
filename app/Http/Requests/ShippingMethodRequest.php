<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\User;
use App\EModels\ShippingMethod;

use App\Facades\ShippingMethodService;
use Illuminate\Support\Facades\Auth;

class ShippingMethodRequest extends FormRequest
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
            'alias' => $this->alias ? $this->alias : ShippingMethodService::UniqueAlias(new ShippingMethod(), $this->title)
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
            'alias' => Rule::unique('shipping_methods','alias')->ignore($this->shipping_method),
            'price' => 'required',
            'description' => []
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Название обязательно',
            'title.max'    => 'Название очень длинное',
            'price.required'    => 'Цена обязательна',
            'alias.unique'    => 'Товар с таким псевдонимом уже есть! Можно оставить это поле пустым для автоматического создания псевдонима'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Название',
            'alias' => 'Псевдоним',
            'price' => 'Цена',
        ];
    }
}
