<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\User;
use App\EModels\PostCategory;

use App\Facades\PostCategoryService;
use Illuminate\Support\Facades\Auth;

class PostCategoryRequest extends FormRequest
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
            'alias' => $this->alias ? $this->alias : PostCategoryService::UniqueAlias(new PostCategory(), $this->title),
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
            'alias' => Rule::unique('post_categories','alias')->ignore($this->post_category),
            'description' => [],
            'keywords' => []
        ];
    }


    public function messages()
    {
        return [
            'title.required'    => 'Название обязательно',
            'title.max'    => 'Название очень длинное',
            'alias.unique'    => 'Категория с таким псевдонимом уже есть! Можно оставить это поле пустым для автоматического создания псевдонима.',
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
