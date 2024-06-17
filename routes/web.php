<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\LeadsManagementController;
use App\Http\Controllers\StatusMasterController;
use App\Http\Controllers\QuotationManagementController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\TaskManagementController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EmployerEnquiryController;
use App\Http\Controllers\EmployeeEnquiryController;
use App\Http\Controllers\JobManagementController;
use App\Http\Controllers\WebsiteDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/websiteEmployeeData', [App\Http\Controllers\LeadsManagementController::class, 'websiteEmployeeData'])->name('websiteEmployeeData');
Route::any('/', function () {
    return view('auth.login');
});



Auth::routes();

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('employee', EmployeeManagementController::class)->names([
        'index' => 'ProfileManagement.employee',
        'create' => 'ProfileManagement.create',
		'store' => 'ProfileManagement.store',
    ]);
Route::any('/checkEmail', [App\Http\Controllers\EmployeeManagementController::class, 'checkEmail'])->name('checkEmail');	
Route::any('/viewEmployeeDetails', [App\Http\Controllers\EmployeeManagementController::class, 'viewEmployeeDetails'])->name('viewEmployeeDetails');	
Route::any('/editEmployeeDetails', [App\Http\Controllers\EmployeeManagementController::class, 'editEmployeeDetails'])->name('editEmployeeDetails');	
Route::any('/saveEditEmployeeDetails', [App\Http\Controllers\EmployeeManagementController::class, 'saveEditEmployeeDetails'])->name('saveEditEmployeeDetails');	
Route::any('/deleteEmployeeDetails', [App\Http\Controllers\EmployeeManagementController::class, 'deleteEmployeeDetails'])->name('deleteEmployeeDetails');	
Route::any('/viewProfileDetails', [App\Http\Controllers\EmployeeManagementController::class, 'viewProfileDetails'])->name('viewProfileDetails');
Route::any('/getAppEmployerUsers', [App\Http\Controllers\EmployeeManagementController::class, 'getAppEmployerUsers'])->name('getAppEmployerUsers');
Route::any('/getAppEmployeeUsers', [App\Http\Controllers\EmployeeManagementController::class, 'getAppEmployeeUsers'])->name('getAppEmployeeUsers');
Route::any('/resetPassword',[App\Http\Controllers\EmployeeManagementController::class, 'resetPassword']);
Route::any('/saveResetPassword',[App\Http\Controllers\EmployeeManagementController::class, 'saveResetPassword']);

Route::resource('leadsManagement', LeadsManagementController::class)->names([
        'index' => 'LeadsManagement.leads',
        'create' => 'LeadsManagement.create',
		'store' => 'LeadsManagement.leadsstore',
    ]);	
Route::any('/viewLeadsDetails', [App\Http\Controllers\LeadsManagementController::class, 'viewLeadsDetails'])->name('viewLeadsDetails');
Route::any('/editLeadsDetails', [App\Http\Controllers\LeadsManagementController::class, 'editLeadsDetails'])->name('editLeadsDetails');
Route::any('/saveEditLeadsDetails', [App\Http\Controllers\LeadsManagementController::class, 'saveEditLeadsDetails'])->name('saveEditLeadsDetails');
Route::any('/deleteLeadsDetails', [App\Http\Controllers\LeadsManagementController::class, 'deleteLeadsDetails'])->name('deleteLeadsDetails');
Route::any('/markToSales', [App\Http\Controllers\LeadsManagementController::class, 'markToSales'])->name('markToSales');
Route::any('/salesList', [App\Http\Controllers\LeadsManagementController::class, 'salesList'])->name('salesList');
Route::any('/edit_salesList', [App\Http\Controllers\LeadsManagementController::class, 'edit_salesList'])->name('edit_salesList');
Route::any('/save_edit_salesList', [App\Http\Controllers\LeadsManagementController::class, 'save_edit_salesList'])->name('save_edit_salesList');
Route::any('/download_Design', [App\Http\Controllers\LeadsManagementController::class, 'download_Design'])->name('download_Design');
Route::any('/callback', [App\Http\Controllers\LeadsManagementController::class, 'callback'])->name('callback');
Route::any('/showWebsiteLeads', [App\Http\Controllers\LeadsManagementController::class, 'showWebsiteLeads'])->name('showWebsiteLeads');
Route::any('/viewWebsiteLeads', [App\Http\Controllers\LeadsManagementController::class, 'viewWebsiteLeads'])->name('viewWebsiteLeads');
Route::any('/getWebsiteLeadStatus', [App\Http\Controllers\LeadsManagementController::class, 'getWebsiteLeadStatus'])->name('getWebsiteLeadStatus');
Route::any('/updateWebsiteLeadStatus', [App\Http\Controllers\LeadsManagementController::class, 'updateWebsiteLeadStatus'])->name('updateWebsiteLeadStatus');
Route::any('/deleteWebsiteLead', [App\Http\Controllers\LeadsManagementController::class, 'deleteWebsiteLead'])->name('deleteWebsiteLead');
Route::any('/feedbackDetails', [App\Http\Controllers\LeadsManagementController::class, 'feedbackDetails'])->name('feedbackDetails');
Route::any('/viewFeedbackDetails', [App\Http\Controllers\LeadsManagementController::class, 'viewFeedbackDetails'])->name('viewFeedbackDetails');
Route::any('/deleteFeedbackDetails', [App\Http\Controllers\LeadsManagementController::class, 'deleteFeedbackDetails'])->name('deleteFeedbackDetails');



