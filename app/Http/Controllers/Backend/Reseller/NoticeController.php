<?php

namespace App\Http\Controllers\Backend\Reseller;

use Auth;
use App\Models\Notice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list(){
        $notices = Notice::with('user')->where('status',1)->get();
        return view('reseller.notice.list')->with(compact('notices'));
    }
}
