<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $service = new Service;
            $this->validate($request, [
                'service_name' => 'required|string'
            ]);
                        
            if ($request->hasFile('img')) {
                // image
                $extension = strtolower($request->file('img')->getClientOriginalExtension());
                $file_name = time().'_service.'.$extension;
                $image = Image::make($request->img)->resize(100, 100);
                $image->save('frontend/assets/img/service/'.$file_name);
                $service->img = $file_name;
            }

            $service->service_name = $request->service_name;
            $service->description = $request->description;
            $service->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Service successfully added`
                })
                </script>
                ');
            
        }
        return view('admin.service.add');
    }
    public function list(){
        $services = Service::all();
        return view('admin.service.list')->with(compact('services'));
    }
    public function edit(Request $request, $id){
        $service = Service::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'service_name' => 'required|string'
            ]);
                        
            if ($request->hasFile('img')) {
                // image
                $extension = strtolower($request->file('img')->getClientOriginalExtension());
                $file_name = time().'_service.'.$extension;
                $image = Image::make($request->img)->resize(100, 100);
                $image->save('frontend/assets/img/service/'.$file_name);
                $image_path = 'frontend/assets/img/service/'.$service->img;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $service->img = $file_name;
            }

            $service->service_name = $request->service_name;
            $service->description = $request->description;
            $service->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Service successfully updated`
                })
                </script>
                ');
            
        }
        return view('admin.service.edit')->with(compact('service'));
    }
    public function destroy($id) {
        if (!empty($id)) {
            $data = Service::FindOrFail($id);
            $img = 'frontend/assets/img/service/'.$data->img;
            if (file_exists($img)) {
                @unlink($img);
            }
            Service::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Service successfully deleted`
                })
                </script>
                ');
        }
    }
}