Route::resource('QuotationManagement', QuotationManagementController::class)->names([
        'index' => 'QuotationManagement.quotation',
        'create' => 'QuotationManagement.create',
		'store' => 'QuotationManagement.quotationstore',
    ]);
Route::any('/viewQuotationDetails', [App\Http\Controllers\QuotationManagementController::class, 'viewQuotationDetails'])->name('viewQuotationDetails');
Route::any('/editQuotationDetails', [App\Http\Controllers\QuotationManagementController::class, 'editQuotationDetails'])->name('editQuotationDetails');
Route::any('/save_editQuotationDetails', [App\Http\Controllers\QuotationManagementController::class, 'save_editQuotationDetails'])->name('save_editQuotationDetails');
Route::any('/deleteQuotationDetails', [App\Http\Controllers\QuotationManagementController::class, 'deleteQuotationDetails'])->name('deleteQuotationDetails');
Route::any('/downloadQuotation', [App\Http\Controllers\QuotationManagementController::class, 'downloadQuotation'])->name('downloadQuotation');

Route::resource('salesOrder', SalesOrderController::class)->names([
        'index' => 'WorkOrder.workOrder',
        'create' => 'WorkOrder.create',
		'store' => 'WorkOrder.workOrderstore',
    ]);
Route::any('/viewSalesOrder', [App\Http\Controllers\SalesOrderController::class, 'viewSalesOrder'])->name('viewSalesOrder');
Route::any('/editSalesOrder', [App\Http\Controllers\SalesOrderController::class, 'editSalesOrder'])->name('editSalesOrder');
Route::any('/save_editSalesOrder', [App\Http\Controllers\SalesOrderController::class, 'save_editSalesOrder'])->name('save_editSalesOrder');
Route::any('/deletework', [App\Http\Controllers\SalesOrderController::class, 'deletework'])->name('deletework');
Route::any('/deleteworkOrderDetails', [App\Http\Controllers\SalesOrderController::class, 'deleteworkOrderDetails'])->name('deleteworkOrderDetails');
Route::any('/printworkOrderDetails', [App\Http\Controllers\SalesOrderController::class, 'printworkOrderDetails'])->name('printworkOrderDetails');

Route::resource('TaskList', TaskManagementController::class)->names([
        'index' => 'TaskManagement.task',
        'create' => 'TaskManagement.create',
		'store' => 'TaskManagement.taskstore',
    ]);
Route::any('/editTaskDetails', [App\Http\Controllers\TaskManagementController::class, 'editTaskDetails'])->name('editTaskDetails');
Route::any('/save_editTaskDetails', [App\Http\Controllers\TaskManagementController::class, 'save_editTaskDetails'])->name('save_editTaskDetails');
Route::any('/deleteTaskDetails', [App\Http\Controllers\TaskManagementController::class, 'deleteTaskDetails'])->name('deleteTaskDetails');
Route::any('/updateTaskStatus', [App\Http\Controllers\TaskManagementController::class, 'updateTaskStatus'])->name('updateTaskStatus');
Route::any('/saveUpdateTaskStatus', [App\Http\Controllers\TaskManagementController::class, 'saveUpdateTaskStatus'])->name('saveUpdateTaskStatus');


Route::resource('Designation', DesignationController::class)->names([
        'index' => 'masterModules.designationDetails',
        'create' => 'masterModules.create',
		'store' => 'masterModules.designationstore',
    ]);
Route::any('/editDesignationDetails', [App\Http\Controllers\DesignationController::class, 'editDesignationDetails'])->name('editDesignationDetails');
Route::any('/saveEditDesignationDetails', [App\Http\Controllers\DesignationController::class, 'saveEditDesignationDetails'])->name('saveEditDesignationDetails');
Route::any('/deleteDesignationDetails', [App\Http\Controllers\DesignationController::class, 'deleteDesignationDetails'])->name('deleteDesignationDetails');

