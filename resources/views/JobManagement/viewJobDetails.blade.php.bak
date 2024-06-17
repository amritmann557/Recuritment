<form method="get">
		     @csrf
			<div class="row">
			    <div class="col-md-6">
				    <label>Lead Added By: {{$data[0]->leadAddedBy}}</label>
				</div>
				<div class="col-md-6">
				    <label>Name: {{$data[0]->leadName}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Company Name: {{$data[0]->companyName}}</label>
				</div>
				<div class="col-md-6">
				    <label>Contact Number: {{$data[0]->contact_number}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Position Of The Contact Person: {{$data[0]->contactPerson}}</label>
				</div>
				<div class="col-md-6">
				    <label>Location: {{$data[0]->leadLocation}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Status Of Lead: {{$data[0]->leadStatus}}</label>
				</div>
				<div class="col-md-6">
				    <label>Assigned To: {{$data[0]->assignedTo}}</label>
				</div>
			</div>
			<hr>
			<?php if($data[0]->leadDate != NULL){ ?>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Follow Up Date: {{$data[0]->leadDate}}</label>
				</div>
				<div class="col-md-6">
				    <label>Follow Up Time: {{$data[0]->leadTime}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-12">
				    <label>Notes: {{$data[0]->notes}}</label>
				</div>
			</div>
			<hr>
			<?php } ?>
		    <div class="buttons mt-2">
			    <button type="button" class="btn btn-lg btn-danger" style="width: 291px; margin-left: 343px;" id="closeModal">Back</button>														
			</div>	
		</form>