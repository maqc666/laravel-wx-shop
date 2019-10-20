<?php

namespace App\Http\Controllers;

use App\M3Result;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function login(Request $request){
        $username=$request->input('username','');
        $password=$request->input('password','');

        $m3_result=new M3Result;

        if($username==''||$password==''){
            $m3_result->status=1;
            $m3_result->message="账号或密码不能为空!";
            return $m3_result->toJson();
        }
        $admin=Admin::where('username',$username)->where('password',md5('bk',$password))->first();
        if(!$admin){
            $m3_result->status=2;
            $m3_result->message="账号或密码错误！";

        }else{
            $m3_result->status=0;
            $m3_result->message="登录成功！";

            $request->session()->put('admin',$admin);
        }
        return $m3_result->toJson();
    }
    public function toLogin(){
        return view('admin.login');
    }
}