Route::resource('Status', StatusMasterController::class)->names([
        'index' => 'masterModules.status',
        'create' => 'masterModules.create',
		'store' => 'masterModules.statusstore',
    ]);
Route::any('/editStatusDetails', [App\Http\Controllers\StatusMasterController::class, 'editStatusDetails'])->name('editStatusDetails');
Route::any('/saveEditStatusDetails', [App\Http\Controllers\StatusMasterController::class, 'saveEditStatusDetails'])->name('saveEditStatusDetails');
Route::any('/deleteStatusDetails', [App\Http\Controllers\StatusMasterController::class, 'deleteStatusDetails'])->name('deleteStatusDetails');

Route::resource('About', AboutController::class)->names([
        'index' => 'masterModules.about',
        'create' => 'masterModules.create',
		'store' => 'masterModules.aboutstore',
    ]);
	
Route::any('/editContentDetails', [App\Http\Controllers\AboutController::class, 'editContentDetails'])->name('editContentDetails');
Route::any('/saveEditContentDetails', [App\Http\Controllers\AboutController::class, 'saveEditContentDetails'])->name('saveEditContentDetails');
Route::any('/deleteContentDetails', [App\Http\Controllers\AboutController::class, 'deleteContentDetails'])->name('deleteContentDetails');

Route::resource('EmployerEnquiry', EmployerEnquiryController::class)->names([
        'index' => 'EmployerEnquiry.employerEnquiry',
        'create' => 'EmployerEnquiry.create',
		'store' => 'EmployerEnquiry.employerEnquirystore',
    ]);
Route::any('/viewEmployerEnquiryDetails', [App\Http\Controllers\EmployerEnquiryController::class, 'viewEmployerEnquiryDetails'])->name('viewEmployerEnquiryDetails');
Route::any('/updateEmployerEnquiryStatus', [App\Http\Controllers\EmployerEnquiryController::class, 'updateEmployerEnquiryStatus'])->name('updateEmployerEnquiryStatus');
Route::any('/saveUpdatedEmployerEnquiryStatus', [App\Http\Controllers\EmployerEnquiryController::class, 'saveUpdatedEmployerEnquiryStatus'])->name('saveUpdatedEmployerEnquiryStatus');
Route::any('/deleteEmployerEnquiryDetails', [App\Http\Controllers\EmployerEnquiryController::class, 'deleteEmployerEnquiryDetails'])->name('deleteEmployerEnquiryDetails');
	
Route::resource('EmployeeEnquiry', EmployeeEnquiryController::class)->names([
        'index' => 'EmployeeEnquiry.employeeEnquiry',
        'create' => 'EmployeeEnquiry.create',
		'store' => 'EmployeeEnquiry.employeeEnquirystore',
    ]);

Route::any('/viewEmployeeEnquiryDetails', [App\Http\Controllers\EmployeeEnquiryController::class, 'viewEmployeeEnquiryDetails'])->name('viewEmployeeEnquiryDetails');
Route::any('/updateEnquiryStatus', [App\Http\Controllers\EmployeeEnquiryController::class, 'updateEnquiryStatus'])->name('updateEnquiryStatus');
Route::any('/saveUpdatedEmployeeEnquiryStatus', [App\Http\Controllers\EmployeeEnquiryController::class, 'saveUpdatedEmployeeEnquiryStatus'])->name('saveUpdatedEmployeeEnquiryStatus');
Route::any('/deleteEnquiryDetails', [App\Http\Controllers\EmployeeEnquiryController::class, 'deleteEnquiryDetails'])->name('deleteEnquiryDetails');
	
Route::resource('PostJob', JobManagementController::class)->names([
        'index' => 'JobManagement.jobManagement',
        'create' => 'JobManagement.create',
		'store' => 'JobManagement.jobManagementstore',
    ]);
	
Route::any('/viewJobDetails', [App\Http\Controllers\JobManagementController::class, 'viewJobDetails'])->name('viewJobDetails');
Route::any('/deleteJobDetails', [App\Http\Controllers\JobManagementController::class, 'deleteJobDetails'])->name('deleteJobDetails');
Route::any('/editJobDetails', [App\Http\Controllers\JobManagementController::class, 'editJobDetails'])->name('editJobDetails');
Route::any('/saveEditJobDetails', [App\Http\Controllers\JobManagementController::class, 'saveEditJobDetails'])->name('saveEditJobDetails');