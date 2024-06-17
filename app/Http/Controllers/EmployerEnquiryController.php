<?php

namespace App\Http\Controllers;

use App\Models\EmployerEnquiry;
use DB;
use App\Models\StatusMaster;
use Illuminate\Http\Request;

class EmployerEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['result']= DB::table('job_description')->select('job_description.*','appEmployerUsers.*','job_description.id as descriptionID')->join('appEmployerUsers','appEmployerUsers.unique_id','=','job_description.userID')->where('job_description.userType','Employeer')->get();
       // echo '<pre>';print_r($data);die;
        return view('EmployerEnquiry.employerEnquiry',$data);
    }

    public function viewEmployerEnquiryDetails()
    {
        $details= DB::table('job_description')->select('*')->where('id', $_GET['id'])->get();
        //echo '<pre>';print_r($details);die;
        $result['data']=DB::table('job_description')->select('*')->join('appEmployerUsers','appEmployerUsers.unique_id','=','job_description.userID')->where('job_description.userID',$details[0]->userID)->get();
        //echo '<pre>';print_r($result);die;
		return view('EmployerEnquiry.viewEmployerEnquiry',$result);
    }
    
     public function updateEmployerEnquiryStatus()
	{
		$result['update']= StatusMaster::get();
		$result['data']= DB::table('job_description')->select('*')->where('id', $_GET['id'])->get();
		//echo '<pre>';print_r($result);die;
		return view('EmployerEnquiry.updateStatus',$result);
	}
	
	public function saveUpdatedEmployerEnquiryStatus(Request $request)
	{
		$status_data = $request->validate([
			'statusUpdate'     => ['required','string', 'max:255'],
        ], [
		    'statusUpdate.required'     => 'Please Select Status',
        ]);
		$assignArr=array(
		'status'   => $_POST['statusUpdate'],
		);
		
		//echo '<pre>';print_r($brokerArr);die;
		
		$data=DB::table('job_description')->where('id',$_POST['updateStatusID'])->update($assignArr);
		echo json_encode(['status' => 'success', 'message' => 'Status Updated Successfully']);
	}
	
		public function deleteEmployerEnquiryDetails()
	{
	    //echo '<pre>';print_r($_POST['id']);die;
		$data=DB::table('job_description')->where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
}
