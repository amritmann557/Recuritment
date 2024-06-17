<form method="get">
		     @csrf
			<div class="row">
			    <div class="col-md-6">
				    <label>Employer Enquiry ID: {{$data[0]->unique_id}}</label>
				</div>
				<div class="col-md-6">
				    <label>Date Of Enquiry: {{$data[0]->descriptionAddedDate}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Company Name: {{$data[0]->companyName}}</label>
				</div>
				<div class="col-md-6">
				    <label>Email Address: {{$data[0]->emailAddress}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Contact Number: {{$data[0]->contactNumber}}</label>
				</div>
				<div class="col-md-6">
				    <label>Status: {{$data[0]->status}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-12">
				    <label>Enquiry Detail: {{$data[0]->job_description}}</label>
				</div>
			</div>
			<hr>
		    <div class="buttons mt-2">
			    <button type="button" class="btn btn-lg btn-danger" style="width: 291px; margin-left: 343px;" id="closeModal">Back</button>														
			</div>	
		</form>