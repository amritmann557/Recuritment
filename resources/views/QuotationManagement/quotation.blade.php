@extends('layouts_new.app_new')
@section('content')
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Quotation Management</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Quotation Management</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Quotation Management</h4>
		        </div>
				<div class="buttons mt-3">
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="float:right;margin-right:31px;width:170px;">Add Quotation</button>
                </div>
		        <div class="card-body">
			        <div class="table-responsive">
			            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
							<thead>
							    <tr>
									<th class="text-center">
									  #
									</th>
									<th>Quotation ID</th>
									<th>Quotation Number</th>
									<th>Total Amount</th>
									<th>Paid Amount</th>
									<th>Status</th>
									<th>Actions</th>
							    </tr>
							</thead>
							<tbody>
							    @foreach($quote as $key=>$data)
									<tr>
										<td class="text-center">{{$key+1}}</td>
										<td>{{$data->unique_id}}</td>
										<td>{{$data->quotationNumber}}</td>									   
										<td>{{$data->total_amount}}</td>									   
										<td>{{$data->amount_received}}</td>									   
										<td>{{$data->status}}</td>										
										<td>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="viewQuotationButton">View</a>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="editQuotationButton">Edit</a>
											<?php if(Auth::user()->position == 'Super Admin'){?>
											<a href="#" class="btn btn-primary" rel="{{$data->id}}" id="deleteQuotationButton">Delete</a>
											<?php } ?>
											<a href="downloadQuotation?id={{$data->id}}" class="btn btn-primary" id="quotationButton">Download Quotation</a>
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
		        <h5 class="modal-title" id="myLargeModalLabel">Add Quotation Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
					<form method="post" id="add_Quotation_details">
						@csrf
						<div class="row">
						    <div class="col-md-6">
							    <label class="design">Quotation ID</label>
                                <input type="text" class="form-control" value="Auto Generated" readonly>
							</div>
							<div class="col-md-6">
							    <label class="design">Quotation Date</label>
                                <input type="date" class="form-control" id="quotationDate" name="quotationDate" value="<?php echo date('Y-m-d');?>">
								<span id="quotationDate_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
							    <label class="design">Quotation Number</label>
                                <input type="text" class="form-control" id="quotationNumber" name="quotationNumber" required>
								<span id="quotationNumber_error" style="color: red"></span>
							</div>
						    <div class="col-md-6">
							    <label class="design">Customer Name</label>
                                <input type="text" class="form-control" id="customerName" name="customerName">
								<span id="customerName_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">							    
								<label class="design">Total Amount</label>
								<input type="text" class="form-control total_amount" id="total_amount" name="total_amount" value="0.00">
								<span id="total_amount_error" style="color: red"></span>								
							</div>
						    <div class="col-md-6">
								<label class="design">Amount Recieved</label>
								<input type="text" class="form-control amount_received" id="amount_received" name="amount_received" value="0.00">
								<span id="amount_received_error" style="color: red"></span>								
							</div>						    
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
                                <label class="design">Pending Balance</label>
                                <input type="text" class="form-control pending_balance" id="pending_balance" name="pending_balance" value="0.00">
                                <span id="pending_balance_error" style="color: red"></span>								
							</div>
						    <div class="col-md-6">
								<label class="design">Upload Quotation</label>
								<input type="file" class="form-control" id="uploadQuotation" name="uploadQuotation">
								<span id="uploadQuotation_error" style="color: red"></span>
							</div>
						</div>
						<div class="buttons mt-3">
						    <button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="saveQuotationDetails">Save Quotation</button>
						    <button type="button" class="btn btn-lg btn-danger" style="width: 257px;" data-dismiss="modal">Back</button>														
						</div>
					</form>
				</div>
	        </div>    
		</div>
    </div>
</div>

<!-- Start View Student Details Modal -->
<div class="modal fade bd-example-modal-lg" id="viewQuotationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">View Quotation Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
				    <section class="section">
					    <ul class="breadcrumb breadcrumb-style ">
							<li class="breadcrumb-item">
							  <h4 class="page-title m-b-0">Quotation Management</h4>
							</li>
							<li class="breadcrumb-item">
							  <a href="{{route('home')}}">
								<i data-feather="home"></i></a>
							</li>
							<li class="breadcrumb-item">View Quotation Details</li>
					    </ul>
					    <div class="section-body" id="view_Details">
					    
						</div>
                    </section>
				</div>
	        </div>    
		</div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="editQuotationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">Edit Quotation Details</h5>
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
@include('QuotationManagement.js.quotation')
@endsection
@endsection