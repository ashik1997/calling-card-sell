<?php

namespace App\Http\Controllers\Backend\Reseller;

use DB;
use Auth;
use Image;
use App\Models\User;
use App\Models\Card;
use App\Models\SellCard;
use App\Models\RatePlan;
use App\Models\SellRatePlan;
use App\Models\Batch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function pass_check(Request $request){
        if(Hash::check($request->password, Auth::user()->password)){
            return 1;
        }else{
            return 0;
        }
    }
    public function sell_rate_plan(){
        $sell_rate_plans = SellRatePlan::where('status',1)->get();
        return view('reseller.card.sell_rate_plan')->with(compact('sell_rate_plans'));
    }
    public function stock_list(){
        $rate_plans = RatePlan::where('status',1)->get();
        return view('reseller.card.stock_list')->with(compact('rate_plans'));
    }
    public function new_card_sell(Request $request,$rate_plan_id){
        $card = Card::leftJoin('sell_cards', function($join) {
          $join->on('cards.id', '=', 'sell_cards.card_id');
        })
        ->whereNull('sell_cards.card_id')
        ->where('cards.rate_plan_id',$rate_plan_id)
        ->where('cards.sell_rate_plan_id',$request->sell_rate_plan_id)
        ->join('rate_plans', 'rate_plans.id', '=', 'cards.rate_plan_id')
        ->select('cards.*','rate_plans.amount','rate_plans.currency','rate_plans.image','rate_plans.image2','sell_cards.status')
        ->first();
        if (isset($card)) {
            $my_balance = User::reseller_balance(Auth::user()->id);
            if ($my_balance<=0) {
                return redirect(route('reseller.card.sell_rate_plan'))->with('flash_success','
                    <script>
                    Toast.fire({
                      icon: `error`,
                      title: `You do not have enough money in your account.`
                    })
                    </script>
                    ');
            }
            return view('reseller.card.sell.new')->with(compact('card'));
        }else{
            return redirect(route('reseller.card.sell_rate_plan'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `error`,
                  title: `Card not available`
                })
                </script>
                ');
        }        
    }
    public function card_by_id($id){
        $sell_rate_plan = SellRatePlan::findOrFail($_GET['sell_rate_plan_id']);
        $card = Card::leftJoin('sell_cards', function($join) {
          $join->on('cards.id', '=', 'sell_cards.card_id');
        })
        ->whereNull('sell_cards.card_id')
        ->where('cards.id', $id)
        ->join('rate_plans', 'rate_plans.id', '=', 'cards.rate_plan_id')
        ->select('cards.*','rate_plans.amount','rate_plans.currency','rate_plans.image','rate_plans.image2','sell_cards.status')
        ->first();
        // return $card;
        
        if (isset($card)) {
            $my_balance = User::reseller_balance(Auth::user()->id);
            if ($my_balance<=($sell_rate_plan->amount/10)*$card->amount) {
                return redirect(route('reseller.card.sell_rate_plan'))->with('flash_success','
                    <script>
                    Toast.fire({
                      icon: `error`,
                      title: `You do not have enough money in your account.`
                    })
                    </script>
                    ');
            }
            $sell_card = new SellCard;
            $sell_card->card_id = $id;
            $sell_card->status = 1;
            $discount = $card->amount*$sell_rate_plan->discount;
            $discount += $card->amount*Auth::user()->discount;
            $sell_price = (($sell_rate_plan->amount/10)*$card->amount)-$discount;
            $sell_card->sell_price = $sell_price;
            $sell_card->reseller_id = Auth::user()->id;
            $sell_card->save();
            return view('reseller.card.sell.card')->with(compact('card'))->with('successMsg','Card successfully sold out.');
        }elseif(SellCard::where('card_id',$id)->count()>0){
            return redirect(route('reseller.card.sell_rate_plan'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `error`,
                  title: `Alrady sell this card`
                })
                </script>
                ');  
        }
    }
    public function card_sell_list(){
        $card_sells = SellCard::where('reseller_id',Auth::user()->id)->with('card','user')->paginate(10);
        return view('reseller.card.sell.list')->with(compact('card_sells'));
    }
}
