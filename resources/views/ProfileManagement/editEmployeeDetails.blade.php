<form method="post" id="edit_employee_details">
	@csrf
	<input type="hidden" id="editID" name="editID" value="{{$data[0]->unique_id}}">
	<div class="row">
		<div class="col-md-6">
			<label class="design">Employee ID</label>
			<input type="text" class="form-control" value="{{$data[0]->unique_id}}" readonly>
		</div>
		<div class="col-md-6">
			<label class="design">Employee Name</label>
			<input type="text" class="form-control" id="edit_employeeName" name="edit_employeeName" value="{{$data[0]->employeeName}}">
			<span id="edit_employeeName_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<div class="form-group">
				<label class="design">Contact Number</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<i class="fas fa-phone"></i>
						</div>
					</div>
					<input type="text" class="form-control phone-number" placeholder="+91 XXXX YYYY" id="edit_contact_number" name="edit_contact_number" value="{{$data[0]->contact_number}}">
				</div>
				<span id="edit_contact_number_error" style="color: red"></span>
			</div>								
		</div>
		<div class="col-md-6">
			<label class="design">Email Adress</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<i class="fas fa-envelope"></i>
					</div>
				</div>
			    <input type="email" class="form-control" id="edit_email" name="edit_email" value="{{$data[0]->email}}">
			</div>
			<span id="edit_email_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Position</label>
			<select class="form-control" id="edit_position" name="edit_position">
				<option value="">Select</option>
				@foreach($designation as $desi)
				<option <?php if($data[0]->position == $desi->designationName){ echo 'selected'; }?> value="{{$desi->designationName}}">{{$desi->designationName}}</option>
				@endforeach
			</select>
			<span id="edit_position_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Gender</label>
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
			<div class="form-group">
				<label class="design">Password</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<i class="fas fa-lock"></i>
						</div>
					</div>
					<input type="password" class="form-control pwstrength" data-indicator="pwindicator" id="edit_password" name="edit_password">
				</div>
				<div id="pwindicator" class="pwindicator">
					<div class="bar"></div>
					<div class="label"></div>
				</div>
			</div>
			<span id="edit_password_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Status</label>
			<select class="form-control" id="edit_status" name="edit_status">
				<option value="">Select</option>
				<option <?php if($data[0]->status == 'Active'){ echo 'selected'; }?> value="Active">Active</option>
				<option <?php if($data[0]->status == 'In Active'){ echo 'selected'; }?> value="In Active">In Active</option>
			</select>
			<span id="edit_status_error" style="color: red"></span>
		</div>
	</div>
	<div class="buttons mt-2">
		<button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="saveEditEmployeeButton">Save Changes</button>
		<button type="button" class="btn btn-lg btn-danger" style="width: 257px;" id="editClose" data-dismiss="modal">Back</button>														
	</div>
</form>

