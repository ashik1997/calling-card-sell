<?php

namespace App\Http\Controllers\Backend;

use DB;
use Auth;
use Image;
use App\Models\Card;
use App\Models\User;
use App\Models\SellCard;
use App\Models\RatePlan;
use App\Models\SellRatePlan;
use App\Models\Batch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $withOutExtension = pathinfo($request->file('csv_file')->getClientOriginalName(), PATHINFO_FILENAME);
            $batchNameArray = explode('_',$withOutExtension);
            
            $batch = new Batch;
            $batch->name = $batchNameArray[0];
            $batch->save();
            
            $file = $request->file('csv_file');
            if (($handle = fopen($file, "r")) !== FALSE) {
                $sl = 0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if ($sl > 15) {
                        if (Card::where('user', $data[0])->where('pin', $data[1])->count()==0) {
                            $card = new Card;
                            $card->batch_id = $batch->id;
                            $card->sell_rate_plan_id = $request->sell_rate_plan_id;
                            $card->rate_plan_id = $request->rate_plan_id;
                            $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
                            $replacement=array('');// you can enter more replacements.

                            $sl_no = str_replace($symbols,$replacement,$data[0]);
                            $card->sl_no = $sl_no;
                            $user = str_replace($symbols,$replacement,$data[1]);
                            $card->user = $user;
                            $pin = str_replace($symbols,$replacement,$data[2]);
                            $card->pin = $pin;
                            $card->user_id = Auth::user()->id;
                            $card->save();
                        }
                    }
                    $sl++;
                }
                fclose($handle);
            }

            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Card successfully added`
                })
                </script>
                ');
            
        }
        return view('admin.card.add');
    }
    public function list(){
        $cards = Card::with('rate_plan','batch')->orderBy('id', 'desc')->paginate(10);
        return view('admin.card.list')->with(compact('cards'));
    }
    public function batch_list(){
        $batchs = Batch::orderBy('id', 'desc')->get();
        return view('admin.card.batch_list')->with(compact('batchs'));
    }
    public function destroy($id){
        if (!empty($id)) {
            if (Card::find($id)->delete()) {
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Card successfully deleted`
                })
                </script>
                ');
            }
        }
    }
    public function batch_destroy($id){
        if (!empty($id)) {
            if (Batch::find($id)->delete()) {
                Card::where('batch_id',$id)->delete();
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Batch successfully deleted`
                })
                </script>
                ');
            }
            
        }
    }
    public function sell_rate_plan(){
        $sell_rate_plans = SellRatePlan::where('status', 1)->get();
        return view('admin.card.sell_rate_plan')->with(compact('sell_rate_plans'));
    }
    public function stock_list(){
        $rate_plans = RatePlan::where('status', 1)->get();
        return view('admin.card.stock_list')->with(compact('rate_plans'));
    }
    public function new_card_sell(Request $request, $rate_plan_id){
        $total_card = Card::where('rate_plan_id',$rate_plan_id)->count();
        $total_sell = User::my_sell_card(Auth::user()->id, $rate_plan_id);
        $my_stock = $total_card-$total_sell;
        if ($my_stock<=0) {
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `error`,
                  title: `Card stock not available`
                })
                </script>
                ');
        }
        $card = Card::leftJoin('sell_cards', function($join) {
          $join->on('cards.id', '=', 'sell_cards.card_id');
        })
        ->whereNull('sell_cards.card_id')
        ->where('cards.sell_rate_plan_id',$request->sell_rate_plan_id)
        ->where('cards.rate_plan_id',$rate_plan_id)
        ->join('rate_plans', 'rate_plans.id', '=', 'cards.rate_plan_id')
        ->select('cards.*','rate_plans.amount','rate_plans.currency','rate_plans.image','rate_plans.image2','sell_cards.status')
        ->first();
        if (isset($card)) {
            return view('admin.card.sell.new')->with(compact('card'));
        }else{
            return redirect()->back()->with('flash_success','
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
            $sell_card = new SellCard;
            $sell_card->card_id = $id;
            $sell_card->status = 1;
            $discount = $card->amount*$sell_rate_plan->discount;
            $discount += $card->amount*Auth::user()->discount;
            $sell_price = (($sell_rate_plan->amount/10)*$card->amount)-$discount;
            $sell_card->sell_price = $sell_price;
            $sell_card->reseller_id = Auth::user()->id;
            $sell_card->save();
            return view('admin.card.sell.card')->with(compact('card'))->with('successMsg','Card successfully sold out.');
        }elseif(SellCard::where('card_id',$id)->count()>0){
            return redirect(route('admin.card.sell_rate_plan'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `error`,
                  title: `Alrady sell this card`
                })
                </script>
                ');  
        }
    }
    public function card_sell_list(Request $request){
        $card_sells = SellCard::with('card','user')->orderBy('id','desc')->get();
        if ($request->isMethod('post')) {
            $card_sells = SellCard::with('card','user')
            ->whereDate('created_at', '>=',$request->start_date)
            ->whereDate('created_at', '<=',$request->end_date)
            ->orderBy('id','desc')
            ->get();
        }
        return view('admin.card.sell.list')->with(compact('card_sells'));
    }
}
