@extends('layouts_new.app_new')

@section('content')
<style>
    .required:after{ 
        content:'*'; 
        color:red; 
        padding-left:5px;
    }
</style>
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Feedback Management</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Feedback</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Feedback</h4>
		        </div>
				<!-- div class="buttons mt-3">
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float:right;margin-right:31px;width:170px;">Add Company Content</button>
                </div -->
		        <div class="card-body">
			        <div class="table-responsive">
			            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
							<thead>
							    <tr>
									<th class="text-center">
									  #
									</th>
									<th>User ID</th>
									<th>User Name</th>
									<th>Email Address</th>
									<th>Contact Number</th>
									<th>Actions</th>
							    </tr>
							</thead>
							<tbody>
							    @foreach($result as $key=>$data)
									<tr>
										<td class="text-center">{{$key+1}}</td>
										<td>{{$data->userID}}</td>
										@if($data->companyName != NULL)
										<td>{{$data->companyName}}</td>
										@endif
										@if($data->employeeName != NULL)
										<td>{{$data->employeeName}}</td>
										@endif
										<td>{{$data->emailAddress}}</td>									   
										<td>{{$data->contactNumber}}</td>									   
										<td>
											<a href="#" rel="{{$data->feedbackID}}" class="btn btn-primary" id="viewFeedbackButton">View</a>
											<a href="#" class="btn btn-primary" rel="{{$data->feedbackID}}" id="deleteFeedbackButton">Delete</a>
										</td>
									</tr>
                                @endforeach 
						    </tbody>
			            </table>
			        </div>
		        </div>
		    </div>
	    </div>
    </div> 
</section>
<!-- Start View Student Details Modal -->
<div class="modal fade bd-example-modal-lg" id="viewEnquiryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">View Feedback Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
				    <section class="section">
					    <ul class="breadcrumb breadcrumb-style ">
							<li class="breadcrumb-item">
							  <h4 class="page-title m-b-0">Feedback Management</h4>
							</li>
							<li class="breadcrumb-item">
							  <a href="{{route('home')}}">
								<i data-feather="home"></i></a>
							</li>
							<li class="breadcrumb-item">Feedback Details</li>
					    </ul>
					    <div class="section-body" id="view_Details">
					    
						</div>
                    </section>
				</div>
	        </div>    
		</div>
    </div>
</div>
@section('javascript')
@include('LeadsManagement.js.feedback')
@endsection
@endsection