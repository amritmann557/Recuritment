<?php
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 
 class WebsiteDataController extends Controller
 {
    
    public function readData(Request $request){
        $arr = $request->all();
        echo '<pre>';print_r($arr);die;
    }
 }
?>