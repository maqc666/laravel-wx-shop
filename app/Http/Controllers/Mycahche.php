<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Mycahche extends Controller
{
    //

    public function index(){
        return view('index');
    }




    public function up(Request $request){

      // dump($request->hasFile('pic'));

        $pic='not.jpg';

        if($request->hasFile('pic')){
            $file=$request->file('pic');

            $ext=$file->getClientOriginalExtension();

            $filename=time().'.'.$ext;

            $info=$file->move(public_path('upload'),$filename);
            $pic=$info->getFilename();

          dump($pic);

        }


    }


}
