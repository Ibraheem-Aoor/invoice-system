<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class ActiveAccount
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
        // if(auth()->user()->status == 0)
            // return redirect(url('login'))->with(['AccountDisabled'=>'تم تعطيل حسابك بواسطة المشرف']);
        return $next($request);
    }
}
