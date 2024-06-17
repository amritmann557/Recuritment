@extends('layouts_new.app_new')
@section('content')
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Leads Management</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Leads Management</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Leads Management</h4>
		        </div>
				<!-- div class="buttons mt-3">
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="float:right;margin-right:31px;width:170px;">Add Lead</button>
                </div -->
		        <div class="card-body">
			        <div class="table-responsive">
			            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
							<thead>
							    <tr>
									<th class="text-center">
									  #
									</th>
									<th>Lead Source</th>
									<th>Date</th>
									<th>Contacted Person</th>
									<th>Contact Number</th>
									<th>Status</th>
									<th>Actions</th>
							    </tr>
							</thead>
							<tbody>
							    @foreach($lead as $key=>$data)
									<tr>
										<td class="text-center">{{$key+1}}</td>
										<td>{{$data->unqiue_id}}</td>
										<td>{{$data->leadName}}</td>									   
										<td>{{$data->companyName}}</td>									   
										<td>{{$data->contact_number}}</td>									   
										<td>{{$data->leadStatus}}</td>										
										<td>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="viewLeadsButton">View</a>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="editLeadButton">Edit</a>
											<?php if(Auth::user()->position == 'Super Admin'){?>
											<a href="#" class="btn btn-primary" rel="{{$data->id}}" id="deleteLeadButton">Delete</a>
											<?php } ?>
											<?php if($data->moveToSales == 0){?>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="salesButton">Move To Sales</a>
											<?php }?>
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
		        <h5 class="modal-title" id="myLargeModalLabel">Add Leads Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
					<form method="post" id="add_leads_details">
						@csrf
						<div class="row">
						    <div class="col-md-6">
							    <label class="design">Lead Added By</label>
                                <input type="text" class="form-control" value="{{Auth::user()->name;}}" id="leadAddedBy" name="leadAddedBy">
							</div>
							<div class="col-md-6">
							    <label class="design">Name</label>
                                <input type="text" class="form-control" id="leadName" name="leadName" required>
								<span id="leadName_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
							    <label class="design">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="companyName">
								<span id="companyName_error" style="color: red"></span>
							</div>
							<div class="col-md-6">
							    <div class="form-group">
                                    <label class="design">Contact Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control phone-number" placeholder="+91 XXXX YYYY" id="contact_number" name="contact_number">
                                    </div>
									<span id="contact_number_error" style="color: red"></span>
                                </div>								
							</div>
						</div>
						<div class="row">
						    <div class="col-md-6">
								<label class="design">Position Of The Contact Person</label>
								<input type="text" class="form-control" id="contactPerson" name="contactPerson">
								<span id="contactPerson_error" style="color: red"></span>
							</div>
							<div class="col-md-6">
								<label class="design">Location</label>
								<input type="text" class="form-control" id="leadLocation" name="leadLocation">
								<span id="leadLocation_error" style="color: red"></span>
							</div>
						</div>
                        <div class="row mt-2">
							<div class="col-md-6">
							    <label class="design">Status Of Lead</label>
                                <select class="form-control" id="leadStatus" name="leadStatus">
								    <option value="">Select</option>
									<?php foreach($status as $stat){?>
									<option value="{{$stat->statusName}}">{{$stat->statusName}}</option>
									<?php } ?>
								</select>
								<span id="leadStatus_error" style="color: red"></span>
							</div>
							<?php if(Auth::user()->position == 'Super Admin'){?>
							<div class="col-md-6">
								<label class="design">Assigned To</label>
								<select class="form-control" id="assignedTo" name="assignedTo">
								       <option>Select</option>
									   <?php foreach($employee as $emp){?>
							            <option value="{{$emp->employeeName}}">{{$emp->employeeName}}</option>
									   <?php }?>
								</select>
								<span id="assignedTo_error" style="color: red"></span>
							</div>
							<?php } else{?>
							<div class="col-md-6">
								<label class="design">Assigned To</label>
								<input type="text" class="form-control" id="assignedTo" name="assignedTo" readonly>
								<span id="assignedTo_error" style="color: red"></span>
							</div>
							<?php } ?>
						</div>
                        <div class="row mt-2 leadInfo" style="display:none;">
							<div class="col-md-6">
							    <label class="design">Date</label>
                                <input type="date" class="form-control" id="leadDate" name="leadDate">
								<span id="leadDate_error" style="color: red"></span>
							</div>
							<div class="col-md-6">
								<label class="design">Time</label>
								<input type="time" class="form-control" id="leadTime" name="leadTime">
								<span id="leadTime_error" style="color: red"></span>
							</div>
							<div class="col-md-12 mt-2">
								<label class="design">Notes</label>
								<textarea class="form-control" id="notes" name="notes"></textarea>
								<span id="notes_error" style="color: red"></span>
							</div>
						</div>						
						<div class="buttons mt-3">
						    <button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="saveLeadDetails">Save Lead</button>
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

<div class="modal fade bd-example-modal-lg" id="saleLeadsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">Design Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
				    <form method="post" id="design_details">
						@csrf
						<input type="hidden" id="designID" name="designID">
						<div class="row">
						    <div class="col-md-12">
							    <label class="design">Upload Design Image</label>
                                <input type="file" class="form-control" id="designImage" name="designImage">
								<span id="designImage_error" style="color: red"></span>
							</div>
							<div class="col-md-12 mt-3">
							    <label class="design">Notes for Designer</label>
                                <textarea class="form-control" id="designerNotes" name="designerNotes" placeholder="Optional...."></textarea>
								<span id="designerNotes_error" style="color: red"></span>
							</div>
						</div>
                        <div class="buttons mt-3">
						    <button type="button" class="btn btn-lg btn-primary" id="uploadDesignDetails">Save Lead</button>
						    <button type="button" class="btn btn-lg btn-danger"  data-dismiss="modal">Back</button>														
						</div>
					</form>	
				</div>
	        </div>    
		</div>
    </div>
</div>
<!-- End View Staff Details Modal -->
@section('javascript')
@include('LeadsManagement.js.leads')
@endsection
@endsection