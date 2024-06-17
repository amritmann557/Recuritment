@php
    $i = 0;
@endphp
<form method="post" id="edit_salesOrder_details">
	@csrf
	<div class="row">
		<div class="col-md-6">
			<label class="design">Work Order ID</label>
			<input type="text" class="form-control" value="{{$data[0]->unique_id}}" name="editID" id="editID" readonly>
			<input type="hidden" class="form-control" value="{{$data[0]->unique_id}}" name="edit_ID" id="edit_ID">
			<input type="hidden" id="imageID" name="imageID" value="{{$data[0]->uploadImage}}">
		</div>
		<div class="col-md-6">
			<label class="design">Order Date</label>
			<input type="date" class="form-control" id="edit_orderDate" name="edit_orderDate" value="{{$data[0]->orderDate}}">
			<span id="edit_orderDate_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Owner To</label>
			<input type="text" class="form-control" id="edit_ownerTo" name="edit_ownerTo" value="{{$data[0]->ownerTo}}">
			<span id="edit_ownerTo_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Order To</label>
			<input type="text" class="form-control" id="edit_orderTo" name="edit_orderTo" value="{{$data[0]->orderTo}}">
			<span id="edit_orderTo_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">							    
			<label class="design">Customer Name</label>
			<input type="text" class="form-control" id="edit_customerName" name="edit_customerName" value="{{$data[0]->customerName}}">
			<span id="edit_customerName_error" style="color: red"></span>								
		</div>
		<div class="col-md-6">
			<label class="design">Manufactured Date</label>
			<input type="date" class="form-control" id="edit_manufacturedDate" name="edit_manufacturedDate" value="{{$data[0]->manufacturedDate}}">
			<span id="edit_manufacturedDate_error" style="color: red"></span>								
		</div>						    
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Job Name</label>
			<input type="text" class="form-control" id="edit_jobName" name="edit_jobName" value="{{$data[0]->jobName}}">
			<span id="edit_jobName_error" style="color: red"></span>								
		</div>
		<div class="col-md-6">
			<label class="design">Delivery Date</label>
			<input type="date" class="form-control" id="edit_deliveryDate" name="edit_deliveryDate" value="{{$data[0]->deliveryDate}}">
			<span id="edit_deliveryDate_error" style="color: red"></span>
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
				<input type="text" class="form-control phone-number" placeholder="+91 XXXX YYYY" id="edit_contact_number" name="edit_contact_number" value="{{$data[0]->contact_number}}">
			</div>
			<span id="contact_number_error" style="color: red"></span>								
		</div>
		<div class="col-md-6">
			<label class="design">Estimate Number</label>
			<input type="text" class="form-control" id="edit_estimateNumber" name="edit_estimateNumber" value="{{$data[0]->estimateNumber}}">
			<span id="estimateNumber_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">City/State/Zip</label>
			<textarea class="form-control" id="edit_city" name="edit_city">{{$data[0]->city}}</textarea>
			<span id="edit_city_error" style="color: red"></span>								
		</div>
		<div class="col-md-6">
			<label class="design">Email Address</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<i class="fas fa-envelope"></i>
					</div>
				</div>
				<input type="email" class="form-control" id="edit_emailAddress" name="edit_emailAddress" value="{{$data[0]->emailAddress}}">
			</div>
			<span id="edit_emailAddress_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-md-6">
			<label>Mode Of Delivery:</label><br>
			<div class="pretty p-switch p-fill mt-3">
				<input type="checkbox" ID="edit_modeOfDelivery" name="edit_modeOfDelivery" value="Ashu" <?php if($data[0]->modeOfDelivery == 'Ashu'){ echo 'checked'; }?>/>
				<div class="state p-success">
					<label>Ashu</label>
				 </div>
			</div>
			<div class="pretty p-switch p-fill mt-3">
				<input type="checkbox" ID="edit_modeOfDelivery" name="edit_modeOfDelivery" value="Courier" <?php if($data[0]->modeOfDelivery == 'Courier'){ echo 'checked'; }?>/>
				<div class="state p-success">
					<label>Courier</label>
				 </div>
			</div>
			<div class="pretty p-switch p-fill mt-3">
				<input type="checkbox" ID="edit_modeOfDelivery" name="edit_modeOfDelivery" value="Bus" <?php if($data[0]->modeOfDelivery == 'Bus'){ echo 'checked'; }?>/>
				<div class="state p-success">
					<label>Bus</label>
				 </div>
			</div>
			<div class="pretty p-switch p-fill mt-3">
				<input type="checkbox" ID="edit_modeOfDelivery" name="edit_modeOfDelivery" value="Self" <?php if($data[0]->modeOfDelivery == 'Self'){ echo 'checked'; }?>/>
				<div class="state p-success">
					<label>Self</label>
				 </div>
			</div>
			<span id="modeOfDelivery_error" style="color: red"></span>								
		</div>
		<div class="col-md-6">
			<label class="design">Upload Image</label>
			<input type="file" class="form-control" id="edit_uploadImage" name="edit_uploadImage">
			<span id="uploadImage_error" style="color: red"></span>
		</div>
	</div>
	<div class="card mt-4">
		<div class="card-header">
			<h4>Order Details</h4>
		</div>
		<div class="card-body">
		    <?php foreach($data as $sales){?>
			<input type="hidden" name="new_edit_id[]" id="new_edit_id" value="{{$sales->id}}">
			<div class="row mt-2">
				<div class="col-md-6">
					<label class="design">Product Code/Details</label>
					<input type="text" class="form-control" id="edit_productCode" name="edit_productCode[]" value="{{$sales->productCode}}">
					<span id="edit_productCode__{{ $i }}_error" style="color: red"></span>								
				</div>
				<div class="col-md-6">
					<label class="design">Price Details</label>
					<input type="text" class="form-control" id="edit_priceDetails" name="edit_priceDetails[]" value="{{$sales->priceDetails}}">
					<span id="edit_priceDetails__{{ $i }}_error" style="color: red"></span>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-6">
					<label class="design">Quantity</label>
					<input type="text" class="form-control" id="edit_quantity" name="edit_quantity[]" value="{{$sales->quantity}}">
					<span id="edit_quantity__{{ $i }}_error" style="color: red"></span>								
				</div>
				<div class="col-md-6">
					<label class="design">Manufactured By</label>
					<input type="text" class="form-control" id="edit_manufacturedBy" name="edit_manufacturedBy[]" value="{{$sales->manufacturedBy}}">
					<span id="edit_manufacturedBy__{{ $i }}_error" style="color: red"></span>
				</div>
			</div>
			<div class="row mt-3">
					<div class="col-md-3">
					   <a href="#" class="btn btn-icon icon-left btn-danger" id="removeWork" rel="<?php echo $sales->id;?>"><i class="fas fa-times"></i> Delete</a>
					</div>
				</div>
			<?php }?>
			<div id="edit_repair_fields"></div>
			<div class="clear"></div>
			<div class="ms-auto text-end mt-3">
				<button type="button" class="btn btn-primary" onclick="edit_repair_fields();">Add More Records</button>
			</div>
			@php
				$i++;
			@endphp
		</div>
	</div>
	<div class="buttons mt-2">
		<button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="saveEditSalesButton">Save Changes</button>
		<button type="button" class="btn btn-lg btn-danger" style="width: 257px;" id="closeEdit" data-dismiss="modal">Back</button>														
	</div>
</form>

