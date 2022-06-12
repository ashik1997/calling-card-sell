<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Models\SiteInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    	if ($request->isMethod('post')) {
            $info = SiteInfo::firstOrFail();
            $this->validate($request, [
                'site_name' => 'required|string|min:2|max:50'
            ]);
                    	
    		if ($request->hasFile('header_logo')) {
    			// image
	        	$extension = strtolower($request->file('header_logo')->getClientOriginalExtension());;
	        	$file_name = time().'_header_logo.'.$extension;
	        	$image = Image::make($request->header_logo)->resize(120, 50);
	        	$image->save('frontend/assets/img/'.$file_name);
    			$image_path = 'frontend/assets/img/'.$info->header_logo;
	            if (file_exists($image_path)) {
	        		@unlink($image_path);
	        	}
	        	$info->header_logo = $file_name;
    		}
    		if ($request->hasFile('footer_logo')) {
    			// image
	        	$extension = strtolower($request->file('footer_logo')->getClientOriginalExtension());;
	        	$file_name = time().'_footer_logo.'.$extension;
	        	$image = Image::make($request->footer_logo)->resize(120, 50);
	        	$image->save('frontend/assets/img/'.$file_name);
    			$image_path = 'frontend/assets/img/'.$info->footer_logo;
	            if (file_exists($image_path)) {
	        		@unlink($image_path);
	        	}
	        	$info->footer_logo = $file_name;
    		}
    		if ($request->hasFile('favicon')) {
    			// image
	        	$extension = strtolower($request->file('favicon')->getClientOriginalExtension());;
	        	$file_name = time().'_favicon.'.$extension;
	        	$image = Image::make($request->favicon)->resize(16, 16);
	        	$image->save('frontend/assets/img/'.$file_name);
    			$image_path = 'frontend/assets/img/'.$info->favicon;
	            if (file_exists($image_path)) {
	        		@unlink($image_path);
	        	}
	        	$info->favicon = $file_name;
    		}
    		if ($request->hasFile('ad_banner')) {
    			// image
	        	$extension = strtolower($request->file('ad_banner')->getClientOriginalExtension());;
	        	$file_name = time().'_ad_banner.'.$extension;
	        	$image = Image::make($request->ad_banner)->resize(500, 250);
	        	$image->save('frontend/assets/img/'.$file_name);
    			$image_path = 'frontend/assets/img/'.$info->ad_banner;
	            if (file_exists($image_path)) {
	        		@unlink($image_path);
	        	}
	        	$info->ad_banner = $file_name;
    		}
            $info->site_name = $request->site_name;
            $info->map_embed = $request->map_embed;
            $info->phone = $request->phone;
            $info->email = $request->email;
            $info->address = $request->address;
            
            $info->terms_conditions = $request->terms_conditions;
            $info->privacy_policy = $request->privacy_policy;
            $info->short_about = $request->short_about;
            $info->user_id = Auth::user()->id;
            $info->save();
	        return redirect(route('site-info'))->with('flash_success','
	            	<script>
					Toast.fire({
					  icon: `success`,
					  title: `Site information successfully updated`
					})
					</script>
					');   
        }
    	$site_info = SiteInfo::firstOrFail();


    	return view('admin.settings.site_info')->with(compact('site_info'));
    }
}
