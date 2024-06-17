<?php

namespace App\Http\Controllers;

use App\Models\LeadsManagement;
use App\Models\StatusMaster;
use App\Models\EmployeeManagement;
use Illuminate\Http\Request;
use Auth;
use Helper;
use DB;
use Session;
use Facebook\Sdk\FbApp;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdCreative;
use FacebookAds\Object\AdCreativeObjectStorySpec;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\AdCreativeFields;
use FacebookAds\Object\Fields\AdCreativeObjectStorySpecFields;
use FacebookAds\Object\Fields\AdFields;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\CampaignFields;

class LeadsManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		/*$data['status']= StatusMaster::get(); 
		if(Auth::user()->position == 'Super Admin'){
		$data['lead']= LeadsManagement::get(); 
		}
		else{
		$data['lead']= LeadsManagement::where('assignedTo', Auth::user()->name)->get();	
		}
		$data['employee']= EmployeeManagement::where('status','Active')->get(); 
        return view('LeadsManagement.leads',$data);*/
        return view('LeadsManagement.facebookconnect');
    }
    
     public function callback(Request $request)
    {
        $appDetails = Helper::getAppDetails();
       // echo '<pre>';print_r($appDetails);die; 
        $details = $request->all(); 
       // $userunique = Session::get('userRef');
       $userunique= Auth::user()->unique_id;
        //echo '<pre>';print_r($userunique);die;
        require_once(app_path() . '/Services/fb/bootstrap.php');
    		$fb = new Facebook([
    			'app_id'                => $fb_app_id,
    			'app_secret'            => $fb_app_secret,
    			'default_graph_version' => $fb_api_version,
    	]);
    	
    	$r=json_decode(file_get_contents("https://graph.facebook.com/v5.0/oauth/access_token?grant_type=fb_exchange_token&client_id=".$appDetails[0]->fbAppId."&client_secret=".$appDetails[0]->fbAppSecret."&fb_exchange_token=".$details['postdata']['authResponse']['accessToken'])); // get long-lived token
		
		
		$longtoken=$r->access_token;
		$userr=json_decode(file_get_contents("https://graph.facebook.com/v5.0/me?access_token={$longtoken}")); // get user id
	       	
		$userid=$userr->id;
		//echo '<pre>';print_r($userid);die;
		/* Fetch Fb Businesss */ 
		    $requestAcc = $fb->request('GET',"/".$userid."/businesses", $data=array(), $longtoken);
	        $response = $fb->getClient()->sendRequest($requestAcc);
	        $business=$response->getDecodedBody();
	        
	         $pixels = array();
	        $bussinessArr =  array();
	        if(isset($business['data'][0]['id'])){
		    for($b = 0 ;$b < count($business['data']);$b++){
        		 $bussinessArr[] = array(
    		            'userId' => $userunique,
    		            'businessId'=>$business['data'][$b]['id'],
    		            'businessName'=>$business['data'][$b]['name'],
    		            'status'=>'active'
	            );
		         }
	        }
	        else if(isset($business['error'])){
	           $errorMessage = $business['error']['message'];
	        }  
	        
	        /* Fetch the User Fb Ads Accounts */
	         
    		$requestAcc = $fb->request('GET',"/".$userid."/adaccounts?fields=id,name,account_id,business_id&limit=100", $data=array(), $longtoken);
            $response = $fb->getClient()->sendRequest($requestAcc);
            $adsAccount=$response->getDecodedBody();
        
    		$account =  array();
    		if(isset($adsAccount['data'][0]['id'])){
    		    for($i=0;$i < count($adsAccount['data']);$i++){
        		    $account[] = array(
        		            'userId' =>$userunique,
        		            'adsAccount'=>$adsAccount['data'][$i]['account_id'],
        		            'adsAccountName'=>$adsAccount['data'][$i]['name'],
        		          //  'buisnessId'    => $adsAccount['data'][$i]['business_id'],
        		            'status'=>'active'
        		    );
    		    }
    		   // echo '<pre>';print_r($account);die;
    		}  
    		
    		/* Fetch the User Fb Pages */
    	   
    		$requestAcc = $fb->request('GET',"/".$userid."/accounts?limit=100", $data=array(), $longtoken);
            $response = $fb->getClient()->sendRequest($requestAcc);
            $pages=$response->getDecodedBody();
    	              	 
    		$pageList =  array();
    		$instaAccounts =  array();
    		if(isset($pages['data'])){
    		for($l=0;$l < count($pages['data']);$l++){
    		    $pageList[] = array(
    		            'userId' =>$userunique,
    		            'pageAccessToken'=>$pages['data'][$l]['access_token'],
    		            'fbUserId' =>$userr->id,
    		            'pageCategory'=>$pages['data'][$l]['category'],
    		            'pageName' => $pages['data'][$l]['name'],
    		            'pageId' => $pages['data'][$l]['id']
    		  );
		}
    		}
    		
    		echo '<pre>'; print_r($pageList);die;
    		
    		/* Fetch the User Fb Campaigns */
    		$userCampaign = array();
    	    foreach($account as $accval){
        		$requestAcc = $fb->request('GET',"/act_".$accval['adsAccount']."/campaigns?fields=id,name,account_id,status&limit=100", $data=array(), $longtoken);
                $response = $fb->getClient()->sendRequest($requestAcc);
                $campaign=$response->getDecodedBody();
                 echo '<pre>';print_r($campaign);die;
                
                for($j=0;$j<=count($campaign);$j++){
                $userCampaign[] = array(
                            'userId'       =>$userunique,
        		            'campaignId'   =>$campaign['data'][$j]['id'],
        		            'campaignName' =>$campaign['data'][$j]['name'],
        		            'adsaccountId' =>$campaign['data'][$j]['account_id'],
        		            'status'       =>$campaign['data'][$j]['status'],
    		    );      
                }
                echo '<pre>'; print_r($userCampaign);die;
    	    }
    	    
    	    /* Fetch the User Fb adsets */
    	    
    	    $userAdsets = array();
    	    foreach($account as $accval){
        		$requestAcc = $fb->request('GET',"/act_".$accval['adsAccount']."/adsets?fields=id,name,account_id,campaign_id,status&limit=100", $data=array(), $longtoken);
                $response = $fb->getClient()->sendRequest($requestAcc);
                $adsets=$response->getDecodedBody();
                
                for($k=0;$k<=count($campaign);$k++){
                $userAdsets[] = array(
                            'userId'       =>$userunique,
        		            'adsetId'      =>$adsets['data'][$k]['id'],
        		            'adsetName'    =>$adsets['data'][$k]['name'],
        		            'campaignId'   =>$adsets['data'][$k]['campaign_id'],
        		            'adsaccountId' =>$adsets['data'][$k]['account_id'],
        		            'status'       =>$adsets['data'][$j]['status'],
    		    );      
                }
    	    }
    	    
    		
    	$fblogin=array(
			'userId' => $userunique,
			'accessToken' =>$longtoken,
			'fbUserId' =>$userr->id,
			'fbUserName' =>$userr->name,
			'status' =>1,
		);	
		
		Page::insert($pageList);
		Fbbuisness::insert($bussinessArr);
		Fbaccount::insert($account);    
		Fblogin::insert($fblogin);
		CampaignModel::insert($userCampaign);
		AdsetModel::insert($userAdsets);
		echo json_encode(1);exit;
    }

    public function store(Request $request)
	{
		$lead_data = $request->validate([
			'leadName'         => ['required','string', 'max:255'],
            'contact_number'   => ['required'],
            'leadStatus'       => ['required'],
        ], [
		    'leadName.required'          => 'Please Enter Lead Name',
            'contact_number.required'    => 'Please Enter Contact Number',
            'leadStatus.required'        => 'Please Select Lead Status',
        ]);	   
	    $unique_id = LeadsManagement::orderBy('id', 'desc')->first();
	    $number = str_replace('RGL', '', $unique_id ? $unique_id->unqiue_id  : 0);
	    if ($number == 0) {
	    $number = 'RGL0000001';
	    } else {
		$number = "RGL" . sprintf("%07d", (int)$number + 1);
	    }
		if($_POST['leadDate'] != NULL){
        $lead_data['unqiue_id']= $number;	   
        $lead_data['companyName']= $_POST['companyName'];	   
        $lead_data['leadLocation']= $_POST['leadLocation'];	   
        $lead_data['contactPerson']= $_POST['contactPerson'];	   
        $lead_data['notes']= $_POST['notes'];	   
        $lead_data['leadDate']= $_POST['leadDate'];	   
        $lead_data['leadTime']= $_POST['leadTime'];	   
        $lead_data['assignedTo']= $_POST['assignedTo'];	   
        $lead_data['leadAddedBy']= $_POST['leadAddedBy'];
		}
        else
		{
		$lead_data['unqiue_id']= $number;	   
        $lead_data['companyName']= $_POST['companyName'];	   
        $lead_data['leadLocation']= $_POST['leadLocation'];	   
        $lead_data['contactPerson']= $_POST['contactPerson'];	      
        $lead_data['assignedTo']= $_POST['assignedTo'];	   
        $lead_data['leadAddedBy']= $_POST['leadAddedBy'];
		}		
	    $data=LeadsManagement::insert($lead_data);
	    echo json_encode(['status' => 'success', 'message' => 'Lead Data Succesfully Submitted']);
	}
	
	public function viewLeadsDetails()
	{
		$result['data']=LeadsManagement::select('*')
                           ->where('id',$_GET['id'])
                           ->get();
        return view('LeadsManagement.viewLeadDetails',$result);
	}
	
	public function editLeadsDetails()
	{
		$result['status']= StatusMaster::get(); 
		$result['employee']= EmployeeManagement::where('status','Active')->get();
		$result['data']=LeadsManagement::where('id',$_GET['id'])
                           ->get();
        return view('LeadsManagement.editLeadDetails',$result);
	}
	
	public function saveEditLeadsDetails(Request $request)
	{
		$id= $request->id;
		$edit_Lead_data = $request->validate([
			'edit_leadName'         => ['required','string', 'max:255'],
            'edit_contact_number'   => ['required'],
            'edit_leadStatus'       => ['required'],
        ], [
		    'edit_leadName.required'          => 'Please Enter Lead Name',
            'edit_contact_number.required'    => 'Please Enter Contact Number',
            'edit_leadStatus.required'        => 'Please Select Lead Status',
        ]);
	  //echo '<pre>'; print_r($id);die;
		$leadArr=array(
		'leadName'           => $_POST['edit_leadName'],
        'companyName'        => $_POST['edit_companyName'],
        'contact_number'     => $_POST['edit_contact_number'],
        'contactPerson'      => $_POST['edit_contactPerson'],
        'leadLocation'       => $_POST['edit_leadLocation'],
        'leadStatus'         => $_POST['edit_leadStatus'],
        'assignedTo'         => $_POST['edit_assignedTo'],
        'leadStatus'         => $_POST['edit_leadStatus'],
	    'leadAddedBy'        => $_POST['edit_leadAddedBy'],
	    'leadDate'           => $_POST['edit_leadDate'],
	    'leadTime'           => $_POST['edit_leadTime'],
	    'notes'              => $_POST['edit_notes']
		);
		
		$data=LeadsManagement::where('id',$id)->update($leadArr);
		echo json_encode(['status' => 'success', 'message' => 'Leads Details Updated Successfully']);
	}
	
	public function deleteLeadsDetails()
	{
		$data=LeadsManagement::where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
	
	public function markToSales(Request $request)
	{
		$design_data = $request->validate([
			'designImage'         => ['required'],
        ], [
		    'designImage.required' => 'Please upload Design Image',
        ]);
		
		$str_time = time();
		if ($request->file('designImage')) {
            $file_type = $request->file('designImage')->extension();
            $file_path = $request->file('designImage')->storeAs('img/design', 'Design_' . $str_time . '.' . $file_type, 'public');
            $request->file('designImage')->move(public_path('img/design'), 'Design_' . $str_time . '.' . $file_type);
        } else {
            $file_path = null;
        }
	  //echo '<pre>'; print_r($id);die;
		$leadArr=array(
		'designImage'        => $file_path,
        'designerNotes'      => $_POST['designerNotes'],
		'moveToSales'        => 1,
		);
		
		$data=LeadsManagement::where('id',$_POST['designID'])->update($leadArr);
		echo json_encode(['status' => 'success', 'message' => 'Sales Added Successfully']);
	}
	
	public function salesList()
	{
		$data['sales']= LeadsManagement::where('moveToSales',1)->get();
		return view('LeadsManagement.salesList',$data);
	}
	
	public function edit_salesList()
	{
		$result['data']= LeadsManagement::where('id',$_GET['id'])->get();
		return view('LeadsManagement.editSalesList',$result);
	}
	
	public function save_edit_salesList(Request $request)
	{
		$id= $request->editDesignID;
		$str_time = time();
		if ($request->file('editDesignImage')) {
            $file_type = $request->file('editDesignImage')->extension();
            $file_path = $request->file('editDesignImage')->storeAs('img/design', 'Design_' . $str_time . '.' . $file_type, 'public');
            $request->file('editDesignImage')->move(public_path('img/design'), 'Design_' . $str_time . '.' . $file_type);
        } else {
            $file_path = $request->productPhoto;
        }
		//echo '<pre>';print_r($file_path);die;
		$arr=array(
		'designImage' => $file_path,
		'designerNotes' => $_POST['editDesignerNotes'],
		);
		
		$data= LeadsManagement::where('id', $id)->update($arr);
		echo json_encode(['status' => 'success', 'message' => 'Sales Updated Successfully']);
	}
	
	public function download_Design(){
		$file = LeadsManagement::where('id', $_GET['id'])->first();
		//echo '<pre>'; print_r($file);die;
        $pathofFile = $file->designImage;
        return response()->download($pathofFile);
	}
	
	public function websiteEmployeeData(Request $request)
	{
	    $arr = $request->all();
       //echo '<pre>';print_r($arr);die;
	    $data= array(
	        'name'   => $arr['name'],
	        'phone'  => $arr['phone'],
	        'email'  => $arr['email'],
	        'tellus' => $arr['tellus'],
	        );
	   $result= DB::table('website_leads')->insert($data);
	}
	
	public function showWebsiteLeads()
	{
	    $data['result']= DB::table('website_leads')->get();
	    return view('LeadsManagement.showWebsiteLeads',$data);
	}
	
	public function viewWebsiteLeads()
	{
        $result['data']= DB::table('website_leads')->select('*')->where('id', $_GET['id'])->get();
		return view('LeadsManagement.viewWebsiteLeads',$result);
	}
	
	public function getWebsiteLeadStatus()
	{
	    $result['update']= StatusMaster::get();
		$result['data']= DB::table('website_leads')->select('*')->where('id', $_GET['id'])->get();
		return view('LeadsManagement.updateStatus',$result);
	}
	
	public function updateWebsiteLeadStatus(Request $request)
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
		
		$data=DB::table('website_leads')->where('id',$_POST['updateStatusID'])->update($assignArr);
		echo json_encode(['status' => 'success', 'message' => 'Status Updated Successfully']);
	}
	
	public function deleteWebsiteLead()
	{
	    	$data=DB::table('website_leads')->where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted Successfully']);
	}
	
	public function feedbackDetails()
	{
	    $data['result']= DB::table('feedbacks')->select('feedbacks.*','appEmployerUsers.*','feedbacks.id as feedbackID')
	                        ->join('appEmployerUsers','appEmployerUsers.unique_id','=','feedbacks.userID')
	                        ->get();
	   //echo '<pre>';print_r($data);die;
	   return view('LeadsManagement.feedback',$data);
	}
	
	public function viewFeedbackDetails()
	{
		$result['data']= DB::table('feedbacks')->select('feedbacks.*','appEmployerUsers.*','feedbacks.id as feedbackID')
	                        ->join('appEmployerUsers','appEmployerUsers.unique_id','=','feedbacks.userID')
	                        ->where('feedbacks.id', $_GET['id'])
	                        ->get();
	   //echo '<pre>';print_r($result);die;
		return view('LeadsManagement.viewFeedback',$result);
	}
	
	public function deleteFeedbackDetails()
	{
	    $result['data']= DB::table('feedbacks')->select('feedbacks.*','appEmployerUsers.*','feedbacks.id as feedbackID')
	                        ->join('appEmployerUsers','appEmployerUsers.unique_id','=','feedbacks.userID')
	                        ->where('feedbacks.id', $_POST['id'])
	                        ->delete();
	}
}
