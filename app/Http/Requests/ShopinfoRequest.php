<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\User;
use App\EModels\Shopinfo;

use App\Facades\ShopinfoService;
use Illuminate\Support\Facades\Auth;

class ShopinfoRequest extends FormRequest
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
            'alias' => $this->alias ? $this->alias : ShopinfoService::UniqueAlias(new Shopinfo(), $this->title),
            'status' => isset($this['status']) ? '1' : '0',
            'user_id' => Auth::user()->id,
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
            'alias' => Rule::unique('shopinfos','alias')->ignore($this->shopinfo),
            'status' => 'required',
            'text' => 'required',
            'user_id' => [],
            'keywords' => [],
            'description' => [],
            'img' => [],
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Название обязательно',
            'title.max'    => 'Название очень длинное',
            'text.required'    => 'Контент обязателен',
            'alias.unique'    => 'Пост с таким псевдонимом уже есть! Можно оставить это поле пустым для автоматического создания псевдонима.',
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
