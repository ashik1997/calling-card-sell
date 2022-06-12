<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Image;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $country = new Country;
            $this->validate($request, [
                'name' => 'required|string'
            ]);
                        
            if ($request->hasFile('flag')) {
                // image
                $extension = strtolower($request->file('flag')->getClientOriginalExtension());
                $file_name = 'flag_'.time().$extension;
                $image = Image::make($request->flag)->resize(120, 80);
                $image->save('frontend/assets/img/country/'.$file_name);
                $country->flag = $file_name;
            }

            $country->name = $request->name;
            $country->mark = $request->mark;
            $country->note = $request->note;
            $country->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Country successfully added`
                })
                </script>
                ');
            
        }
        return view('admin.country.add');
    }
    public function list(){
        $countrys = Country::all();
        return view('admin.country.list')->with(compact('countrys'));
    }
    public function edit(Request $request, $id){
        $country = Country::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|string'
            ]);
                        
            if ($request->hasFile('flag')) {
                // image
                $extension = strtolower($request->file('flag')->getClientOriginalExtension());
                $file_name = 'flag_'.time().$extension;
                $image = Image::make($request->flag)->resize(120, 80);
                $image->save('frontend/assets/img/country/'.$file_name);
                $image_path = 'frontend/assets/img/country/'.$country->flag;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $country->flag = $file_name;
            }

            $country->name = $request->name;
            $country->mark = $request->mark;
            $country->note = $request->note;
            $country->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Country successfully updated`
                })
                </script>
                ');
        }
        return view('admin.country.edit')->with(compact('country'));
    }
    public function destroy($id) {
        if (!empty($id)) {
            $data = Country::FindOrFail($id);
            $img = 'frontend/assets/img/country/'.$data->flag;
            if (file_exists($img)) {
                @unlink($img);
            }
            Country::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Country successfully deleted`
                })
                </script>
                ');
        }
    }
}
