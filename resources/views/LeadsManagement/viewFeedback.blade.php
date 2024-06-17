<form method="get">
		     @csrf
			<div class="row">
			    <div class="col-md-6">
				    <label>User ID: {{$data[0]->userID}}</label>
				</div>
				<div class="col-md-6">
				    <label>Date Of Feedback: {{$data[0]->feedbackAddedDate}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    @if($data[0]->employeeName != NULL)
			    <div class="col-md-6">
				    <label>User Name: {{$data[0]->employeeName}}</label>
				</div>
				@endif
				@if($data[0]->companyName != NULL)
			    <div class="col-md-6">
				    <label>User Name: {{$data[0]->companyName}}</label>
				</div>
				@endif
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
				    <label>User Type: {{$data[0]->userType}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-12">
				    <label>Feedback Detail: {{$data[0]->feedback}}</label>
				</div>
			</div>
			<hr>
		    <div class="buttons mt-2">
			    <button type="button" class="btn btn-lg btn-danger" style="width: 291px; margin-left: 343px;" id="closeModal">Back</button>														
			</div>	
		</form>