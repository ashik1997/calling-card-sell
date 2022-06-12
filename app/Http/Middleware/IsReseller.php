<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class IsReseller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->role == 'reseller') {
            if (Auth::user()->status==1) {
                return $next($request);
            }else{
                return redirect(route('home'))->with('flash_success','
                    <script>
                    Toast.fire({
                      icon: `error`,
                      title: `Your is block. Please contact with support team.`
                    })
                    </script>
                    ');
            }
            
        }
        return redirect('login')->with('error','You have not admin access');
    }
}
