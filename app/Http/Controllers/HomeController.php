<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskManagement;
use App\Models\EmployeeManagement;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		//$data['task']= TaskManagement::where('staffName', Auth::user()->unique_id)->where('status','!=','Completed')->get();
		$data['empName']= EmployeeManagement::where('unique_id', Auth::user()->unique_id)->get();
		$data['websiteLeads']= DB::table('website_leads')->get()->count();
        return view('home',$data);
    }
}
