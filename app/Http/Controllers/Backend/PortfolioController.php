<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Models\Portfolio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $portfolio = new Portfolio;
            if ($request->hasFile('img')) {
                // image
                $extension = strtolower($request->file('img')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->img);
                $image->save('frontend/assets/img/portfolio/'.$file_name);
                $portfolio->img = $file_name;
            }
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            $portfolio->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Portfolio successfully added`
                })
                </script>
                ');
        }
        return view('admin.portfolio.add');
    }
    public function list(){
        $portfolios = Portfolio::all();
        return view('admin.portfolio.list')->with(compact('portfolios'));
    }
    public function edit(Request $request, $id){
        $portfolio = Portfolio::find($id);
        if ($request->isMethod('post')) {
            if ($request->hasFile('img')) {
                // image
                $extension = strtolower($request->file('img')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->img);
                $image->save('frontend/assets/img/portfolio/'.$file_name);
                $image_path = 'frontend/assets/img/portfolio/'.$portfolio->img;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $portfolio->img = $file_name;
            }

            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            $portfolio->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Portfolio successfully updated`
                })
                </script>
                ');
        }
        return view('admin.portfolio.edit')->with(compact('portfolio'));
    }
    public function destroy($id) {
        if (!empty($id)) {
            $data = Portfolio::FindOrFail($id);
            $img = 'frontend/assets/img/portfolio/'.$data->img;
            if (file_exists($img)) {
                @unlink($img);
            }
            Portfolio::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Portfolio successfully deleted`
                })
                </script>
                ');
        }
    }
}
