<?php

namespace App\Http\Controllers\Backend;
use Auth;
use DB;
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
        return view('admin.reseller_payment.add');
    }
    public function list(Request $request){
        $admins = User::where('role','admin')->get();
        $reseller_payments = array();
        foreach ($admins as $key => $admin) {
            $reseller_paymentss = ResellerPayment::with('reseller','added_by')->where('added_by_id',$admin->id)->orderBy('id', 'desc')->get();
            foreach($reseller_paymentss as $key => $reseller_payment){
                $reseller_payments[$reseller_payment->id] = [
                    'reseller_name' => $reseller_payment->reseller->name,
                    'added_by_name' => $reseller_payment->added_by->name,
                    'payment_date' => $reseller_payment->payment_date,
                    'amount' => $reseller_payment->amount,
                    'note' => $reseller_payment->note,
                    'created_at' => $reseller_payment->created_at->format('d/m/Y, h:i A')
                ];
            }
        }
        
        if ($request->isMethod('post')) {
            $admins = User::where('role','admin')->get();
            $reseller_payments = array();
            foreach ($admins as $key => $admin) {
                $reseller_paymentss = ResellerPayment::with('reseller','added_by')->whereBetween('payment_date', [$request->start_date, $request->end_date])->where('added_by_id', $admin->id)->orderBy('id', 'desc')->get();
                foreach($reseller_paymentss as $key => $reseller_payment){
                    $reseller_payments[$reseller_payment->id] = [
                        'reseller_name' => $reseller_payment->reseller->name,
                        'added_by_name' => $reseller_payment->added_by->name,
                        'payment_date' => $reseller_payment->payment_date,
                        'amount' => $reseller_payment->amount,
                        'note' => $reseller_payment->note,
                        'created_at' => $reseller_payment->created_at->format('d/m/Y, h:i A')
                    ];
                }
            }
        }
        $reseller_payments = json_encode($reseller_payments);
        return view('admin.reseller_payment.list')->with(compact('reseller_payments'));
    }
}
