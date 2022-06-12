<?php

namespace App\Http\Controllers\Backend;
use Auth;
use App\Models\Card;
use App\Models\User;
use App\Models\RatePlan;
use App\Models\ResellerCard;
use App\Models\ResellerPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResellerCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $reseller_card = new ResellerCard;
            $this->validate($request, [
                'reseller_id' => 'required',
                'rate_plan_id' => 'required'
            ]);

            if(!empty($request->paid_amount)){
                $reseller_payment = new ResellerPayment;
                $reseller_payment->reseller_id = $request->reseller_id;
                $reseller_payment->amount = $request->paid_amount;
                $reseller_payment->added_by_id = Auth::user()->id;
                $reseller_payment->payment_date = date('Y-m-d');
                $reseller_payment->save();
            }

            $reseller_card->qty = $request->qty;
            $reseller_card->reseller_id = $request->reseller_id;
            $reseller_card->rate_plan_id = $request->rate_plan_id;
            $reseller_card->added_by_id = Auth::user()->id;
            $reseller_card->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Reseller card successfully added`
                })
                </script>
                ');
            
        }
        return view('admin.reseller_card.add');
    }
    public function list(){
        $reseller_cards = ResellerCard::with('reseller','rate_plan','added_by')->paginate(10);
        return view('admin.reseller_card.list')->with(compact('reseller_cards'));
    }
    public function edit(Request $request, $id){
        $reseller_card = ResellerCard::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'reseller_id' => 'required',
                'rate_plan_id' => 'required'
            ]);                            
    
            $reseller_card->qty = $request->qty;
            $reseller_card->reseller_id = $request->reseller_id;
            $reseller_card->rate_plan_id = $request->rate_plan_id;
            $reseller_card->added_by_id = Auth::user()->id;
            $reseller_card->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Reseller card successfully updated`
                })
                </script>
                ');
            
        }
        return view('admin.reseller_card.edit')->with(compact('reseller_card'));
    }
    public function destroy($id){
        if (!empty($id)) {
            if (ResellerCard::find($id)->delete()) {
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Reseller card successfully deleted`
                })
                </script>
                ');
            }else{
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `error`,
                  title: `Reseller card delete error`
                })
                </script>
                ');
            }
        }
    }
    public function get_rate_plan_by_id(Request $request){
        if ($request->isMethod('post')) {
            return $rate_plan = RatePlan::find($request->id);
        }
        
    }
    public function avialable_card(Request $request){
        if ($request->isMethod('post')) {
            $card = Card::where('rate_plan_id',$request->rate_plan_id)->count();
            $card_sells = User::my_sell_card(Auth::user()->id,$request->rate_plan_id);
            return $card-$card_sells;
        }
    }
}
