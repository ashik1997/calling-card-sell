<?php

namespace App\Http\Controllers\Frontend;

use App\Models\SiteInfo;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        if ($request->isMethod('post')) {
            $contact = new Contact;
            $this->validate($request, [
                'email' => 'required|email:rfc,dns',
            ]);

            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Your message has been sent. Thanks for staying with us!`
                })
                </script>
                ');
        }
        return view('public.home');
    }
    public function terms_conditions(){
        $terms_conditions = SiteInfo::pluck('terms_conditions')[0];
        return view('public.terms-conditions')->with(compact('terms_conditions'));
    }
    public function privacy_policy(){
        $privacy_policy = SiteInfo::pluck('privacy_policy')[0];
        return view('public.privacy-policy')->with(compact('privacy_policy'));
    }
    public function contact_us(){
        return view('public.contact-us');
    }
    public function about_us(){
        return view('public.about-us');
    }
    public function faq(){
        return view('public.faq');
    }
    public function rate_page(){
        return view('public.rate-page');
    }
    public function rates(){
        return view('public.rates');
    }
    public function download(){
        return view('public.download');
    }
}
