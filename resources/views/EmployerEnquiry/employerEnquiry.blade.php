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
		  <h4 class="page-title m-b-0">Employer Enquiry Details</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Employer Enquiry</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Employer Enquiry</h4>
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
									<th>Company ID</th>
									<th>Company Name</th>
									<th>Date Of Enquiry</th>
									<th>Contact Number</th>
									<th>Status</th>
									<th>Actions</th>
							    </tr>
							</thead>
							<tbody>
							    @foreach($result as $key=>$data)
									<tr>
										<td class="text-center">{{$key+1}}</td>
										<td>{{$data->userID}}</td>
										<td>{{$data->companyName}}</td>									   
										<td>{{$data->descriptionAddedDate}}</td>									   
										<td>{{$data->contactNumber}}</td>									   
										<td>{{$data->status}}</td>										
										<td>
											<a href="#" rel="{{$data->descriptionID}}" class="btn btn-primary" id="viewEnquiryButton">View</a>
											<a href="#" rel="{{$data->descriptionID}}" class="btn btn-primary" id="updateStatusButton">Update Status</a>
											<a href="#" class="btn btn-primary" rel="{{$data->descriptionID}}" id="deleteEnquiryButton">Delete</a>
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
		        <h5 class="modal-title" id="myLargeModalLabel">View Employee Enquiry Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
				    <section class="section">
					    <ul class="breadcrumb breadcrumb-style ">
							<li class="breadcrumb-item">
							  <h4 class="page-title m-b-0">Employee Enquiry Details</h4>
							</li>
							<li class="breadcrumb-item">
							  <a href="{{route('home')}}">
								<i data-feather="home"></i></a>
							</li>
							<li class="breadcrumb-item">Employee Enquiry</li>
					    </ul>
					    <div class="section-body" id="view_Details">
					    
						</div>
                    </section>
				</div>
	        </div>    
		</div>
    </div>
</div>
<!-- End Modal -->
<div class="modal fade bd-example-modal-sm" id="statusUpdateModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		    <div class="modal-header">
				<h5 class="modal-title" id="mySmallModalLabel">Update Status</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
		    </div>
			<div class="modal-body">
				<div class="card-body" id="status_details">
					
			    </div>
		    </div>
		</div>
	</div>
</div>
@section('javascript')
@include('EmployerEnquiry.js.employerEnquiry')
@endsection
@endsection