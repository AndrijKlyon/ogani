<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\User;
use App\EModels\Category;
use App\Facades\CategoryService;

use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
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
            'alias' => $this->alias ? $this->alias : CategoryService::UniqueAlias(new Category(), $this->title),
            'hit' => isset($this->hit) ? '1' : '0',
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
            'parent_id' => 'required',
            'alias' => Rule::unique('categories','alias')->ignore($this->category),
            'hit' => 'required',
            'img' => [],
            'keywords' => [],
            'description' => []
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Название обязательно',
            'title.max'    => 'Название очень длинное',
            'parent_id.required'    => 'Родительская категория обязательна',
            'alias.unique'    => 'Категория с таким псевдонимом уже есть! Можно оставить это поле пустым для автоматического создания псевдонима.',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Название',
            'alias' => 'Псевдоним',
            'parent_id' => 'Родительская категория'
        ];
    }

}
