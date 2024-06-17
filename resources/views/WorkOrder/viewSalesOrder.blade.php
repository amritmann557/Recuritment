<form method="get">
	@csrf
	<div class="row">
		<div class="col-md-6">
			<label>Sale Order ID: {{$data[0]->unique_id}}</label>
		</div>
		<div class="col-md-6">
			<label>Order Date: {{$data[0]->orderDate}}</label>
		</div>
	</div>
	<hr>
	<div class="row mt-2">
		<div class="col-md-6">
			<label>Owner To: {{$data[0]->ownerTo}}</label>
		</div>
		<div class="col-md-6">
			<label>Order To: {{$data[0]->orderTo}}</label>
		</div>
	</div>
	<hr>
	<div class="row mt-2">
		<div class="col-md-6">
			<label>Customer Name: {{$data[0]->customerName}}</label>
		</div>
		<div class="col-md-6">
			<label>Manufactured Date: {{$data[0]->manufacturedDate}}</label>
		</div>
	</div>
	<hr>
	<div class="row mt-2">
		<div class="col-md-6">
			<label>Job Name: {{$data[0]->jobName}}</label>
		</div>
		<div class="col-md-6">
			<label>Delivery Date: {{$data[0]->deliveryDate}}</label>
		</div>
	</div>
	<hr>
	<div class="row mt-2">
		<div class="col-md-6">
			<label>Contact Number: {{$data[0]->contact_number}}</label>
		</div>
		<div class="col-md-6">
			<label>Estimate Number: {{$data[0]->estimateNumber}}</label>
		</div>
	</div>
	<hr>
	<div class="row mt-2">
		<div class="col-md-6">
			<label>City/State/Zip: {{$data[0]->city}}</label>
		</div>
		<div class="col-md-6">
			<label>Email Address: {{$data[0]->emailAddress}}</label>
		</div>
	</div>
	<hr>
	<div class="row mt-2">
		<div class="col-md-6">
			<label>Mode Of Delivery: {{$data[0]->modeOfDelivery}}</label>
		</div>
		<div class="col-md-6">
			<label>Upload Image: <img src="<?php echo $data[0]->uploadImage;?>" style="width: 70px;"></label>
		</div>
	</div>
	<hr>
	<div class="card mt-4">
		<div class="card-header">
			<h4>Order Details</h4>
		</div>
		<div class="card-body">
		    @foreach($data as $result)
		    <div class="row mt-2">
				<div class="col-md-6">
					<label>Product Code/Details: {{$result->productCode}}</label>
				</div>
				<div class="col-md-6">
					<label>Price Details: {{$result->priceDetails}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
				<div class="col-md-6">
					<label>Quantity: {{$result->quantity}}</label>
				</div>
				<div class="col-md-6">
					<label>Manufactured By: {{$result->manufacturedBy}}</label>
				</div>
			</div>
			<hr>
			@endforeach
		</div>
	</div>
	<div class="buttons mt-2">
		<button type="button" class="btn btn-lg btn-danger" style="width: 291px; margin-left: 343px;" id="closeModal">Back</button>														
	</div>	
</form>