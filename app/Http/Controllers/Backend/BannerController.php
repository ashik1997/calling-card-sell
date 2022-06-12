<?php

namespace App\Http\Controllers\Backend;

use Image;
use Auth;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $banner = new Banner;
            $banner->title = $request->title;
            $banner->cta_url = $request->cta_url;
            $banner->cta_text = $request->cta_text;
            if ($request->hasFile('image')) {
                // image
                $extension = strtolower($request->file('image')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(1024, 400);
                $image->save('frontend/assets/img/banner/'.$file_name);
                $banner->banner = $file_name;
            }
            $banner->description = $request->description;
            $banner->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Banner successfully added`
                })
                </script>
                ');
        }
        return view('admin.banner.new');
    }
    public function list(){
        $banners = Banner::all();
        return view('admin.banner.list')->with(compact('banners'));
    }
    public function edit(Request $request, $id){
        $banner = Banner::find($id);
        if ($request->isMethod('post')) {
            $banner->title = $request->title;
            $banner->cta_url = $request->cta_url;
            $banner->cta_text = $request->cta_text;
            if ($request->hasFile('image')) {
                // image
                $extension = strtolower($request->file('image')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(1024, 400);
                $image->save('frontend/assets/img/banner/'.$file_name);
                $image_path = 'frontend/assets/img/banner/'.$banner->banner;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $banner->banner = $file_name;
            }
            $banner->description = $request->description;
            $banner->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Banner successfully updated`
                })
                </script>
                ');
        }
        return view('admin.banner.edit')->with(compact('banner'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = Banner::FindOrFail($id);
            Banner::find($id)->delete();
            if (file_exists('frontend/assets/img/banner/'.$data->banner)) {
                @unlink('frontend/assets/img/banner/'.$data->banner);
            }
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Banner successfully deleted`
                })
                </script>
                ');
        }
    }
}
