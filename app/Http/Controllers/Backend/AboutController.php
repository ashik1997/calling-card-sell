<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Image;
use App\Models\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $info = About::firstOrFail();
            $this->validate($request, [
                'title' => 'required|string|min:5',
                'image' => 'mimes:jpg,bmp,png'
            ]);
                        
            if ($request->hasFile('image')) {
                // image
                $extension = strtolower($request->file('image')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image);
                $image->save('frontend/assets/img/'.$file_name);
                $info->image = $file_name;
            }

            $info->title = $request->title;
            $info->video = $request->video;
            $info->description = $request->description;
            $info->save();
            return redirect(route('about-info'))->with('flash_success','
                    <script>
                    Toast.fire({
                      icon: `success`,
                      title: `About successfully updated`
                    })
                    </script>
                    ');   
        }

        $about = About::firstOrFail();
        return view('admin.settings.about')->with(compact('about'));
    }
}
