<?php

namespace App\Http\Controllers\Backend\Reseller;
use Auth;
use App\Models\User;
use App\Models\ResellerPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResellerPaymentController extends Controller
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

            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Reseller balance successfully added`
                })
                </script>
                ');
            
        }
        return view('reseller.reseller_payment.add');
    }
    public function list(){
        $reseller_payments = ResellerPayment::with('reseller','added_by')->where('added_by_id',Auth::user()->id)->paginate(10);
        return view('reseller.reseller_payment.list')->with(compact('reseller_payments'));
    }
}
