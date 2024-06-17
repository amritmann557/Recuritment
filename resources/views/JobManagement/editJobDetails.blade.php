<form method="post" id="edit_Job_details">
	@csrf
	<input type="hidden" id="editID" name="editID" value="{{$data[0]->id}}">
	<div class="row">
		<div class="col-md-6">
			<label class="design">Job ID</label>
			<input type="text" class="form-control" value="{{$data[0]->unique_id}}">
		</div>
		<div class="col-md-6">
			<label class="design">Job Title</label>
			<input type="text" class="form-control" id="edit_jobTitle" name="edit_jobTitle" value="{{$data[0]->jobTitle}}" required>
			<span id="edit_jobTitle_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Description</label>
			<textarea class="form-control" id="edit_description" name="edit_description">{{$data[0]->description}}</textarea>
			<span id="edit_description_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="design">Years Of Experience</label>                                    
				<input type="text" class="form-control" id="edit_experience" name="edit_experience" value="{{$data[0]->experience}}">
				<span id="edit_experience_error" style="color: red"></span>
			</div>								
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label class="design">Prefer Language</label>
			<input type="text" class="form-control" id="edit_language" name="edit_language" value="{{$data[0]->language}}">
			<span id="edit_language_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Prefer Environment</label>
			<select class="form-control" id="edit_gender" name="edit_gender">
				<option value="">Select</option>
				<option <?php if($data[0]->gender == 'Male'){ echo 'selected'; }?> value="Male">Male</option>
				<option <?php if($data[0]->gender == 'Female'){ echo 'selected'; }?> value="Female">Female</option>
				<option <?php if($data[0]->gender == 'Others'){ echo 'selected'; }?> value="Others">Others</option>
			</select>
			<span id="edit_gender_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Salary</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">
						SGD
					</div>
				</div>
				<input type="text" class="form-control" id="edit_salary" name="edit_salary" value="{{$data[0]->salary}}">
			</div>
			<span id="edit_salary_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Number Of Vacancy</label>
			<input type="text" class="form-control" id="edit_vacancy" name="edit_vacancy" value="{{$data[0]->vacancy}}">
			<span id="edit_vacancy_error" style="color: red"></span>
		</div>							
	</div>
	<div class="row mt-2">
	    <div class="col-md-6">
			<label class="design">Location</label>
			<textarea class="form-control" id="edit_location" name="edit_location">{{$data[0]->location}}</textarea>
			<span id="edit_location_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Job Status</label>
			<select class="form-control" id="edit_status" name="edit_status">
				<option value="">Select</option>
				@foreach($result as $status)
				<option <?php if($data[0]->status == $status->statusName){ echo 'selected'; }?> value="{{$status->statusName}}">{{$status->statusName}}</option>
				@endforeach
			</select>
			<span id="edit_status_error" style="color: red"></span>
		</div>													
	</div>
	<div class="buttons mt-3">
		<button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="updateJobDetails">Post A Job</button>
		<button type="button" class="btn btn-lg btn-danger" style="width: 257px;" data-dismiss="modal">Back</button>														
	</div>
</form>

