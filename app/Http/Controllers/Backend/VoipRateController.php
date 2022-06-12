<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Models\VoipRate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoipRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            
            // csv file
            if ($request->hasFile('csv')) {
              $file = $request->file('csv');
              $row = 1;
              if (($handle = fopen($file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if ( $row > 1) {
                        $voip_rate = new VoipRate;
                        // $num = count($data);
                        $code = trim($data[1], '=""');
                        $minute = 100/$data[14];
                        // echo "<div class='card'>";
                        // echo "Country: $data[0] <br />\n";
                        // echo "Code: $data[1] <br />\n";
                        // echo "Rate: $data[14] <br />\n";
                        // echo "</div>";
                        $voip_rate->country = $data[0];
                        $voip_rate->code = $code;
                        $voip_rate->rate = $data[14];
                        $voip_rate->minute = $minute;
                        $voip_rate->save();
                    }
                  $row++;
                }
                fclose($handle);
              }
            }else{
                $voip_rate = new VoipRate;
                $voip_rate->country = $request->country;
                $voip_rate->code = $request->code;
                $voip_rate->rate = $request->rate;
                $voip_rate->minute = $request->minute;
                $voip_rate->save();
            }
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Voip rate successfully added`
                })
                </script>
                ');
        }
        return view('admin.voip_rate.new');
    }
    public function list(){
        $voip_rates = VoipRate::all();
        return view('admin.voip_rate.list')->with(compact('voip_rates'));
    }
    public function edit(Request $request, $id){
        $voip_rate = VoipRate::find($id);
        if ($request->isMethod('post')) {
            $voip_rate->country = $request->country;
            $voip_rate->code = $request->code;
            $voip_rate->rate = $request->rate;
            $voip_rate->minute = $request->minute;
            $voip_rate->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Voip rate successfully updated`
                })
                </script>
                ');
        }
        return view('admin.voip_rate.edit')->with(compact('voip_rate'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            if($id=='all'){
                VoipRate::truncate();
                return redirect()->back()->with('flash_success','
                    <script>
                    Toast.fire({
                      icon: `success`,
                      title: `All data successfully deleted`
                    })
                    </script>
                    ');
            }else{
                VoipRate::find($id)->delete();
                return redirect()->back()->with('flash_success','
                    <script>
                    Toast.fire({
                      icon: `success`,
                      title: `Voip rate successfully deleted`
                    })
                    </script>
                    ');
            }
        }
    }
}
