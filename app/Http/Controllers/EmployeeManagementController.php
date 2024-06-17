<?php

namespace App\Http\Controllers;

use App\Models\EmployeeManagement;
use App\Models\User;
use App\Models\Designation;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeManagementController extends Controller
{
    public function index()
    {
		$data['designation']= Designation::get();
		$data['employee']= EmployeeManagement::get(); 
        return view('ProfileManagement.employee',$data);
    }

    public function store(Request $request)
    {
        $employee_data = $request->validate([
			'employeeName'         => ['required','string', 'max:255'],
            'contact_number'       => ['required'],
            'position'             => ['required','string', 'max:255'],
            'email'                => ['required','string','max:255'],
            'password'             => ['required','string', 'max:255'],
        ], [
		    'employeeName.required'          => 'Please Enter Employee Name',
            'contact_number.required'        => 'Please Enter Contact Number',
            'position.required'              => 'Please Select Job Position',
            'email.required'                 => 'Please Enter Email Address',
            'password.required'              => 'Please Enter Password',
        ]);	   
	   $unique_id = EmployeeManagement::orderBy('id', 'desc')->first();
	   $number = str_replace('RGE', '', $unique_id ? $unique_id->unique_id  : 0);
	   if ($number == 0) {
	   $number = 'RGE0000001';
	   } else {
		$number = "RGE" . sprintf("%07d", (int)$number + 1);
	   }
       $employee_data['unique_id']= $number;	   
       $employee_data['status']= 'Active';	   	   
       $employee_data['gender']= $_POST['gender'];
       $employee_data['password'] = Hash::make($_POST['password']);
	   $data=EmployeeManagement::insert($employee_data);
	   
	   $details= array(
	     'name' => $_POST['employeeName'],
		 'email' => $_POST['email'],
		 'password'  => Hash::make($_POST['password']),
		 'gender' => $_POST['gender'],
		 'position' => $_POST['position'],
		 'unique_id'=> $number,
	   );
	   
	   $data= User::insert($details);
	   echo json_encode(['status' => 'success', 'message' => 'Employee Data Succesfully Submitted']);
    }
	
	public function checkEmail()
	{
		$data= EmployeeManagement::where('email',$_GET['data'])->get();
		if(count($data) > 0)
		{
			echo json_encode(['status' => 'success', 'message' => 'Email Address Already Taken']);
		}
		else{
			echo json_encode(['status' => 'error', 'message' => 'Good To Go..']);
		}
	}

    public function viewEmployeeDetails()
	{
		$result['data']=EmployeeManagement::select('*')
                           ->where('id',$_GET['id'])
                           ->get();
        return view('ProfileManagement.viewEmployeeDetails',$result);
	}
	
	public function editEmployeeDetails()
	{
		$result['designation']= Designation::get();
		$result['data']=EmployeeManagement::select('*')
		                   ->join('users','users.unique_id','=','employee_management.unique_id')
                           ->where('employee_management.unique_id',$_GET['id'])
                           ->get();
        return view('ProfileManagement.editEmployeeDetails',$result);
	}
	
	public function saveEditEmployeeDetails(Request $request){
		$id= $request->id;
		$edit_employee_data = $request->validate([
			'edit_employeeName'         => ['required','string', 'max:255'],
            'edit_contact_number'       => ['required'],      
            'edit_position'             => ['required','string', 'max:255'],
            'edit_email'                => ['required','string','max:255'],
        ], [
		    'edit_employeeName.required'          => 'Please Enter Employee Name',
            'edit_contact_number.required'        => 'Please Enter Contact Number',
            'edit_position.required'              => 'Please Select Job Position',
            'edit_email.required'                 => 'Please Enter Email Address',
        ]);
	  //echo '<pre>'; print_r($id);die;
		$employeeArr=array(
		'employeeName'           => $_POST['edit_employeeName'],
        'contact_number'         => $_POST['edit_contact_number'],
        'position'               => $_POST['edit_position'],
        'email'                  => $_POST['edit_email'],
        'status'                 => $_POST['edit_status'],
	    'gender'                 => $_POST['edit_gender']
		);
	   
	   $edit_details= array(
	     'name'     => $_POST['edit_employeeName'],
		 'email'    => $_POST['edit_email'],
		 'password' => Hash::make($_POST['edit_password']),
		 'gender'   => $_POST['edit_gender'],
		 'position' => $_POST['edit_position'],
	   );
		
		$data=EmployeeManagement::where('unique_id',$id)->update($employeeArr);
		$data=User::where('unique_id',$id)->update($edit_details);
		echo json_encode(['status' => 'success', 'message' => 'Employee Details Updated Successfully']);
	}
	
	public function deleteEmployeeDetails()
	{
		$data=EmployeeManagement::where('unique_id', $_POST['id'])->delete();
		$data=User::where('unique_id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
	
	public function viewProfileDetails()
	{
		$data['employee']= EmployeeManagement::select('*')
		                                     ->join('users','users.unique_id','=','employee_management.unique_id')
		                                     ->where('employee_management.unique_id',Auth::user()->unique_id)
											 ->get();
											 //echo '<pre>';print_r($data['employee']);die;
		return view('ProfileManagement.profileDetails',$data);
	}
	
	public function resetPassword()
	{
	    return view('ProfileManagement.resetPassword');
	}
	
	public function saveResetPassword(Request $request)
	{
	    $pass_data = $request->validate([
			'email'             => ['required'],
            'newPassword'       => ['required'],      
            'confirmPassword'   => ['required'],
        ], [
		    'email.required'              => 'Please Enter Email Name',
            'newPassword.required'        => 'Please Enter New Password',
            'confirmPassword.required'    => 'Please Enter Confirm Password',
        ]);
        
        $data= DB::table('appEmployerUsers')->where('emailAddress', $_POST['email'])->update(['password' => md5($_POST['confirmPassword'])]);
        echo json_encode(['status' => 'success', 'message' => 'Password Changed Successfully']);
	}
	
	public function getAppEmployerUsers()
	{
	  $data['result']= DB::table('appEmployerUsers')->where('userType','Employeer')->where('otpDone', 1)->get();
	  return view('ProfileManagement.appEmployerDetails',$data);
	}
	
	public function getAppEmployeeUsers()
	{
	  $data['result']= DB::table('appEmployerUsers')->where('userType','Employee')->where('otpDone', 1)->get();
	  return view('ProfileManagement.appEmployeeDetails',$data);
	}
}
