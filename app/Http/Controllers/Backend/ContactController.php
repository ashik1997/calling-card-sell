<?php

namespace App\Http\Controllers\Backend;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function list(){
    	$contacts = Contact::get();
    	return view('admin.contact.list')->with(compact('contacts'));
    }
	public function destroy($id)
	    {
	        if (!empty($id)) {
	            Contact::find($id)->delete();
	            return redirect(route('contact-list'))->with('flash_success','
	            	<script>
					Toast.fire({
					  icon: `success`,
					  title: `Contact successfully deleted`
					})
					</script>
					');
	        }
	    }
}
