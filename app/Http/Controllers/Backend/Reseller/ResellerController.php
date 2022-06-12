<?php

namespace App\Http\Controllers\Backend\Reseller;
use Auth;
use Image;
use App\Models\User;
use App\Models\RatePlan;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function update_status(Request $request){
        $reseller = User::find($request->user_id);
        if ($request->isMethod('post')) {
            if($reseller->status==1){
                $reseller->status = 0;
            }elseif($reseller->status==0){
                $reseller->status = 1;
            }
            $reseller->save();
            return $reseller->status;
        }
    }
    public function add(Request $request){
        $reseller = new User;
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'password' => 'required|string|min:8|confirmed',
                'email' => 'required|email|unique:users'
            ]);
            if ($request->discount>Auth::user()->discount) {
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `warning`,
                  title: `Reseller discount maximum '.Auth::user()->discount.'`
                })
                </script>
                ');
            }
            if ($request->hasFile('img')) {
                $extension = strtolower($request->file('img')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $img = Image::make($request->img)->resize(225, 225);
                $img->save('backend/dist/img/'.$file_name);
                $reseller->img = $file_name;
            }
            $reseller->name = $request->name;
            $reseller->email = $request->email;
            if ($request->discount < Auth::user()->discount) {
                $reseller->discount = $request->discount;
            }
            $reseller->phone = $request->phone;
            $reseller->address = $request->address;
            $reseller->role = 'reseller';
            $reseller->password = Hash::make($request['password']);
            $reseller->added_by_id = Auth::user()->id;
            if ($reseller->save()) {
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Reseller successfully added`
                })
                </script>
                ');
            }else{
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `error`,
                  title: `Some error here`
                })
                </script>
                ');
            }
        }
        return view('reseller.reseller.new');
    }
    public function list(){
        $resellers = User::where('role', 'reseller')->where('added_by_id', Auth::user()->id)->get();
        return view('reseller.reseller.list')->with(compact('resellers'));
    }
    public function edit(Request $request, $id){
        $reseller = User::where('id',$id)->where('added_by_id', Auth::user()->id)->first();
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email|unique:users'
            ]);
            if ($request->discount>Auth::user()->discount) {
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `warning`,
                  title: `Reseller discount maximum '.Auth::user()->discount.'`
                })
                </script>
                ');
            }
            if ($request->hasFile('img')) {
                $extension = strtolower($request->file('img')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $img = Image::make($request->img)->resize(225, 225);
                $img->save('backend/dist/img/'.$file_name);
                $image_path = 'backend/dist/img/'.$reseller->img;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $reseller->img = $file_name;
            }
            if (!empty($request->password)) {
                $this->validate($request, [
                    'password' => 'required|string|min:8|confirmed'
                ]);
                $reseller->password = Hash::make($request['password']);
            }
            $reseller->name = $request->name;
            $reseller->email = $request->email;
            $reseller->phone = $request->phone;
            if ($request->discount < Auth::user()->discount) {
                $reseller->discount = $request->discount;
            }
            $reseller->address = $request->address;
            $reseller->role = 'reseller';
            // $reseller->added_by_id = Auth::user()->id;
            $reseller->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Reseller successfully updated`
                })
                </script>
                ');
        }
        return view('reseller.reseller.edit')->with(compact('reseller'));
    }
    public function destroy($id){
        if (!empty($id)) {
            $data = User::FindOrFail($id);
            $img = 'backend/dist/img/'.$data->img;
            if (file_exists($img)) {
                @unlink($img);
            }
            $user = User::where('id',$id)->where('added_by_id',Auth::user()->id)->first();
            if ($user->delete()) {
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Reseller successfully deleted`
                })
                </script>
                ');
            }
            
        }
    }
    public function reseller_report(Request $request, $id){
        $reseller = User::where('id',$id)->where('added_by_id',Auth::user()->id)->first();
        $rate_plans = RatePlan::get();
        return view('reseller.reseller.report')->with(compact('reseller','rate_plans'));
    }
}
