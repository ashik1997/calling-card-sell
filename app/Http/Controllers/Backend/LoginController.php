<?php

namespace App\Http\Controllers\Backend;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

class LoginController extends Controller
{
    public function customLogin(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            // $credentials = $request->only('email', 'password');
            $credentials = ['email'=>$request['email'],'password'=>$request['password'],'status'=>1];
            if (Auth::attempt($credentials)) {
                if (Auth::user()->role=='admin') {
                    $user = User::findOrFail(Auth::user()->id);
                    $google2fa = new Google2FA();
                    if($user->google2fa_secret != ''){
                        $secretKey = $user->google2fa_secret;
                        Session::put('sckey', $secretKey);
                        return redirect(route('2fa'));
                    }else{
                        $secretKey = $google2fa->generateSecretKey();
                        $user->google2fa_secret = '';
                        $user->save();
                        Session::put('sckey',$secretKey);
                        return redirect(route('2fa'));
                    }
                }elseif(Auth::user()->role=='reseller'){
                    return redirect()->route('reseller.dashboard');
                }
                
            }else{
                $message = "Wrong user email or password";
                return redirect(route('login'))->with(compact('message'));
            }
        }
  
        return view('auth.login');
    }    
    
}
