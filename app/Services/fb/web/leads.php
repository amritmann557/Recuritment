<?php
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

require_once __DIR__ . '/../bootstrap.php';


$subscribedApps = [];
$body = [];
$error = null;

$fb = new Facebook([
    'app_id'                => $fb_app_id,
    'app_secret'            => $fb_app_secret,
    'default_graph_version' => $fb_api_version,
]);

$access_token=$fb_access_token;
$ad_id=$_GET['ad_id'];

    /* get page access token */
    //error_log("My access token: {$_SESSION['fb_access_token']}");
    $request = $fb->request('GET', "ads/lead_gen/export_csv?type=form&id=177612226221994", [], $access_token);
    $response = $fb->getClient()->sendRequest($request);

 

$results=$response->getDecodedBody();

//echo '<pre>';print_r($results);die;
//For Loop to fetch all leads

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

}

?>





