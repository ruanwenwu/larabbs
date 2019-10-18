<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  =>  'required|between:3,25|regex:/[a-zA-Z0-9\_\-]/|unique:users,name,'.Auth::id(),
            'email' =>  'required|email|unique:users,email,'.Auth::id(),
            'introduction'  =>  'max:80'
        ];
    }

    //验证错误返回信息
    public function messages(){
        return [
            'name.unique'   =>  '用户名只能唯一',
            'introduction.max'  =>  '用户介绍不能超过80个字'
        ];
    }
}
