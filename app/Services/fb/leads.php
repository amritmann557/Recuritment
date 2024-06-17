<?php
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
ini_set('display_errors', 1);
error_reporting(E_ALL);
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use FacebookAds\Object\Fields\AdReportRunFields;
require_once __DIR__ . '/bootstrap.php';


$subscribedApps = [];
$body = [];
$error = null;

$fb = new Facebook([
    'app_id'                => $fb_app_id,
    'app_secret'            => $fb_app_secret,
    'default_graph_version' => $fb_api_version,
]);

$access_token=$fb_access_token;
$request = $fb->request('GET', $ad_id."/leads?fields=campaign_id,campaign_name,form_id,adset_name,ad_name,created_time,field_data", $data, $access_token);
    //print_r($request);die;
	$response = $fb->getClient()->sendRequest($request);
$ad_id=$_GET['ad_id'];
$time_from = (new \DateTime("-4 day"))->getTimestamp();
echo $arr = json_encode(array(
    "field" => "time_created",
    "operator" => "GREATER_THAN",
    "value" => $time_from
));
$data = ['filtering'=>array($arr)];

    /* get page access token */
    //error_log("My access token: {$_SESSION['fb_access_token']}");
    $request = $fb->request('GET', $ad_id."/leads?fields=campaign_id,campaign_name,form_id,adset_name,ad_name,created_time,field_data", $data, $access_token);
    //print_r($request);die;
	$response = $fb->getClient()->sendRequest($request);

 

$results=$response->getDecodedBody();

//echo '<pre>';print_r($results);die;
//For Loop to fetch all leads
$api_token = "b7b5f1c71015e6a3e8e7468c8015b2fb4d909227";
foreach ($results['data'] as $fresults)
{
	foreach ($fresults['field_data'] as $finals)
	{
		if($finals['name']=='full_name')
		{ $name=$finals['values'][0]; }
		if($finals['name']=='email')
		{ $email=$finals['values'][0]; }
		if($finals['name']=='mobile')
		{ $phone=$finals['values'][0]; }
		if($finals['name']=='your_current_education_level')
		{ $education=$finals['values'][0]; }
		if($finals['name']=='preferred_contact_method_')
		{ $contactMethod=$finals['values'][0]; }
	}
	$currDate=date("Y-m-d");
	
	//if(stristr($fresults['created_time'], $currDate))       /** Uncomment this if statement if you want leads only for the same day/date.
	//{

	echo "Created Time : ".$fresults['created_time']."</br>";
	echo "Customer Name : ".$name."</br>";
	echo "Customer Email : ".$email."</br>";;
	echo "Customer Phone : ".$phone."</br>";
	echo "Education Level : ".$education."</br>";
	echo "Contact Method : ".$contactMethod."</br>";
	echo "Campaign Name : ".$fresults['campaign_name']."</br>";
	echo "Ad Name : ".$fresults['ad_name']."</br>";
	echo "Form Id : ".$fresults['form_id']."</br>";
	echo "Campaign Id : ".$fresults['campaign_id']."</br>";
	echo '-----------------------------'."</br>";
	echo '-----------------------------'."</br>";
  
	//}
	
	$person = array(
					'name' =>$name,
					'email' =>$email,
					'phone' => $phone
				);
				$person_id = create_person($api_token, $person);
				//print_r($person_id);
				if ($person_id) {
					$deal = array(
						'title' => $fresults['campaign_name'].'('.$fresults['ad_name'].') - '.$name,
						'value' => '0.00',
						'person_id' => $person_id['personId'],
						'87d8bb984ffb14bc9ac0b65f3f94b107a8018b31'=>$fresults['campaign_id'],
						'99f5acb646d2db201b568fdfabf2b2de545ce016'=>$fresults['ad_name'],
						'0806c596ef61d551f6d6a65751836bdca3da3c99'=>$fresults['campaign_name'],
						'e52f78251748abbaab42fafbf52981abfa9c3581'=>$contactMethod,
						'a169dd15d781b5d2c0964a4b21adcce3b7071fe8'=>$education,
					);
					$deal_id = create_deal($api_token, $deal);
					if($deal_id){
						echo 'done';
					}
				}

}

/* Pipedrive Api Functions */
	 function create_deal($api_token, $deal)
		 {
			 $url = "https://api.pipedrive.com/v1/deals?api_token=" . $api_token;

			 $ch = curl_init();
			 curl_setopt($ch, CURLOPT_URL, $url);
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			 curl_setopt($ch, CURLOPT_POST, true);

			 curl_setopt($ch, CURLOPT_POSTFIELDS, $deal);
			 $output = curl_exec($ch);
			 $info = curl_getinfo($ch);
			 curl_close($ch);

			 // create an array from the data that is sent back from the API
			 $result = json_decode($output, 1);
			//echo '<pre>';print_r($result);
			 // check if an id came back
			 if (!empty($result['data']['id'])) {
			 $deal_id = $result['data']['id'];
			 return $deal_id;
			 } else {
			 return false;
			 }
		 }

		function create_person($api_token, $person)
			{
				 $url = "https://api.pipedrive.com/v1/persons?api_token=" . $api_token;

				 $ch = curl_init();
				 curl_setopt($ch, CURLOPT_URL, $url);
				 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				 curl_setopt($ch, CURLOPT_POST, true);

				 curl_setopt($ch, CURLOPT_POSTFIELDS, $person);
				 $output = curl_exec($ch);
				 $info = curl_getinfo($ch);
				 curl_close($ch);

				 // create an array from the data that is sent back from the API
				 $result = json_decode($output, 1);
				 echo '<pre>';print_r($result);
				 // check if an id came back
				 if (!empty($result['data']['id'])) {
				   $person_id['personId'] = $result['data']['id'];
				   $person_id['ownerId'] = $result['data']['owner_id']['id'];
				 return $person_id;
				 } else {
				 return false;
				 }
		}
?>





