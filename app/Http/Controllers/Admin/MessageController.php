<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Status;
use App\Models\Message;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Notification;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class MessageController extends \App\Http\Controllers\Controller
{
    /**
     * MessageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index(){
		
		
		return view('admin.message.index');
	}
	
}
