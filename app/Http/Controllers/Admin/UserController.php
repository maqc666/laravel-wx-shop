<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function Index(Request $request){
        $user=User::where('id',$request->only('id'))->first();
        return view('admin.user.update',['user'=>$user,'title'=>'添加用户']);
    }
    public function getIndex(){
        $users=User::all();
        return view('admin.user.index',['users'=>$users,'title'=>'用户列表']);
    }
    public function edit(Request $request){
        $user=User::where('id',$request->only('id'))->first();
        return view('admin.user.update',['user'=>$user,'title'=>'添加用户']);
    }
    public function postUpdate(UserUpdateRequest $request){
        $user=User::where('id',$request->only('id'))->first();
        if($user['username']!=$request->username){
            if(User::where('username','like',$request->username)->first()){
                return back()->with('error','用户名已存在');
            }
        }
        $user->username=$request->username;
        $user->email=$request->email;
        $user->phone=$request->phone;
        if($request->hasFile('pic')){
            self::updateFile();
            $user->pic=self::updateFile();
        }
        $user->save();
        return redirect('admin/user')->with('info','更新成功');

    }
    public static function updateFile(){
        $pic=User::select('pic')->where('id',Input::only('id'))->first();
        $dbpic='.'.$pic['pic'];

        $defaultpic=config('app.upload_image_dir').'user.png';

        if($dbpic!=$defaultpic){
            if(file_exists(realpath($dbpic))){
                unlink(realpath($dbpic));
            }
        }
    }
    public function getDelete(Request $request){
        $id=$request->input('id');
        if(User::where('id',$id)->first()->delete()) {
            return back()->with('info', '删除成功!');
        }else{
            return back()->with('error','删除失败!');
        }
    }
}
