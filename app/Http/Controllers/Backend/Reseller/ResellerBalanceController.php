<?php

namespace App\Http\Controllers\Backend\Reseller;

use Auth;
use App\Models\User;
use App\Models\ResellerBalance;
use App\Models\ResellerPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResellerBalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'reseller_id' => 'required',
                'paid_amount' => 'required|numeric'
            ]);
            if ($request->paid_amount<0) {
                return redirect()->back()->with('flash_success','
                    <script>
                    Toast.fire({
                      icon: `error`,
                      title: `The subtraction value will not be submitted.`
                    })
                    </script>
                    ');
            }
            if ($request->payment_type=='return') {
                $my_balance = User::reseller_balance($request->reseller_id);
                if ($my_balance<$request->add_balance) {
                    return redirect()->back()->with('flash_success','
                        <script>
                        Toast.fire({
                          icon: `error`,
                          title: `There is not enough money in the seller account.`
                        })
                        </script>
                        ');
                }
                if ($request->add_balance<=0) {
                    return redirect()->back()->with('flash_success','
                        <script>
                        Toast.fire({
                          icon: `error`,
                          title: `The amount given cannot be equal to zero.`
                        })
                        </script>
                        ');
                }
                $reseller_balance = new ResellerBalance;
                $reseller_balance->reseller_id = $request->reseller_id;
                $reseller_balance->payment_type = $request->payment_type;
                $reseller_balance->payment_date = $request->payment_date;
                $reseller_balance->note = $request->note;
                $reseller_balance->added_by_id = Auth::user()->id;
                $reseller_balance->amount = $request->add_balance-($request->add_balance*2);
                $reseller_balance->save();
            }elseif ($request->payment_type=='balance') {
                $my_balance = User::reseller_balance(Auth::user()->id);
                if ($my_balance<$request->add_balance) {
                    return redirect()->back()->with('flash_success','
                        <script>
                        Toast.fire({
                          icon: `error`,
                          title: `You do not have enough money in your account.`
                        })
                        </script>
                        ');
                }
                if ($request->add_balance>0) {
                    $reseller_balance = new ResellerBalance;
                    $reseller_balance->reseller_id = $request->reseller_id;
                    $reseller_balance->payment_type = $request->payment_type;
                    $reseller_balance->payment_date = $request->payment_date;
                    $reseller_balance->note = $request->note;
                    $reseller_balance->added_by_id = Auth::user()->id;
                    $reseller_balance->amount = $request->add_balance;
                    $reseller_balance->save();
                }
                // reseller payment
                if ($request->paid_amount>0) {
                    $reseller_payment = new ResellerPayment;
                    $reseller_payment->reseller_id = $request->reseller_id;
                    $reseller_payment->payment_type = $request->payment_type;
                    $reseller_payment->payment_date = $request->payment_date;
                    $reseller_payment->note = $request->note;
                    $reseller_payment->added_by_id = Auth::user()->id;
                    $reseller_payment->amount = $request->paid_amount;
                    $reseller_payment->save();
                }
            }elseif ($request->payment_type=='payment') {
                if ($request->paid_amount>0) {
                    $reseller_payment = new ResellerPayment;
                    $reseller_payment->reseller_id = $request->reseller_id;
                    $reseller_payment->payment_type = $request->payment_type;
                    $reseller_payment->payment_date = $request->payment_date;
                    $reseller_payment->note = $request->note;
                    $reseller_payment->added_by_id = Auth::user()->id;
                    $reseller_payment->amount = $request->paid_amount;
                    $reseller_payment->save();
                }
            }
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Reseller balance successfully added`
                })
                </script>
                ');
            
        }
        return view('reseller.reseller_balance.add');
    }
    public function list(Request $request){
        $reseller_balances = ResellerBalance::with('reseller','added_by')->where('added_by_id',Auth::user()->id)->get();
        if ($request->isMethod('post')) {
            $reseller_balances = ResellerBalance::with('reseller','added_by')->whereBetween('payment_date', [$request->start_date, $request->end_date])->where('added_by_id',Auth::user()->id)->get();
        }
        return view('reseller.reseller_balance.list')->with(compact('reseller_balances'));
    }
    public function due_by_reseller_id(Request $request){
        if ($request->isMethod('post')) {
            
            $due = User::reseller_due($request->id);
            $balance = User::reseller_balance($request->id);
            $data = array($due,$balance
            );
            return json_encode($data);
        }
    }
}
