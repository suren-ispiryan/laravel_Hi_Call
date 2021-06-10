<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name'=>'min:2',
            'password'=>'min:6|max:15|nullable',
            'avatar' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ];
    }
}
