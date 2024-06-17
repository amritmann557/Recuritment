<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
		$data['about']= About::get();
        return view('masterModules.about', $data);
    }

    public function store(Request $request)
    {
        $condition_data = $request->validate([
			'titleName'       => ['required','string'],
            //'conditionDetails'    => ['required'],
        ], [
		    'titleName.required'       => 'Please Enter Title',
            //'conditionDetails.required'    => 'Please Enter Terms And Condition Details',
        ]);
		   $unique_id = About::orderBy('id', 'desc')->first();
           $number = str_replace('RTA', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) {
           $number = 'RTA0000001';
           } else {
            $number = "RTA" . sprintf("%07d", (int)$number + 1);
           }
		   $condition_data['unique_id']= $number;
		   $condition_data['aboutDetails']= $_POST['contentDetails'];
		   $condition_data['textcontentDetails']= $_POST['textcontentDetails'];
		  // echo '<pre>'; print_r($condition_data);die;
		  $result= About::where('titleName', $_POST['titleName'])->get();
		  //echo '<pre>';print_r($result);die;
		  if(count($result) > 0){
			  echo json_encode(['status' => 'wrong', 'message' => 'Data is already stored under This Option. You may Edit or delete']);
		  }
		  else{
		   $data=About::insert($condition_data);
		   echo json_encode(['status' => 'success', 'message' => 'Content Details Successfully Submitted']);
		  }
    }
	
	public function editContentDetails()
    {
        $data= About::where('id', $_GET['id'])->get();
        //echo '<pre>'; print_r($data);die;
        echo json_encode($data);
    }
	
	public function saveEditContentDetails(Request $request)
	{
	  $id= $request->id;
	  $editContent_data = $request->validate([
			'editTitleName'       => ['required','string'],
            //'conditionDetails'    => ['required'],
        ], [
		    'editTitleName.required'       => 'Please Enter Title Name',
            //'conditionDetails.required'    => 'Please Enter Terms And Condition Details',
        ]);
		$conditionArr[]=array(
		'titleName'       => $_POST['editTitleName'],
        'aboutDetails'    => $_POST['editcontentDetails'],
        'textcontentDetails' => $_POST['edittextcontentDetails'],
		);
		
		//echo '<pre>';print_r($brokerArr);die;
		
		$data=About::where('id',$_POST['edit_id'])->update($conditionArr[0]);
		echo json_encode(['status' => 'success', 'message' => 'Content Details Updated Successfully']);
	}

   public function deleteContentDetails(Request $request)
	{
		$data=About::where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
}
