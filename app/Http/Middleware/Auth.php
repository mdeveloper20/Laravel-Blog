<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token=$request->token;
        $user=User::where('token',$token)->first();
        if(!$user){
            return response()->json([],401);
        }
        $request->attributes->add(['user'=>$user]);
        return $next($request);
    }
}
