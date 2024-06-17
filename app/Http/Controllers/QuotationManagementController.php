<?php

namespace App\Http\Controllers;

use App\Models\QuotationManagement;
use Illuminate\Http\Request;

class QuotationManagementController extends Controller
{
    public function index()
    {
		$data['quote']= QuotationManagement::get();
        return view('QuotationManagement.quotation',$data);
    }

    public function store(Request $request)
    {
        $lead_data = $request->validate([
			'quotationDate'     => ['required'],
            'quotationNumber'   => ['required'],
            'uploadQuotation'   => ['required'],
        ], [
		    'quotationDate.required'      => 'Please Select Quotation Date',
            'quotationNumber.required'    => 'Please Enter Quotation Number',
            'uploadQuotation.required'    => 'Please Upload Quotation File',
        ]);	   
	    $unique_id = QuotationManagement::orderBy('id', 'desc')->first();
	    $number = str_replace('RGQ', '', $unique_id ? $unique_id->unique_id  : 0);
	    if ($number == 0) {
	    $number = 'RGQ0000001';
	    } else {
		$number = "RGQ" . sprintf("%07d", (int)$number + 1);
	    }
		
		$str_time = time();
		if ($request->file('uploadQuotation')) {
            $file_type = $request->file('uploadQuotation')->extension();
            $file_path = $request->file('uploadQuotation')->storeAs('img/quotation', 'Quotation_' . $str_time . '.' . $file_type, 'public');
            $request->file('uploadQuotation')->move(public_path('img/quotation'), 'Quotation_' . $str_time . '.' . $file_type);
        } else {
            $file_path = null;
        }
		
        $lead_data['unique_id']= $number;	   
        $lead_data['customerName']= $_POST['customerName'];	   
        $lead_data['total_amount']= $_POST['total_amount'];	   
        $lead_data['amount_received']= $_POST['amount_received'];	   
        $lead_data['pending_balance']= $_POST['pending_balance'];	   	
        $lead_data['uploadQuotation']= $file_path;
        if($_POST['amount_received'] <= $_POST['total_amount'])
        {
			$lead_data['status']= 'Partially Paid';
		}
        if($_POST['amount_received'] == $_POST['total_amount'])
        {
			$lead_data['status']= 'Paid';
		}
        if($_POST['amount_received'] == '0.00')
        {
			$lead_data['status']= 'Pending';
		}		
	    $data=QuotationManagement::insert($lead_data);
	    echo json_encode(['status' => 'success', 'message' => 'Quotation Added Successfully']);
    }

    public function viewQuotationDetails()
	{
		$result['data']= QuotationManagement::select('*')->where('id', $_GET['id'])->get();
		return view('QuotationManagement.viewQuotationDetails',$result);
	}
	
	public function editQuotationDetails()
	{
		$result['data']= QuotationManagement::select('*')->where('id', $_GET['id'])->get();
		return view('QuotationManagement.editQuotationDetails',$result);
	}
	
	public function save_editQuotationDetails(Request $request)
	{
		$lead_data = $request->validate([
			'edit_quotationDate'     => ['required'],
            'edit_quotationNumber'   => ['required'],
        ], [
		    'edit_quotationDate.required'      => 'Please Select Quotation Date',
            'edit_quotationNumber.required'    => 'Please Enter Quotation Number',
        ]);	   
	    
		$str_time = time();
		if ($request->file('edit_uploadQuotation')) {
            $file_type = $request->file('edit_uploadQuotation')->extension();
            $file_path = $request->file('edit_uploadQuotation')->storeAs('img/quotation', 'Quotation_' . $str_time . '.' . $file_type, 'public');
            $request->file('edit_uploadQuotation')->move(public_path('img/quotation'), 'Quotation_' . $str_time . '.' . $file_type);
        } else {
            $file_path = $request->editQuotationPic;
        }
		
		if($_POST['edit_amount_received'] <= $_POST['edit_total_amount'])
        {
			$status = 'Partially Paid';
		}
        if($_POST['edit_amount_received'] == $_POST['edit_total_amount'])
        {
			$status = 'Paid';
		}
        if($_POST['edit_amount_received'] == '0.00')
        {
			$status = 'Pending';
		}	
		
		$arr= array(
		'quotationNumber' => $_POST['edit_quotationNumber'],
		'customerName'    => $_POST['edit_customerName'],
		'total_amount'    => $_POST['edit_total_amount'],
		'amount_received' => $_POST['edit_amount_received'],
		'pending_balance' => $_POST['edit_pending_balance'],
		'quotationDate'   => $_POST['edit_quotationDate'],
		'uploadQuotation' => $file_path,
		'status'          => $status,
		);
			
	    $data=QuotationManagement::where('id', $_POST['editID'])->update($arr);
	    echo json_encode(['status' => 'success', 'message' => 'Quotation Updated Successfully']);
	}
	
	public function deleteQuotationDetails()
	{
		$data=QuotationManagement::where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
	
	public function downloadQuotation(){
	$file = QuotationManagement::where('id', $_GET['id'])->first();
		//echo '<pre>'; print_r($file);die; 
        $pathofFile = $file->uploadQuotation;
        return response()->download($pathofFile);
	}
}
