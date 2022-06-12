<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Models\Dailler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaillerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $dailler = new Dailler;
            $this->validate($request, [
                'name' => 'required|string'
            ]);
                        
            if ($request->hasFile('img')) {
                // image
                $extension = strtolower($request->file('img')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $image = Image::make($request->img)->resize(57, 57);
                $image->save('frontend/assets/img/dailler/'.$file_name);
                $dailler->img = $file_name;
            }

            $dailler->name = $request->name;
            $dailler->note = $request->note;
            try {
                $dailler->save();
                return redirect()->back()->with('flash_success','
                    <script>
                    Toast.fire({
                      icon: `success`,
                      title: `Dailler successfully added`
                    })
                    </script>
                    ');
            } catch (Exception $e) {
                return $e;
            }
            
            
        }
        return view('admin.dailler.add');
    }
    public function list(){
        $daillers = Dailler::all();
        return view('admin.dailler.list')->with(compact('daillers'));
    }
    public function edit(Request $request, $id){
        $dailler = Dailler::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|string'
            ]);
                        
            if ($request->hasFile('img')) {
                // image
                $extension = strtolower($request->file('img')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $image = Image::make($request->img)->resize(57, 57);
                $image->save('frontend/assets/img/dailler/'.$file_name);
                $image_path = 'frontend/assets/img/dailler/'.$dailler->img;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $dailler->img = $file_name;
            }

            $dailler->name = $request->name;
            $dailler->note = $request->note;
            try {
                $dailler->save();
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Dailler successfully updated`
                })
                </script>
                ');
            } catch (Exception $e) {
                return $e;
            }
            
            
        }
        return view('admin.dailler.edit')->with(compact('dailler'));

    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = Dailler::FindOrFail($id);
            $img = 'frontend/assets/img/dailler/'.$data->img;
            if (file_exists($img)) {
                @unlink($img);
            }
            Dailler::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Dailler successfully deleted`
                })
                </script>
                ');
        }
    }
}
