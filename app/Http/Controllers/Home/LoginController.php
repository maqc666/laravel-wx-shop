<?php

namespace App\Http\Controllers\Home;

use App\User;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function getIndex(){
        return view('home/login');
    }
    public function postIndex(Request $request){

    }
    public function postRegister(Requests\RegisterRequest $request)
    {
        $Vcode = $request->input('Vcode');
        if(session('Vcode')!=$Vcode){
            return back()->with('error','验证码有误!');
        }
        $user = new User();
        $data = $request->only('username','password','email','');
        $user->password = Hash::make($data['password']);
        $user->status = 1;
        $user->username = $data['username'];
        $user->email = $data['email'];
        if($user->save()){
            return redirect('/login');
        }else{
            return back()->with('error','添加失败');
        }
    }
    public function getCaptcha()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Input::session()->flash('Vcode', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
