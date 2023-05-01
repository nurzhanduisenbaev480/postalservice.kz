<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Status;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Notification;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class JournalController extends \App\Http\Controllers\Controller
{
    /**
     * OverheadController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function delete(){
		//dd($_POST);
		$journal = Journal::find($_POST['journal_id'])->delete();
		
		return redirect()->back();
	}
	
    
}
