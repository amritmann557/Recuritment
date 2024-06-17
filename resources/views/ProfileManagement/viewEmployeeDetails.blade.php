<form method="get">
		     @csrf
			<div class="row">
			    <div class="col-md-6">
				    <label>Employee ID: {{$data[0]->unique_id}}</label>
				</div>
				<div class="col-md-6">
				    <label>Employee Name: {{$data[0]->employeeName}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Email Address: {{$data[0]->email}}</label>
				</div>
				<div class="col-md-6">
				    <label>Contact Number: {{$data[0]->contact_number}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
				<div class="col-md-6">
				    <label>Designation: {{$data[0]->position}}</label>
				</div>
				<div class="col-md-6">
				    <label>Status: {{$data[0]->status}}</label>
				</div>
			</div>
			<hr>
			<div class="buttons mt-2">
			    <button type="button" class="btn btn-lg btn-danger" style="width: 291px; margin-left: 343px;" id="closeModal">Back</button>														
			</div>	
		</form>