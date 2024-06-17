@extends('layouts_new.app_new')
@section('content')
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Job Management</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Post A Job</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Post A Job</h4>
		        </div>
				<div class="buttons mt-3">
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="float:right;margin-right:31px;width:170px;">Post A Job</button>
                </div>
		        <div class="card-body">
			        <div class="table-responsive">
			            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
							<thead>
							    <tr>
									<th class="text-center">
									  #
									</th>
									<th>Job ID</th>
									<th>Job Title</th>
									<th>Posted Date</th>
									<th>Status</th>
									<th>Actions</th>
							    </tr>
							</thead>
							<tbody>
							    @foreach($job as $key=>$data)
									<tr>
										<td class="text-center">{{$key+1}}</td>
										<td>{{$data->unique_id}}</td>
										<td>{{$data->jobTitle}}</td>									   
										<td>{{$data->postedDate}}</td>									   
										<td>{{$data->status}}</td>									   									
										<td>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="viewLeadsButton">View</a>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="editLeadButton">Edit</a>											
											<a href="#" class="btn btn-primary" rel="{{$data->id}}" id="deleteLeadButton">Delete</a>
											
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
<!-- Add Student Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">Job Post Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
					<form method="post" id="postJob_details">
						@csrf
						<div class="row">
						    <div class="col-md-6">
							    <label class="design">Job ID</label>
                                <input type="text" class="form-control" value="Auto Genrated">
							</div>
							<div class="col-md-6">
							    <label class="design">Job Title</label>
                                <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
								<span id="jobTitle_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
							    <label class="design">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
								<span id="description_error" style="color: red"></span>
							</div>
							<div class="col-md-6">
							    <div class="form-group">
                                    <label class="design">Years Of Experience</label>                                    
                                    <input type="text" class="form-control" id="experience" name="experience">
									<span id="experience_error" style="color: red"></span>
                                </div>								
							</div>
						</div>
						<div class="row">
						    <div class="col-md-6">
								<label class="design">Prefer Language</label>
								<input type="text" class="form-control" id="language" name="language">
								<span id="language_error" style="color: red"></span>
							</div>
							<div class="col-md-6">
								<label class="design">Prefer Environment</label>
								<select class="form-control" id="gender" name="gender">
								    <option value="">Select</option>
								    <option value="Male">Male</option>
								    <option value="Female">Female</option>
								    <option value="Others">Others</option>
								</select>
								<span id="gender_error" style="color: red"></span>
							</div>
						</div>
                        <div class="row mt-2">
							<div class="col-md-6">
							    <label class="design">Salary</label>
                                <div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											SGD
										</div>
									</div>
									<input type="text" class="form-control" id="salary" name="salary" value="0.00">
								</div>
								<span id="salary_error" style="color: red"></span>
							</div>
							<div class="col-md-6">
								<label class="design">Number Of Vacancy</label>
								<input type="text" class="form-control" id="vacancy" name="vacancy">
								<span id="vacancy_error" style="color: red"></span>
							</div>							
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
								<label class="design">Location</label>
								<textarea class="form-control" id="location" name="location"></textarea>
								<span id="location_error" style="color: red"></span>
							</div>
							<div class="col-md-6">
							    <label class="design">Job Status</label>
                                <select class="form-control" id="status" name="status">
								    <option value="">Select</option>
									@foreach($result as $status)
									<option value="{{$status->statusName}}">{{$status->statusName}}</option>
									@endforeach
								</select>
								<span id="status_error" style="color: red"></span>
							</div>													
						</div>
						<div class="buttons mt-3">
						    <button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="saveJobDetails">Post A Job</button>
						    <button type="button" class="btn btn-lg btn-danger" style="width: 257px;" data-dismiss="modal">Back</button>														
						</div>
					</form>
				</div>
	        </div>    
		</div>
    </div>
</div>

<!-- Start View Student Details Modal -->
<div class="modal fade bd-example-modal-lg" id="viewLeadModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">View Lead Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
				    <section class="section">
					    <ul class="breadcrumb breadcrumb-style ">
							<li class="breadcrumb-item">
							  <h4 class="page-title m-b-0">Leads Management</h4>
							</li>
							<li class="breadcrumb-item">
							  <a href="{{route('home')}}">
								<i data-feather="home"></i></a>
							</li>
							<li class="breadcrumb-item">View Lead Details</li>
					    </ul>
					    <div class="section-body" id="view_Details">
					    
						</div>
                    </section>
				</div>
	        </div>    
		</div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="editLeadsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">Edit Lead Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body" id="show_edit_Details">
					
				</div>
	        </div>    
		</div>
    </div>
</div>
@section('javascript')
@include('JobManagement.js.jobDetails')
@endsection
@endsection