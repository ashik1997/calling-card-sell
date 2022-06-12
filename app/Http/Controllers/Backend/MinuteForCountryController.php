<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\MinuteForCountry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MinuteForCountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $mfc = new MinuteForCountry;
            $this->validate($request, [
                'minute' => 'required|string',
                'country' => 'required|string',
            ]);
 
            $mfc->minute = $request->minute;
            $mfc->rate_plan_id = $request->rate_plan_id;
            $mfc->country = $request->country;
            $mfc->country_code = $request->country_code;
            $mfc->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Minute successfully added for country`
                })
                </script>
                ');
            
        }
        return view('admin.minute_for_country.add');
    }
    public function list(){
        $mfcs = MinuteForCountry::with('rate_plan')->get();
        return view('admin.minute_for_country.list')->with(compact('mfcs'));
    }
    public function edit(Request $request, $id){
        $mfc = MinuteForCountry::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'minute' => 'required|string',
                'country' => 'required|string',
            ]);
 
            $mfc->minute = $request->minute;
            $mfc->rate_plan_id = $request->rate_plan_id;
            $mfc->country = $request->country;
            $mfc->country_code = $request->country_code;
            $mfc->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Minute successfully updated for country`
                })
                </script>
                ');
            
        }
        return view('admin.minute_for_country.edit')->with(compact('mfc'));

    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = MinuteForCountry::FindOrFail($id);
            MinuteForCountry::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Minute successfully deleted for country`
                })
                </script>
                ');
        }
    }
}
