<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\User;
use App\EModels\Post;

use App\Facades\PostService;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
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
            'alias' => $this->alias ? $this->alias : PostService::UniqueAlias(new Post(), $this->title),
            'status' => isset($this['status']) ? '1' : '0',
            'hit' => isset($this['hit']) ? '1' : '0',
            'user_id' => Auth::user()->id,
            'tags' => isset($this['tags']) ? $this['tags'] : null,
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
            'alias' => Rule::unique('posts','alias')->ignore($this->post),
            'hit' => 'required',
            'status' => 'required',
            'text' => 'required',
            'category_id' => 'required',
            'user_id' => [],
            'keywords' => [],
            'description' => [],
            'img' => [],
            'tags' => []
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
