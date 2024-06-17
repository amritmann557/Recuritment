<?php

namespace App\Http\Controllers;

use App\Models\TaskManagement;
use App\Models\EmployeeManagement;
use App\Models\StatusMaster;
use Illuminate\Http\Request;
use Helper;

class TaskManagementController extends Controller
{
    public function index()
    {
		$data['employee']= EmployeeManagement::where('status', 'Active')->get();
		$data['task']= TaskManagement::get();
		$data['allTask']= TaskManagement::get()->count();
        return view('TaskManagement.task',$data);
    }

    public function store(Request $request)
    {
        $task_data = $request->validate([
			'staffName'   => ['required','string', 'max:255'],
            'title'       => ['required'],
            'date'        => ['required'],
            'priority'    => ['required','string', 'max:255'],
        ], [
		    'staffName.required'    => 'Please Select Employee Name',
            'title.required'        => 'Please Enter Title Name',
            'date.required'         => 'Please Select Date',
            'priority.required'     => 'Please Select Task Priority',
        ]);	   
	   $unique_id = TaskManagement::orderBy('id', 'desc')->first();
	   $number = str_replace('RGT', '', $unique_id ? $unique_id->unique_id  : 0);
	   if ($number == 0) {
	   $number = 'RGT0000001';
	   } else {
		$number = "RGT" . sprintf("%07d", (int)$number + 1);
	   }
       $task_data['unique_id']= $number;	   
       $task_data['details']= $_POST['details'];	   	   
       $task_data['status']= 'Pending';	   	   
	   $data=TaskManagement::insert($task_data);
	   echo json_encode(['status' => 'success', 'message' => 'Task Assigned Successfully']);
    }
	
	public function editTaskDetails(){
		$result['employee']= EmployeeManagement::where('status', 'Active')->get();
		$result['data']=TaskManagement::where('id',$_GET['id'])->get();
        return view('TaskManagement.editTaskDetails',$result); 
	}
	
	public function save_editTaskDetails(Request $request){
		$id= $request->id;
		$edit_task_data = $request->validate([
			'edit_staffName'   => ['required','string', 'max:255'],
            'edit_title'       => ['required'],
            'edit_date'        => ['required'],
            'edit_priority'    => ['required','string', 'max:255'],
        ], [
		    'edit_staffName.required'    => 'Please Select Employee Name',
            'edit_title.required'        => 'Please Enter Title Name',
            'edit_date.required'         => 'Please Select Date',
            'edit_priority.required'     => 'Please Select Task Priority',
        ]);
	  //echo '<pre>'; print_r($id);die;
		$taskArr=array(
		'staffName'   => $_POST['edit_staffName'],
        'title'       => $_POST['edit_title'],
        'date'        => $_POST['edit_date'],
        'priority'    => $_POST['edit_priority'],
        'details'     => $_POST['edit_details'],
		);
	   	
		$data=TaskManagement::where('id',$id)->update($taskArr);
		echo json_encode(['status' => 'success', 'message' => 'Task Details Updated Successfully']);
	}
	
	public function deleteTaskDetails()
	{
		$data=TaskManagement::where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
	
	public function updateTaskStatus()
	{
		$result['update']= StatusMaster::get();
		$result['data']= TaskManagement::where('id', $_GET['id'])->get();
		return view('TaskManagement.statusUpdate',$result);
	}
	
	public function saveUpdateTaskStatus(Request $request)
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
		
		$data=TaskManagement::where('id',$_POST['updateStatusID'])->update($assignArr);
		echo json_encode(['status' => 'success', 'message' => 'Status Updated Successfully']);
	}
}
