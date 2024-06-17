<?php
namespace App\Helper;
use Session;
use DB;
use App\Models\TaskManagement;
use App\Models\EmployeeManagement;

class AppHelper {

public static function getIndividualCount($empID)
    {
        //echo '<pre>'; print_r($driverID);
         $data['individual'] = TaskManagement::where('staffName', $empID)->get()->count();
         //echo '<pre>'; print_r($data['individual']);
         return $data;
    }

public static function getCompletedCount()
    {
        //echo '<pre>'; print_r($driverID);
         $data['comp'] = TaskManagement::where('Status', 'Completed')->get()->count();
         //echo '<pre>'; print_r($data['individual']);
         return $data;
    }
    
public static function getPendingCount()
    {
        //echo '<pre>'; print_r($driverID);
         $data['pend'] = TaskManagement::where('Status', 'Pending')->get()->count();
         //echo '<pre>'; print_r($data['individual']);
         return $data;
    }
    
    public static function getAppDetails()
  {
      $result = DB::table('fbappdetails')->select('*')->get();
      return $result;
  }
      
  public static function randomNum()
  {
      $length =5;
      $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	  $randomString1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	  return $randomString.$randomString1;
  }
  
}
?>