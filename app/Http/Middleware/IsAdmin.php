<?php

namespace App\Http\Middleware;

use Auth;
use Session;
use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role == 'admin') {
            if (Auth::user()->google2fa_secret=='') {
                return redirect(route('2fa'));
            }else{
                $google2fa = new Google2FA();
                $secretKey = Auth::user()->google2fa_secret;
                $secret = Session::get('sckey_input');
                $valid = $google2fa->verifyKey($secretKey, $secret);
                if($valid){
                    return $next($request);
                }else{
                    return $next($request);
                }
            }
        }
        return redirect('/login');
    }
}
