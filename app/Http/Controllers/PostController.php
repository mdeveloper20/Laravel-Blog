<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
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
}
