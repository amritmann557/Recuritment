<?php

namespace App\Http\Controllers;

use App\Models\StatusMaster;
use Illuminate\Http\Request;

class StatusMasterController extends Controller
{
    public function index()
    {
		$data['result']= StatusMaster::get();
        return view('masterModules.status',$data);
    }
	
	public function store(Request $request)
	{
		$status_data = $request->validate([
			'statusName'    => ['required','string', 'max:255'],
        ], [
		    'statusName.required'   => 'Please Enter Status Name',            
        ]);
		   $unique_id = StatusMaster::orderBy('id', 'desc')->first();
           $number = str_replace('RGS', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) {
           $number = 'RGS0000001';
           } else {
            $number = "RGS" . sprintf("%07d", (int)$number + 1);
           }
		   $status_data['unique_id'] = $number;
		   $data=StatusMaster::insert($status_data);
		   echo json_encode(['status' => 'success', 'message' => 'Status Detail Succesfully Submitted']);
	}
	
	public function editStatusDetails()
	{
		$result['data']=StatusMaster::select('*')
                                ->where('id',$_GET['id'])
                                ->get()
								->toarray();
        return view('masterModules.editStatusDetails',$result);
	}
	
	public function saveEditStatusDetails(Request $request)
    {
        $id=$request->id;
	    $edit_data = $request->validate([
			'edit_statusName'     => ['required','string', 'max:255'],           
        ], [
		    'edit_statusName.required'   => 'Please Enter Status Name',
        ]);
		$editArr=array(
		'statusName'     => $_POST['edit_statusName'],
		);
		$data=StatusMaster::where('id',$id)->update($editArr);
		echo json_encode(['status' => 'success', 'message' => 'Data Edit Succesfully']);
    }
	
	public function deleteStatusDetails(Request $request)
	{
		$data=StatusMaster::where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
}
