<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
		$data['result']= Designation::get();
        return view('masterModules.designationDetails',$data);
    }
	
	public function store(Request $request)
	{
		$des_data = $request->validate([
			'designationName'    => ['required','string', 'max:255'],
        ], [
		    'designationName.required'   => 'Please Enter Designation',            
        ]);
		   $unique_id = Designation::orderBy('id', 'desc')->first();
           $number = str_replace('MED', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) {
           $number = 'MED0000001';
           } else {
            $number = "MED" . sprintf("%07d", (int)$number + 1);
           }
		   $des_data['unique_id'] = $number;
		   $data=Designation::insert($des_data);
		   echo json_encode(['status' => 'success', 'message' => 'Data Succesfully Submitted']);
	}
	
	public function editDesignationDetails()
	{
		$result['data']=Designation::select('*')
                                ->where('id',$_GET['id'])
                                ->get()
								->toarray();
        return view('masterModules.editDesignationDetails',$result);
	}
	
	public function saveEditDesignationDetails(Request $request)
    {
        $id=$request->id;
	    $edit_data = $request->validate([
			'edit_designationName'     => ['required','string', 'max:255'],           
        ], [
		    'edit_designationName.required'   => 'Please Enter Designation',
        ]);
		$editArr=array(
		'designationName'     => $_POST['edit_designationName'],
		);
		$data=Designation::where('id',$id)->update($editArr);
		echo json_encode(['status' => 'success', 'message' => 'Data Edit Succesfully']);
    }
	
	public function deleteDesignationDetails(Request $request)
	{
		$data=Designation::where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
}
