<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

use App\User;

use Illuminate\Support\Facades\Auth;

class WeekDealRequest extends FormRequest
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
        $date = str_replace("/", "-", $this['ended_at']) . ' 23:59:59';
        $this->merge([
            'ended_at' => Carbon::create($date)
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
            'product_id' => 'required',
            'ended_at' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'product_id.required'    => 'Акционный товар обязателен',
            'ended_at.date'    => 'Некорректная дата окончания акции',
            'ended_at.required'    => 'Дата окончания акции обязательна'
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => 'Акционный товар',
            'ended_at' => 'Дата окончания акции'
        ];
    }
}
