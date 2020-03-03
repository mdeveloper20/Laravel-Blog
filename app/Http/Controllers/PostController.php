<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

/*
Role:
    0=>normal user
    1=>manager
    2=>admin
*/


class PostController extends Controller
{
    //

    public function create(Request $request){
        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->tag=$request->tag;
        $user=$request->get('user');
        $post->user_id=$user->id;


        try{
            $post->save();
            return response()->json(['success'=>1]);

        }catch(Exception $e){
            return response()->json(['success'=>0],500);

        }
    }

    public function get(Request $request){

        $user=$request->get('user');

        if($user->role>0){
            //manager and admin: fetch all posts
            $post=Post::where(['id'=>$request->id])->first();
        }else{
            $post=Post::where(['id'=>$request->id,'user_id'=>$user->id])->first();
        }

        if($post){
            return response()->json($post);

        }else{
            return response()->json([],404);

        }

    }

    public function getAll(Request $request){

        $user=$request->get('user');

        if($user->role>0){
            //manager and admin: fetch all posts
            $posts=Post::get();
        }else{
            $posts=Post::where('user_id',$user->id)->get();
        }

        if($posts){
            return response()->json($posts);
        }else{
            return response()->json([],404);
        }

    }

    public function delete(Request $request){

        $user=$request->get('user');
        $success=false;

        try{
            if($user->role>0){
                //manager and admin can remove all posts
                $success=Post::find($request->id)->delete();
            }else{
                //normal user only can remove his own posts
                $success=Post::where(['user_id'=>$user->id,'id'=>$request->id])->delete();
            }
        }catch(Exception $exception){
            return response()->json(['success'=>0],500);

        }finally{
            return response()->json(['success'=>$success]);

        }

    }


    public function update(Request $request){

        $user=$request->get('user');
        $data=$request->data;
        $success=false;

        try{
            if($user->role>0){

                //manager and admin can update all posts
                $success=Post::find($request->id)->update(json_decode($data,true));

            }else{
                //normal user only can remove his own posts
                $success=Post::where(['user_id'=>$user->id,'id'=>$request->id])->update(json_decode($data,true));
            }
        }catch(Exception $exception){
            return response()->json(['success'=>0],500);

        }finally{
            return response()->json(['success'=>$success]);

        }

    }
}
