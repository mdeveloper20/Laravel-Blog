<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //

    public function login(Request $request){
        $user=User::where('email',$request->email)->where('password',md5($request->password))->first();

        if($user!=null){
            $token=md5(time());
            $user->token=$token;
            $user->save();
            return response()->json(['token'=>$token,'success'=>1]);
        }
        return response()->json(['success'=>0]);

    }

    public function register(Request $request){
        $user=new User();
        $user->email=$request->email;
        $user->password=md5($request->password);
        $user->address=$request->address;
        $user->role=0;
        $user->name=$request->name;

        try{
            $user->save();
            return response()->json(['success'=>1]);

        }catch(Exception $e){
            return \response()->json(['success'=>0],500);

        }

    }

}
