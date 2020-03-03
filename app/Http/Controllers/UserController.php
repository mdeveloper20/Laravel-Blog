<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

/*
Role:
    0=>normal user
    1=>manager
    2=>admin
*/

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
            return response()->json(['success'=>0],500);

        }

    }

    public function create(Request $request){

        $current_user_role=$request->get('user')->role;

        $user=new User();
        $user->email=$request->email;
        $user->password=md5($request->password);
        $user->address=$request->address;
        $user->role=$request->role;
        $user->name=$request->name;

        try{
            $user->save();
            return response()->json(['success'=>1]);

        }catch(Exception $e){
            return response()->json(['success'=>0],500);

        }
    }


    public function get(Request $request){


        $selectedUser=User::where(['id'=>$request->id])->first();


        if($selectedUser){
            return response()->json($selectedUser);

        }else{
            return response()->json([],404);

        }

    }

    public function getAll(Request $request){


        $users=User::get();

        if($users){
            return response()->json($users);
        }else{
            return response()->json([],404);
        }

    }

    public function delete(Request $request){

        $success=false;

        try{
            $success=User::find($request->id)->delete();

        }catch(Exception $exception){
            return response()->json(['success'=>0],500);

        }finally{
            return response()->json(['success'=>$success]);

        }

    }


    public function update(Request $request){

        $data=$request->data;
        $success=false;

        try{
            $success=User::find($request->id)->update(json_decode($data,true));

        }catch(Exception $exception){
            return response()->json(['success'=>0],500);

        }finally{
            return response()->json(['success'=>$success]);

        }

    }

}
