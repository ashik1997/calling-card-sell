<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Models\DemoDailler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoDaillerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $demo_dailler = new DemoDailler;

            if ($request->hasFile('banner')) {
                // banner
                $extension = strtolower($request->file('banner')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $banner = Image::make($request->banner)->resize(250, 250);
                $banner->save('frontend/assets/img/demo_dailler/'.$file_name);
                $demo_dailler->banner = $file_name;
            }

            $demo_dailler->title = $request->title;
            $demo_dailler->opcode = $request->opcode;
            $demo_dailler->link = $request->link;
            $demo_dailler->dailler_id = $request->dailler_id;
            $demo_dailler->description = $request->description;
            $demo_dailler->user_id = Auth::user()->id;
            $demo_dailler->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Demo dailler successfully added`
                })
                </script>
                ');
        }
        return view('admin.demo_dailler.new');
    }
    public function list(){
        $demo_dailler = DemoDailler::all();
        return view('admin.demo_dailler.list')->with(compact('demo_dailler'));
    }
    public function edit(Request $request, $id){
        $demo_dailler = DemoDailler::find($id);
        if ($request->isMethod('post')) {                       
            if ($request->hasFile('banner')) {
                // banner
                $extension = strtolower($request->file('banner')->getClientOriginalExtension());;
                $file_name = time().'1.'.$extension;
                $banner = Image::make($request->banner)->resize(250, 250);
                $banner->save('frontend/assets/img/demo_dailler/'.$file_name);
                $image_path = 'frontend/assets/img/demo_dailler/'.$demo_dailler->banner;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $demo_dailler->banner = $file_name;
            }

            $demo_dailler->title = $request->title;
            $demo_dailler->opcode = $request->opcode;
            $demo_dailler->link = $request->link;
            $demo_dailler->dailler_id = $request->dailler_id;
            $demo_dailler->description = $request->description;
            $demo_dailler->user_id = Auth::user()->id;
            $demo_dailler->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Demo dailler successfully updated`
                })
                </script>
                ');
        }
        return view('admin.demo_dailler.edit')->with(compact('demo_dailler'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = DemoDailler::FindOrFail($id);
            $banner = 'frontend/assets/img/demo_dailler/'.$data->banner;
            if (file_exists($banner)) {
                @unlink($banner);
            }
            DemoDailler::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Demo dailler successfully deleted`
                })
                </script>
                ');
        }
    }
}
