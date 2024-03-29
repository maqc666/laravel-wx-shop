<?php

namespace App\Http\Requests;



use Illuminate\Http\Request;

class UserUpdateRequest extends Request
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
            'username'      =>  'required|regex: /^\w{8,20}$/',
            'email'         =>  'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
            'phone'         =>  'required|regex:/^1\d{10}$/',
        ];
    }
    public function messages()
    {
        return [
            'username.required'     =>  '用户名不能为空',
            'username.unique'       =>  '用户名已经存在',
            'username.regex'        =>  '用户名格式不正确',
            'email.required'        =>  '邮箱不能为空',
            'email.regex'           =>  '邮箱的格式不正确',
            'phone.required'        =>  '手机号不能为空',
            'phone.regex'           =>  '手机号格式不正确'
        ];
    }
}
