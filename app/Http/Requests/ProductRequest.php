<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\User;
use App\EModels\Product;

use App\Facades\ProductService;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'alias' => $this->alias ? $this->alias : ProductService::UniqueAlias(new Product(), $this->title),
            'special_price' => $this['special_price'] ? $this['special_price'] : null,
            'status' => isset($this['status']) ? '1' : '0',
            'hit' => isset($this['hit']) ? '1' : '0',
            'category_id' => ($this['category_id'] == 'Выберите категорию' || $this['category_id'] == '') ? '' : $this['category_id'],
            'related' => isset($this['related']) ? $this['related'] : null,
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
            'alias' => Rule::unique('products','alias')->ignore($this->product),
            'price' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'special_price' => [],
            'keywords' => [],
            'description' => [],
            'brand_id' => [],
            'img' => [],
            'content_img' => [],
            'hit' => [],
            'status' => [],
            'collection_id' => [],
            'images' => [],
            'new_images' => [],
            'option' => [],
            'modification_price' => [],
            'specifications_feature' => [],
            'specifications_value' => [],
            'related' => []
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Название обязательно',
            'title.max'    => 'Название очень длинное',
            'alias.unique'    => 'Товар с таким псевдонимом уже есть! Можно оставить это поле пустым для автоматического создания псевдонима',
            'category_id.required' => 'Не выбрана категория! Пожалуйста, выберите категорию товара'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Название',
            'alias' => 'Псевдоним',
            'price' => 'Цена'
        ];
    }
}
