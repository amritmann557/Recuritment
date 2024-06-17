<form method="get">
		     @csrf
			<div class="row">
			    <div class="col-md-6">
				    <label>Quotation ID: {{$data[0]->unique_id}}</label>
				</div>
				<div class="col-md-6">
				    <label>Quotation Date: {{$data[0]->quotationDate}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Quotation Number: {{$data[0]->quotationNumber}}</label>
				</div>
				<div class="col-md-6">
				    <label>Customer Name: {{$data[0]->customerName}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Total Amount: {{$data[0]->total_amount}}</label>
				</div>
				<div class="col-md-6">
				    <label>Amount Recieved: {{$data[0]->amount_received}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Pending Balance: {{$data[0]->pending_balance}}</label>
				</div>
				<div class="col-md-6">
				    <label>Status: {{$data[0]->status}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Upload Quotation: <img src="<?php echo $data[0]->uploadQuotation;?>" style="width: 130px;"></label>
				</div>
			</div>
			<hr>
		    <div class="buttons mt-2">
			    <button type="button" class="btn btn-lg btn-danger" style="width: 291px; margin-left: 343px;" id="closeModal">Back</button>														
			</div>	
		</form>