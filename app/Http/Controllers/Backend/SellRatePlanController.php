<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Image;
use App\Models\SellRatePlan;
use App\Models\VoipRate;
use App\Models\SellVoipRate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellRatePlanController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $sell_rate_plan = new SellRatePlan;
            $this->validate($request, [
                'currency' => 'required|string'
            ]);
            
            $sell_rate_plan->currency = $request->currency;
            $sell_rate_plan->amount = $request->amount;
            $sell_rate_plan->discount = $request->discount;
            $sell_rate_plan->currency_rate = $request->currency_rate;
            $sell_rate_plan->title = $request->title;
            $sell_rate_plan->description = $request->description;
            $sell_rate_plan->discount = $request->discount;
            $sell_rate_plan->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Sell rate plan successfully added`
                })
                </script>
                ');
            
        }
        return view('admin.sell_rate_plan.add');
    }
    public function list(){
        $sell_rate_plans = SellRatePlan::all();
        return view('admin.sell_rate_plan.list')->with(compact('sell_rate_plans'));
    }
    public function edit(Request $request, $id){
        $sell_rate_plan = SellRatePlan::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'currency' => 'required|string'
            ]);
            $sell_rate_plan->currency = $request->currency;
            $sell_rate_plan->amount = $request->amount;
            $sell_rate_plan->discount = $request->discount;
            $sell_rate_plan->currency_rate = $request->currency_rate;
            $sell_rate_plan->title = $request->title;
            $sell_rate_plan->description = $request->description;
            $sell_rate_plan->how_many_minutes_of_seconds = $request->how_many_minutes_of_seconds;
            $sell_rate_plan->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Sell rate plan successfully updated`
                })
                </script>
                ');
            
        }
        return view('admin.sell_rate_plan.edit')->with(compact('sell_rate_plan'));
    }
    public function destroy($id){
        if (!empty($id)) {
            $data = SellRatePlan::FindOrFail($id);
            SellRatePlan::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Sell rate plan successfully deleted`
                })
                </script>
                ');
        }
    }
    public function update_status(Request $request){
        $reseller = SellRatePlan::find($request->sell_rate_plan_id);
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
    public function sell_voip_rate_add($id){
        if (!empty($id)) {
            $voip_rates = VoipRate::get();
            $sell_voip_rates = SellVoipRate::where('sell_rate_plan_id', $id)->get();
            if (count($sell_voip_rates)==0) {
                foreach ($voip_rates as $key => $voip_rate) {
                    $sell_voip_rate = new SellVoipRate;
                    $sell_voip_rate->sell_rate_plan_id = $id;
                    $sell_voip_rate->country = $voip_rate->country;
                    $sell_voip_rate->code = $voip_rate->code;
                    $sell_voip_rate->rate = $voip_rate->rate;
                    $sell_voip_rate->minute = $voip_rate->minute;
                    $sell_voip_rate->save();
                }
            }else{
                $sell_voip_rates = SellVoipRate::where('sell_rate_plan_id', $id)->get();
            }
            return view('admin.sell_rate_plan.sell_voip_rate_list')->with(compact('sell_voip_rates'));
        }
    }
    public function sell_voip_rate_update(Request $request){
        $data = SellVoipRate::find($request->id);
        if ($request->isMethod('post')) {
            $data->rate = $request->value;
            $data->save();
            return 1;
        }else{
            return 0;
        }
    }
}
