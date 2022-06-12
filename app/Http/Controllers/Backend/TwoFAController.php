<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Session;
use App\Models\User;
use PragmaRX\Google2FAQRCode\Google2FA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFAController extends Controller
{
    public function veryfication(Request $request){
        $google2fa = new Google2FA();
        $companyName = 'Piyofon';
        $companyEmail = 'info@piyofon.com';
        // $secretKey = $google2fa->generateSecretKey();
        $secretKey = Session::get('sckey');
        // $secret = Session::get('sckey_input');
        // return $valid = $google2fa->verifyKey($secretKey, $secret);
        $inlineUrl = $google2fa->getQRCodeInline(
            $companyName,
            $companyEmail,
            $secretKey
        );
        if ($request->isMethod('post')) {
            $secret = $request->input('secret');
            Session::put('sckey_input', $secret);
            
            $valid = $google2fa->verifyKey($secretKey, $secret);
            if($valid){
                $user = User::where('id',Auth::user()->id)->first();
                $user->google2fa_secret = $secretKey;
                $user->save();
                $secretKey = Session::get('sckey');
                $secret = Session::get('sckey_input');
                // return $valid = $google2fa->verifyKey($secretKey, $secret);
                return redirect()->route('dashboard');
            }
        }
        // if (Session::get('sckey')==Session::get('sckey_input')) {
        //     return redirect('admin');
        // }
        return view('auth.2fa')->with(compact('inlineUrl','secretKey'));
    }
}
