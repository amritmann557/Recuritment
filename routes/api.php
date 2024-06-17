<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/employerSignUp',[ApiController::class, 'employerSignUp']);
Route::get('/checkOTP',[ApiController::class, 'checkOTP']);
Route::post('/login',[ApiController::class, 'login']);
Route::get('/forgotPassword',[ApiController::class, 'forgotPassword']);
Route::get('/getJobs',[ApiController::class, 'getJobs']);
Route::post('/addDescriptionDetails',[ApiController::class, 'addDescriptionDetails']);
Route::any('/jobDetails',[ApiController::class, 'jobDetails']);
Route::any('/termsandconditions',[ApiController::class, 'termsandconditions']);
Route::any('/aboutCompany',[ApiController::class, 'aboutCompany']);
Route::any('/companyAim',[ApiController::class, 'companyAim']);
Route::any('/companyStrength',[ApiController::class, 'companyStrength']);
Route::any('/employerTestimonial',[ApiController::class, 'employerTestimonial']);
Route::any('/employeeTestimonial',[ApiController::class, 'employeeTestimonial']);
Route::any('/applyJob',[ApiController::class, 'applyJob']);
Route::any('/addemployeeEnquiryDetails',[ApiController::class, 'addemployeeEnquiryDetails']);
Route::any('/addemployerEnquiryDetails',[ApiController::class, 'addemployerEnquiryDetails']);
Route::any('/userFeedbackDetails',[ApiController::class, 'userFeedbackDetails']);


