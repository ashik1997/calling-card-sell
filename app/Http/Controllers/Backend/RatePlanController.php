<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Image;
use App\Models\RatePlan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $rate_plan = new RatePlan;
            $this->validate($request, [
                'currency' => 'required|string'
            ]);
            if ($request->hasFile('image')) {
                // image
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'1.'.$extension;
                $image = Image::make($request->image);
                $image->save('frontend/assets/img/rate_plan/'.$file_name);
                $rate_plan->image = $file_name;
            }
            if ($request->hasFile('image2')) {
                // image
                $extension = strtolower($request->file('image2')->getClientOriginalExtension());
                $file_name = time().'2.'.$extension;
                $image2 = Image::make($request->image2);
                $image2->save('frontend/assets/img/rate_plan/'.$file_name);
                $rate_plan->image2 = $file_name;
            }
            $rate_plan->currency = $request->currency;
            $rate_plan->amount = $request->amount;
            $rate_plan->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Rate plan successfully added`
                })
                </script>
                ');
            
        }
        return view('admin.rate_plan.add');
    }
    public function list(){
        $rate_plans = RatePlan::all();
        return view('admin.rate_plan.list')->with(compact('rate_plans'));
    }
    public function edit(Request $request, $id){
        $rate_plan = RatePlan::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'currency' => 'required|string'
            ]);
    
            if ($request->hasFile('image')) {
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'1.'.$extension;
                $image = Image::make($request->image);
                $image->save('frontend/assets/img/rate_plan/'.$file_name);
                $image_path = 'frontend/assets/img/rate_plan/'.$rate_plan->image;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $rate_plan->image = $file_name;
            }
            if ($request->hasFile('image2')) {
                $extension = strtolower($request->file('image2')->getClientOriginalExtension());
                $file_name = time().'2.'.$extension;
                $image2 = Image::make($request->image2);
                $image2->save('frontend/assets/img/rate_plan/'.$file_name);
                $image_path = 'frontend/assets/img/rate_plan/'.$rate_plan->image2;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $rate_plan->image2 = $file_name;
            }
            $rate_plan->currency = $request->currency;
            $rate_plan->amount = $request->amount;
            $rate_plan->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Rate plan successfully updated`
                })
                </script>
                ');
            
        }
        return view('admin.rate_plan.edit')->with(compact('rate_plan'));
    }
    public function destroy($id){
        if (!empty($id)) {
            $data = RatePlan::FindOrFail($id);
            RatePlan::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Rate plan successfully deleted`
                })
                </script>
                ');
        }
    }
    public function update_status(Request $request){
        $reseller = RatePlan::find($request->rate_plan_id);
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
}
