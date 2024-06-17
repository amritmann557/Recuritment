<form method="post" id="edit_task_details">
	@csrf
	<input type="hidden" id="editID" name="editID" value="{{$data[0]->id}}">
	<div class="form-group">
		<label>Staff Name:</label>
		<select class="form-control textItemModal" id="edit_staffName" name="edit_staffName">
			<option value="">Select</option>
			@foreach($employee as $empName)
			<option <?php if($data[0]->staffName == $empName->unique_id){ echo 'selected';} ?> value="{{$empName->unique_id}}">{{$empName->employeeName}}</option>
			@endforeach
		</select>
		<span id="edit_staffName_error" style="color: red"></span>
	</div>
	<div class="form-group">
		<label>Title:</label>
		<input data-src="title" name="edit_title" id="edit_title" class="form-control textItemModal" value="{{$data[0]->title}}">
		<span id="edit_title_error" style="color: red"></span>
	</div>
	<div class="form-group">
		<label>Date:</label>
		<input data-src="date" class="form-control textItemModal datepicker" name="edit_date" id="edit_date" value="{{$data[0]->date}}">
		<span id="edit_date_error" style="color: red"></span>
	</div>
	<div class="form-group">
		<div class="section-title">Priority</div>
		<select class="form-control" id="edit_priority" name="edit_priority">
			<option value="">Select</option>
			<option <?php if($data[0]->priority == 'Low'){ echo 'selected';}?> value="Low">Low</option>
			<option <?php if($data[0]->priority == 'Medium'){ echo 'selected';}?> value="Medium">Medium</option>
			<option <?php if($data[0]->priority == 'High'){ echo 'selected';}?> value="High">High</option>
		</select>
		<span id="edit_priority_error" style="color: red"></span>
	</div>
	<div class="form-group">
		<label>Details</label>
		<textarea data-src="details" class="form-control textAreaModal" name="edit_details" id="edit_details">{{$data[0]->details}}</textarea>
	</div>
	<div class="modal-footer pr-0">
		<button type="button" class="btn btn-lg btn-primary" id="edit_submitData">Save changes</button>
		<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
	</div>
</form>


