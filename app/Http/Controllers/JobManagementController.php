<?php

namespace App\Http\Controllers;

use App\Models\JobManagement;
use App\Models\StatusMaster;
use Illuminate\Http\Request;

class JobManagementController extends Controller
{
    public function index()
    {
		$data['result']= StatusMaster::get();
		$data['job']= JobManagement::get();
        return view('JobManagement.jobManagement',$data);
    }

    public function store(Request $request)
	{
		$job_data = $request->validate([
			'jobTitle'         => ['required','string', 'max:255'],
            'description'      => ['required'],
            'experience'       => ['required'],
            'language'         => ['required'],
            'salary'           => ['required'],
            'gender'           => ['required'],
            'vacancy'          => ['required'],
            'status'           => ['required'],
        ], [
		    'jobTitle.required'       => 'Please Enter Job Title',
            'description.required'    => 'Please Enter Description',
            'experience.required'     => 'Please Enter Years Of Experince',
            'language.required'       => 'Please Enter Prefer language',
            'gender.required'         => 'Please Select Gender',
            'salary.required'         => 'Please Enter Salary',
            'vacancy.required'        => 'Please Enter Number Of Vacancies',
            'status.required'         => 'Please Select job Status',
        ]);	   
	    $unique_id = JobManagement::orderBy('id', 'desc')->first();
	    $number = str_replace('RTJ', '', $unique_id ? $unique_id->unqiue_id  : 0);
	    if ($number == 0) {
	    $number = 'RTJ0000001';
	    } else {
		$number = "RTJ" . sprintf("%07d", (int)$number + 1);
	    }
        $job_data['unique_id']= $number;		
        $job_data['postedDate']= date('Y-m-d');
        $job_data['location']= $_POST['location'];
	    $data=JobManagement::insert($job_data);
	    echo json_encode(['status' => 'success', 'message' => 'Job Details Added Successfully']);
	}
	
	public function viewJobDetails()
	{
		$result['data']=JobManagement::select('*')
                           ->where('id',$_GET['id'])
                           ->get();
        return view('JobManagement.viewJobDetails',$result);
	}
	
	public function deleteJobDetails()
	{
		$data=JobManagement::where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
	
	public function editJobDetails()
	{
		$result['result']= StatusMaster::get(); 
		$result['data']=JobManagement::where('id',$_GET['id'])
                           ->get();
        return view('JobManagement.editJobDetails',$result);
	}
	
	public function saveEditJobDetails(Request $request)
	{
		$id= $request->id;
		$edit_job_data = $request->validate([
			'edit_jobTitle'         => ['required','string', 'max:255'],
            'edit_description'      => ['required'],
            'edit_experience'       => ['required'],
            'edit_language'         => ['required'],
            'edit_salary'           => ['required'],
            'edit_gender'           => ['required'],
            'edit_vacancy'          => ['required'],
            'edit_status'           => ['required'],
        ], [
		    'edit_jobTitle.required'       => 'Please Enter Job Title',
            'edit_description.required'    => 'Please Enter Description',
            'edit_experience.required'     => 'Please Enter Years Of Experince',
            'edit_language.required'       => 'Please Enter Prefer language',
            'edit_gender.required'         => 'Please Select Gender',
            'edit_salary.required'         => 'Please Enter Salary',
            'edit_vacancy.required'        => 'Please Enter Number Of Vacancies',
            'edit_status.required'         => 'Please Select job Status',
        ]);	
	  //echo '<pre>'; print_r($id);die;
		$leadArr=array(
		'jobTitle'           => $_POST['edit_jobTitle'],
        'description'        => $_POST['edit_description'],
        'experience'         => $_POST['edit_experience'],
        'language'           => $_POST['edit_language'],
        'gender'             => $_POST['edit_gender'],
        'salary'             => $_POST['edit_salary'],
        'vacancy'            => $_POST['edit_vacancy'],
        'status'             => $_POST['edit_status'],
        'location'             => $_POST['edit_location'],
		);
		
		$data=JobManagement::where('id',$id)->update($leadArr);
		echo json_encode(['status' => 'success', 'message' => 'Job Details Updated Successfully']);
	}
}
