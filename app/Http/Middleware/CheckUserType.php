<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$blocked): Response
    {
        $user = $request->user();
        $types = ['super_administrator','store_manager'];
        if(!$user){
            return redirect()->route('login');
        }
        if(($user && !in_array($user->user_type,$types)) || in_array($user->user_type,$blocked)){
                abort(403);
        }

        return $next($request);
    }
}
