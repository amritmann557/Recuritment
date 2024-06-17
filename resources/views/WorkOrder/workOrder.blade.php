@extends('layouts_new.app_new')
@section('content')
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Sales Order</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Sales Order</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Sale Order</h4>
		        </div>
				<div class="buttons mt-3">
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="float:right;margin-right:31px;width:170px;">Add Sale Order</button>
                </div>
		        <div class="card-body">
			        <div class="table-responsive">
			            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
							<thead>
							    <tr>
									<th class="text-center">
									  #
									</th>
									<th>Sales Order ID</th>
									<th>Order Date</th>
									<th>Customer Name</th>
									<th>Contact Number</th>
									<th>Delivery Date</th>
									<th>Actions</th>
							    </tr>
							</thead>
							<tbody>
							    @foreach($sales as $key=>$data)
									<tr>
										<td class="text-center">{{$key+1}}</td>
										<td>{{$data->unique_id}}</td>
										<td>{{$data->orderDate}}</td>									   
										<td>{{$data->customerName}}</td>									   
										<td>{{$data->contact_number}}</td>									   
										<td>{{$data->deliveryDate}}</td>										
										<td>
											<a href="#" rel="{{$data->unique_id}}" class="btn btn-primary" id="viewSalesOrderButton">View</a>
											<a href="#" rel="{{$data->unique_id}}" class="btn btn-primary" id="editSalesOrderButton">Edit</a>
											<?php if(Auth::user()->position == 'Super Admin'){?>
											<a href="#" class="btn btn-primary" rel="{{$data->unique_id}}" id="deleteSalesOrderButton">Delete</a>
											<?php } ?>
											<a href="printworkOrderDetails?id={{$data->unique_id}}" class="btn btn-primary" id="SalesPrintButton">Print</a>
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
		        <h5 class="modal-title" id="myLargeModalLabel">Add Sale Order Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
					<form method="post" id="add_saleOrder_details">
						@csrf
						<div class="row">
						    <div class="col-md-6">
							    <label class="design">Sale Order ID</label>
                                <input type="text" class="form-control" value="Auto Generated" readonly>
							</div>
							<div class="col-md-6">
							    <label class="design">Order Date</label>
                                <input type="date" class="form-control" id="orderDate" name="orderDate" value="<?php echo date('Y-m-d');?>">
								<span id="orderDate_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
							    <label class="design">Owner To</label>
                                <input type="text" class="form-control" id="ownerTo" name="ownerTo">
								<span id="ownerTo_error" style="color: red"></span>
							</div>
						    <div class="col-md-6">
							    <label class="design">Order To</label>
                                <input type="text" class="form-control" id="orderTo" name="orderTo">
								<span id="orderTo_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">							    
								<label class="design">Customer Name</label>
								<input type="text" class="form-control" id="customerName" name="customerName">
								<span id="customerName_error" style="color: red"></span>								
							</div>
						    <div class="col-md-6">
								<label class="design">Manufactured Date</label>
								<input type="date" class="form-control" id="manufacturedDate" name="manufacturedDate">
								<span id="manufacturedDate_error" style="color: red"></span>								
							</div>						    
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
                                <label class="design">Job Name</label>
                                <input type="text" class="form-control" id="jobName" name="jobName">
                                <span id="jobName_error" style="color: red"></span>								
							</div>
						    <div class="col-md-6">
								<label class="design">Delivery Date</label>
								<input type="date" class="form-control" id="deliveryDate" name="deliveryDate">
								<span id="deliveryDate_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
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
						    <div class="col-md-6">
								<label class="design">Estimate Number</label>
								<input type="text" class="form-control" id="estimateNumber" name="estimateNumber">
								<span id="estimateNumber_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-2">
						    <div class="col-md-6">
                                <label class="design">City/State/Zip</label>
						        <textarea class="form-control" id="city" name="city"></textarea>
                                <span id="city_error" style="color: red"></span>								
							</div>
						    <div class="col-md-6">
								<label class="design">Email Address</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fas fa-envelope"></i>
										</div>
									</div>
								    <input type="email" class="form-control" id="emailAddress" name="emailAddress">
								</div>
								<span id="emailAddress_error" style="color: red"></span>
							</div>
						</div>
						<div class="row mt-3">
						    <div class="col-md-6">
                                <label>Mode Of Delivery:</label><br>
								<div class="pretty p-switch p-fill mt-3">
								    <input type="checkbox" ID="modeOfDelivery" name="modeOfDelivery" value="Ashu"/>
								    <div class="state p-success">
									    <label>Ashu</label>
								     </div>
								</div>
								<div class="pretty p-switch p-fill mt-3">
								    <input type="checkbox" ID="modeOfDelivery" name="modeOfDelivery" value="Courier"/>
								    <div class="state p-success">
									    <label>Courier</label>
								     </div>
								</div>
								<div class="pretty p-switch p-fill mt-3">
								    <input type="checkbox" ID="modeOfDelivery" name="modeOfDelivery" value="Bus"/>
								    <div class="state p-success">
									    <label>Bus</label>
								     </div>
								</div>
								<div class="pretty p-switch p-fill mt-3">
								    <input type="checkbox" ID="modeOfDelivery" name="modeOfDelivery" value="Self"/>
								    <div class="state p-success">
									    <label>Self</label>
								     </div>
								</div>
								<span id="modeOfDelivery_error" style="color: red"></span>								
							</div>
							<div class="col-md-6">
								<label class="design">Upload Image</label>
								<input type="file" class="form-control" id="uploadImage" name="uploadImage">
								<span id="uploadImage_error" style="color: red"></span>
							</div>
						</div>
						<div class="card mt-4">
							<div class="card-header">
								<h4>Order Details</h4>
							</div>
							<div class="card-body">
							    <div class="row mt-2">
									<div class="col-md-6">
										<label class="design">Product Code/Details</label>
										<input type="text" class="form-control" id="productCode" name="productCode[]">
										<span id="productCode_error" style="color: red"></span>								
									</div>
									<div class="col-md-6">
										<label class="design">Price Details</label>
										<input type="text" class="form-control" id="priceDetails" name="priceDetails[]">
										<span id="priceDetails_error" style="color: red"></span>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-6">
										<label class="design">Quantity</label>
										<input type="text" class="form-control" id="quantity" name="quantity[]">
										<span id="quantity_error" style="color: red"></span>								
									</div>
									<div class="col-md-6">
										<label class="design">Manufactured By</label>
										<input type="text" class="form-control" id="manufacturedBy" name="manufacturedBy[]">
										<span id="manufacturedBy_error" style="color: red"></span>
									</div>
								</div>
								<div id="repair_fields"></div>
								<div class="clear"></div>
								<div class="ms-auto text-end mt-3">
									<button type="button" class="btn btn-primary" onclick="repair_fields();">Add More Records</button>
								</div>
							</div>
						</div>
						<div class="buttons mt-3">
						    <button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="saveSalesOrderDetails">Save Sale Order</button>
						    <button type="button" class="btn btn-lg btn-danger" style="width: 257px;" data-dismiss="modal">Back</button>														
						</div>
					</form>
				</div>
	        </div>    
		</div>
    </div>
</div>

<!-- Start View Student Details Modal -->
<div class="modal fade bd-example-modal-lg" id="viewSalesOrderModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">View Work Order Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
				    <section class="section">
					    <ul class="breadcrumb breadcrumb-style ">
							<li class="breadcrumb-item">
							  <h4 class="page-title m-b-0">Work Order</h4>
							</li>
							<li class="breadcrumb-item">
							  <a href="{{route('home')}}">
								<i data-feather="home"></i></a>
							</li>
							<li class="breadcrumb-item">View Work Order Details</li>
					    </ul>
					    <div class="section-body" id="view_Details">
					    
						</div>
                    </section>
				</div>
	        </div>    
		</div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="editWorkOrderModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">Edit Work Order Details</h5>
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
@include('WorkOrder.js.workOrder')
@endsection
@endsection