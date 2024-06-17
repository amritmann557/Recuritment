<form method="get">
		     @csrf
			<div class="row">
			    <div class="col-md-6">
				    <label>Job Id: {{$data[0]->unique_id}}</label>
				</div>
				<div class="col-md-6">
				    <label>Job Title: {{$data[0]->jobTitle}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Description: {{$data[0]->description}}</label>
				</div>
				<div class="col-md-6">
				    <label>Years Of Experience: {{$data[0]->experience}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Prefer Language: {{$data[0]->language}}</label>
				</div>
				<div class="col-md-6">
				    <label>Prefer Environment: {{$data[0]->gender}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Salary: {{$data[0]->salary}}</label>
				</div>
				<div class="col-md-6">
				    <label>Number Of Vacancy: {{$data[0]->vacancy}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Location: {{$data[0]->location}}</label>
				</div>
			    <div class="col-md-6">
				    <label>Job Status: {{$data[0]->status}}</label>
				</div>
				
			</div>
			
		    <div class="buttons mt-2">
			    <button type="button" class="btn btn-lg btn-danger" style="width: 291px; margin-left: 343px;" id="closeModal">Back</button>														
			</div>	
		</form>