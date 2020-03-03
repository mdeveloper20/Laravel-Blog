<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use DateTime;
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
        $now=new DateTime('NOW');

        $user=User::where([['token',$token],['token_expire','>=',$now]])->first();
        if(!$user){
            return response()->json([],401);
        }
        $request->attributes->add(['user'=>$user]);
        return $next($request);
    }
}
