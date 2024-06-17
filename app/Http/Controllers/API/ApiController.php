<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Mail\SendMail;
use App\Models\JobManagement;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

 
class ApiController extends Controller
{
   var $responseCode = 200;
  var $error = 400;
  var $url = 'https://recruitment.peopleschoice.co.in/public/';

  public function employerSignUp(Request $request)
    {
       $companyName= $request->input('companyName'); 
       $emailAddress= $request->input('emailAddress'); 
       $userType= $request->input('userType'); 
       $contactNumber= $request->input('contactNumber');
       $otpNumber = rand(100,100000);
       $employeeName= $request->input('employeeName');
       $password= $request->input('password');
       if($userType == 'Employeer')
	   {
	       $unique_id = db::table('appEmployerUsers')->orderBy('id', 'desc')->first();
           $number = str_replace('RTU', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) 
           {
                $number = 'RTU0000001';
           } 
           else 
           {
        	   $number = "RTU" . sprintf("%07d", (int)$number + 1);
           } 
           
           $employer_data= array(
		   'unique_id'       => $number,
		   'companyName'     => $companyName,
		   'contactNumber'   => $contactNumber,
		   'emailAddress'    => $emailAddress,
		   'userType'        => $userType,
		   'password'        => md5($password),
		   );
		   
		   $otpDetails= array(
		   'unique_id'      => $number,
		   'emailAddress'   => $emailAddress,
		   'otpNumber'      => $otpNumber,
		   );
		   
		   $emailEmployeer= DB::table('appEmployerUsers')->where('emailAddress', $emailAddress)->where('otpDone',1)->get();
//echo '<pre>';print_r($emailEmployeer);die;
		   if(!count($emailEmployeer)){
		       $data= DB::table('appEmployerUsers')->insert($employer_data); 
		     $emailCheck= DB::table('otpDetails')->where('emailAddress', $emailAddress)->get();
		    // echo '<pre>'; print_r($emailCheck);die;
        	   if(!count($emailCheck)){
        	       $data= DB::table('otpDetails')->insert($otpDetails);
        	   }
        	   else{
        	   $data= DB::table('otpDetails')->update(['otpNumber' => $otpNumber]); 
        	   }
        	   $details = [
                    'title' => 'Mail From R&T Recuritment',
                    'body' =>  'Your One Time OTP For Registeration Is'.''.$otpNumber,
                ];
                $x = 'Your One Time OTP For Registeration Is'.''.$otpNumber;
                mail($emailAddress, 'OTP Number',$x,'Message From R&T Recuritment Company');
               // \Mail::to($emailAddress)->send(new SendMail($details));
                return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'OTP Sent Successfully',
                //'user'=> $user, 
            ]);
		   }
		   else{
		   return response()->json([
                'responsecode'=>$this->error,
                'message'=>'Email Address Already Registered',
                //'user'=> $user, 
            ]);
		   }
	   }
	   
	   if($userType == 'Employee')
	   {
	       $unique_id = db::table('appEmployerUsers')->orderBy('id', 'desc')->first();
           $number = str_replace('RTU', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) 
           {
                $number = 'RTU0000001';
           } 
           else 
           {
        	   $number = "RTU" . sprintf("%07d", (int)$number + 1);
           } 
           
           $employer_data= array(
		   'unique_id'       => $number,
		   'employeeName'     => $employeeName,
		   'contactNumber'   => $contactNumber,
		   'emailAddress'    => $emailAddress,
		   'userType'        => $userType,
		   'password'        => md5($password),
		   );
		   
		   $otpDetails= array(
		   'unique_id'      => $number,
		   'emailAddress'   => $emailAddress,
		   'otpNumber'      => $otpNumber,
		   );
		   
		   $emailEmployeer= DB::table('appEmployerUsers')->where('emailAddress', $emailAddress)->where('otpDone',1)->get();
		   if(!count($emailEmployeer)){
		       $data= DB::table('appEmployerUsers')->insert($employer_data); 
		     $emailCheck= DB::table('otpDetails')->where('emailAddress', $emailAddress)->get();
		    // echo '<pre>'; print_r($emailCheck);die;
        	   if(!count($emailCheck)){
        	       $data= DB::table('otpDetails')->insert($otpDetails);
        	   }
        	   else{
        	   $data= DB::table('otpDetails')->update(['otpNumber' => $otpNumber]); 
        	   }
        	   $details = [
                    'title' => 'Mail From R&T Recuritment',
                    'body' =>  'Your One Time OTP For Registeration Is'.''.$otpNumber,
                ];
                $x = 'Your One Time OTP For Registeration Is'.''.$otpNumber;
                mail($emailAddress, 'OTP Number',$x,'Message From R&T Recuritment Company');
               // \Mail::to($emailAddress)->send(new SendMail($details));
                return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'OTP Sent Successfully',
                //'user'=> $user, 
            ]);
		   }
		   else{
		   return response()->json([
                'responsecode'=>$this->error,
                'message'=>'Email Address Already Registered',
                //'user'=> $user, 
            ]);
		   }
	   }
    }
    
    public function checkOTP(Request $request)
    {
       $otp= $request->input('otpNumber'); 
       $emailAddress= $request->input('emailAddress');
       
       $check= DB::table('otpDetails')->where('emailAddress', $emailAddress)->where('otpNumber', $otp)->get();
       if(!count($check)){
           return response()->json([
                'responsecode'=>$this->error,
                'message'=>'OTP You Have Entered Is Incorrect Or Not Valid',
                //'user'=> $user, 
            ]);
       }
       else{
           $data= DB::table('otpDetails')->where('emailAddress', $emailAddress)->where('otpNumber', $otp)->delete();
           $data= DB::table('appEmployerUsers')->where('emailAddress', $emailAddress)->update(['otpDone' => 1]);
           $user= DB::table('appEmployerUsers')->where('emailAddress', $emailAddress)->where('otpDone', 1)->get();
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'OTP verified Successfully',
                'user'=> $user, 
            ]);
       }
    }
    
   public function login(Request $request)
   {
       $validatedData = $request->validate([ 
            'email'=>['required'],
            'password'=>['required'],
        ]);
        $user = DB::table('appEmployerUsers')->select('*')->where('emailAddress',$validatedData['email'])->where('password',md5($validatedData['password']))->where('otpDone',1)->get();
         if(!count($user)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'user not found',
                'user'=> $user, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'user found',
                'user'=> $user, 
            ]);
        }
   }
   
   public function forgotPassword(Request $request)
   {
        $emailAddress= $request->input('emailAddress'); 
        $user = DB::table('appEmployerUsers')->select('*')->where('emailAddress',$emailAddress)->get();
         if(!count($user)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'Enter your Registered Email Address',
                'user'=> $user, 
            ]);
        } else {
             $details = [
                    'title' => 'Mail From R&T Recuritment',
                    'body' =>  url('/resetPassword?email_id=' . $emailAddress),
                ];
                $x = 'Please Click on the mentioned Link For Reset Your Password'.''.url('/resetPassword?email_id=' . $emailAddress);
                mail($emailAddress, 'Reset Password',$x,'Message From R&T Recuritment Company');
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Link Has Been Sent To Your Registered Address',
                //'user'=> $user, 
            ]);
        }
   }
   
   public function getJobs()
   {
       $data= JobManagement::where('status','Active')->get();
       foreach($data as $result)
       {
           $currentDate= date('Y-m-d');
           $lastDate= $result->postedDate;
           $start = strtotime($currentDate);
	       $end = strtotime($lastDate);
		   $days = ceil(abs($end - $start) / 86400);
           $arr[]= array(
            'jobTitle' => $result->jobTitle,
            'Experience'=> $result->experience,
            'salary' =>  $result->salary,
            'Posted' =>  $days.''.''.'Days Ago',
            'openPosition' => $result->vacancy,
            'id' => $result->id,
             );
       }
       if(!count($data)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'No Job Posted Yet',
                //'user'=> $data, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Job Details',
                'job Details'=> $arr, 
            ]);
        }
   }
   
   public function jobDetails(Request $request)
   {
        $id= $request->input('id'); 
        $data= JobManagement::where('status','Active')->where('id',$id)->get();
        if(!count($data)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'No Detail Found',
                //'user'=> $data, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Job Detail',
                'job Details'=> $data, 
            ]);
        }
   }
   
   public function addDescriptionDetails(Request $request)
   {
       $userID= $request->input('unique_id');
       $description= $request->input('description');
      // $addedDate= $request->input('descriptionAddedDate');
       $unique_id = db::table('job_description')->orderBy('id', 'desc')->first();
           $number = str_replace('RTJD', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) 
           {
                $number = 'RTJD0000001';
           } 
           else 
           {
        	   $number = "RTJD" . sprintf("%07d", (int)$number + 1);
           } 
           $details= DB::table('appEmployerUsers')->where('unique_id', $userID)->get();
           $description_data= array(
		   'unique_id'             => $number,
		   'userID'                => $userID,
		   'job_description'       => $description,
		   'descriptionAddedDate'  => date('Y-m-d'),
		   'userType'              => $details[0]->userType,
		   );
		    $data= DB::table('job_description')->insert($description_data);
		    //echo '<pre>';print_r($data);die;
		    if($data >= 1)
		    {
		        return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Enquiry Submitted Successfully,Will Contact You Soon',
               // 'job Details'=> $data, 
            ]);
		    }
		    else{
		           return response()->json([
                'responsecode'=>$this->error,
                'message'=>'Error While Adding Enquiry',
               // 'job Details'=> $data, 
            ]);
		    }
   }
   
   public function applyJob(Request $request)
   {
      $userID= $request->input('unique_id');
      $jobID= $request->input('id');
      // $addedDate= $request->input('descriptionAddedDate');
       $unique_id = db::table('job_description')->orderBy('id', 'desc')->first();
           $number = str_replace('RTJD', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) 
           {
                $number = 'RTJD0000001';
           } 
           else 
           {
        	   $number = "RTJD" . sprintf("%07d", (int)$number + 1);
           } 
           $details= DB::table('appEmployerUsers')->where('unique_id', $userID)->get();
           $jobDetails= JobManagement::where('id',$jobID)->get();
           //echo '<pre>';print_r($jobDetails);die;
           $description_data= array(
		   'unique_id'             => $number,
		   'userID'                => $userID,
		   'job_description'       => 'Want To Apply For'.''.$jobDetails[0]->jobTitle,
		   'descriptionAddedDate'  => date('Y-m-d'),
		   'userType'              => $details[0]->userType,
		   );
		    $data= DB::table('job_description')->insert($description_data);
		    //echo '<pre>';print_r($data);die;
		    if($data >= 1)
		    {
		        return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Enquiry Submitted Successfully,Will Contact You Soon',
               // 'job Details'=> $data, 
            ]);
		    }
		    else{
		           return response()->json([
                'responsecode'=>$this->error,
                'message'=>'Error While Adding Enquiry',
               // 'job Details'=> $data, 
            ]);
		    } 
   }
   
   public function termsandconditions()
   {
       $data= DB::table('abouts')->where('titleName','Terms And Conditions')->get();
       if(!count($data)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'No Detail Found',
                //'user'=> $data, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Terms And Conditions',
                'TermsConditions Details'=> $data, 
            ]);
        }
   }
   
   public function aboutCompany()
   {
       $data= DB::table('abouts')->where('titleName','About Company')->get();
       if(!count($data)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'No Detail Found',
                //'user'=> $data, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'About Company',
                'Company Details'=> $data, 
            ]);
        }
   }
   
   public function companyAim()
   {
       $data= DB::table('abouts')->where('titleName','Our Aim')->get();
       if(!count($data)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'No Detail Found',
                //'user'=> $data, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Our Aim',
                'Aim Details'=> $data, 
            ]);
        }
   } 
   
   public function companyStrength()
   {
       $data= DB::table('abouts')->where('titleName','Our Strength')->get();
       if(!count($data)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'No Detail Found',
                //'user'=> $data, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Our Strength',
                'Strength Details'=> $data, 
            ]);
        }
   } 

   public function employerTestimonial()
   {
       $data= DB::table('abouts')->where('titleName',"Employer's Testimonial")->get();
       if(!count($data)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'No Detail Found',
                //'user'=> $data, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Employer Testimonial',
                'Testimonial Details'=> $data, 
            ]);
        }
   }
   
    public function employeeTestimonial()
   {
       $data= DB::table('abouts')->where('titleName',"Employee's Testimonial")->get();
       if(!count($data)){     
            return response()->json([
                'responsecode'=>$this->error,
                'message'=>'No Detail Found',
                //'user'=> $data, 
            ]);
        } else {
            return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Employee Testimonial',
                'Testimonial Details'=> $data, 
            ]);
        }
   }
   
   public function addemployeeEnquiryDetails(Request $request)
   {
       $userID= $request->input('unique_id');
       $age= $request->input('age');
       $name= $request->input('name');
       $gender= $request->input('gender');
       $workExperience= $request->input('workExperience');
       $desiredsalary= $request->input('desiredsalary');
       $location= $request->input('location');
       $jobPosition= $request->input('jobPosition');
       $residing= $request->input('residing');
       $education= $request->input('education');
       $unique_id = db::table('employee_enquiry_details')->orderBy('id', 'desc')->first();
           $number = str_replace('RTEE', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) 
           {
                $number = 'RTEE0000001';
           } 
           else 
           {
        	   $number = "RTEE" . sprintf("%07d", (int)$number + 1);
           } 
           $details= DB::table('appEmployerUsers')->where('unique_id', $userID)->get();
           $employeeEnquiry_data= array(
		   'unique_id'             => $number,
		   'userID'                => $userID,
		   'name'                  => $name,
		   'age'                   => $age,
		   'gender'                => $gender,
		   'workExperience'        => $workExperience,
		   'desiredsalary'         => $desiredsalary,
		   'location'              => $location,
		   'jobPosition'           => $jobPosition,
		   'residing'              => $residing,
		   'education'             => $education,
		   'enquiryAddedDate'      => date('Y-m-d'),
		   'userType'              => $details[0]->userType,
		   );
		    $data= DB::table('employee_enquiry_details')->insert($employeeEnquiry_data);
		    //echo '<pre>';print_r($data);die;
		    if($data >= 1)
		    {
		        return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Enquiry Submitted Successfully,Will Contact You Soon',
               // 'job Details'=> $data, 
            ]);
		    }
		    else{
		           return response()->json([
                'responsecode'=>$this->error,
                'message'=>'Error While Adding Enquiry',
               // 'job Details'=> $data, 
            ]);
		    }
   }
   
   public function addemployerEnquiryDetails(Request $request)
   {
       $userID= $request->input('unique_id');
       $companyName= $request->input('companyName');
       $uem= $request->input('uem');
       $telephoneNumber= $request->input('telephoneNumber');
       $emailAddress= $request->input('emailAddress');
       $pic= $request->input('pic');
       $position= $request->input('position');
       $gender= $request->input('gender');
       $age= $request->input('age');
       $salary= $request->input('salary');
       $grossSalary= $request->input('grossSalary');
       $skills= $request->input('skills');
       $workingPlace= $request->input('workingPlace');
       $companyAddress= $request->input('companyAddress');
       $unique_id = db::table('employer_enquiry_details')->orderBy('id', 'desc')->first();
           $number = str_replace('RTEE', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) 
           {
                $number = 'RTEE0000001';
           } 
           else 
           {
        	   $number = "RTEE" . sprintf("%07d", (int)$number + 1);
           } 
           $details= DB::table('appEmployerUsers')->where('unique_id', $userID)->get();
           $employerEnquiry_data= array(
		   'unique_id'             => $number,
		   'userID'                => $userID,
		   'companyName'           => $companyName,
		   'age'                   => $age,
		   'gender'                => $gender,
		   'uem'                   => $uem,
		   'telephoneNumber'       => $telephoneNumber,
		   'emailAddress'          => $emailAddress,
		   'pic'                   => $pic,
		   'position'              => $position,
		   'salary'                => $salary,
		   'grossSalary'           => $grossSalary,
		   'skills'                => $skills,
		   'workingPlace'          => $workingPlace,
		   'companyAddress'        => $companyAddress,
		   'enquiryAddedDate'      => date('Y-m-d'),
		   'userType'              => $details[0]->userType,
		   );
		   //echo '<pre>';print_r($employerEnquiry_data);die;
		    $data= DB::table('employer_enquiry_details')->insert($employerEnquiry_data);
		    if($data >= 1)
		    {
		        return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Enquiry Submitted Successfully,Will Contact You Soon',
               // 'job Details'=> $data, 
            ]);
		    }
		    else{
		           return response()->json([
                'responsecode'=>$this->error,
                'message'=>'Error While Adding Enquiry',
               // 'job Details'=> $data, 
            ]);
		    }
   }
   
   public function userFeedbackDetails(Request $request)
   {
       $userID= $request->input('unique_id');
       $feedback= $request->input('feedback');
      // $addedDate= $request->input('descriptionAddedDate');
       $unique_id = db::table('feedbacks')->orderBy('id', 'desc')->first();
           $number = str_replace('RTFB', '', $unique_id ? $unique_id->unique_id  : 0);
           if ($number == 0) 
           {
                $number = 'RTFB0000001';
           } 
           else 
           {
        	   $number = "RTFB" . sprintf("%07d", (int)$number + 1);
           } 
           $details= DB::table('appEmployerUsers')->where('unique_id', $userID)->get();
           $feedback_data= array(
		   'unique_id'             => $number,
		   'userID'                => $userID,
		   'feedback'              => $feedback,
		   'feedbackAddedDate'  => date('Y-m-d'),
		   'userType'              => $details[0]->userType,
		   );
		    $data= DB::table('feedbacks')->insert($feedback_data);
		    //echo '<pre>';print_r($data);die;
		    if($data >= 1)
		    {
		        return response()->json([
                'responsecode'=>$this->responseCode,
                'message'=>'Thanks For Submitted Your Feedback',
               // 'job Details'=> $data, 
            ]);
		    }
		    else{
		           return response()->json([
                'responsecode'=>$this->error,
                'message'=>'Error While Adding Feedback',
               // 'job Details'=> $data, 
            ]);
		    }
   }
   
}
