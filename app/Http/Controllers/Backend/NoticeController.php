<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Image;
use App\Models\Notice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){

        if ($request->isMethod('post')) {
            $notice = new Notice;
            $this->validate($request, [
                'title' => 'required|string'
            ]);
            $notice->title = $request->title;
            $notice->description = $request->description;
            $notice->user_id = Auth::user()->id;
            $notice->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Notice successfully added`
                })
                </script>
                ');
        }
        return view('admin.notice.new');
    }
    public function list(){
        $notices = Notice::with('user')->get();
        return view('admin.notice.list')->with(compact('notices'));
    }
    public function edit(Request $request, $id){
        $notice = Notice::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required|string'
            ]);
            $notice->title = $request->title;
            $notice->description = $request->description;
            $notice->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Notice successfully updated`
                })
                </script>
                ');
        }
        return view('admin.notice.edit')->with(compact('notice'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = Notice::FindOrFail($id);
            if (Notice::find($id)->delete()) {
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Notice successfully deleted`
                })
                </script>
                ');
            }else{
                return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `eror`,
                  title: `Notice can not be deleted`
                })
                </script>
                ');
            }
            
        }
    }
}
