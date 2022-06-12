<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Models\User;
use App\Models\RatePlan;
use App\Models\ResellerBalance;
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
            $reseller_count = User::where('email',$request->email)->count();
            if ($request->hasFile('img')) {
                $extension = strtolower($request->file('img')->getClientOriginalExtension());;
                $file_name = time().'.'.$extension;
                $img = Image::make($request->img)->resize(225, 225);
                $img->save('backend/dist/img/'.$file_name);
                $reseller->img = $file_name;
            }
            $reseller->name = $request->name;
            $reseller->email = $request->email;
            $reseller->phone = $request->phone;
            $reseller->discount = $request->discount;
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
        return view('admin.reseller.new');
    }
    public function list(){
        $resellers = User::where('role', 'reseller')->paginate(10);
        return view('admin.reseller.list')->with(compact('resellers'));
    }
    public function all_list(){
        $resellers = User::where('role', 'reseller')->paginate(10);
        return view('admin.reseller.all_list')->with(compact('resellers'));
    }
    public function admin_list(){
        $admins = User::where('role', 'admin')->get();
        return view('admin.list')->with(compact('admins'));
    }
    public function edit(Request $request, $id){
        $reseller = User::FindOrFail($id);
        if ($request->isMethod('post')) {
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
            $reseller->discount = $request->discount;
            $reseller->address = $request->address;
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
        return view('admin.reseller.edit')->with(compact('reseller'));
    }
    
    public function destroy($id){
        if (!empty($id)) {
            $data = User::FindOrFail($id);
            $img = 'backend/dist/img/'.$data->img;
            if (file_exists($img)) {
                @unlink($img);
            }
            if (User::where('id',$id)->delete() || User::where('added_by_id',$id)->delete()) {
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
        $reseller = User::where('id',$id)->first();
        $rate_plans = RatePlan::get();
        return view('admin.reseller.report')->with(compact('reseller','rate_plans'));
    }
}
