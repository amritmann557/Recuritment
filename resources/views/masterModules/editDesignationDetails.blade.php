<form id="editDesignationForm">
    @csrf
	<input type="hidden" id="editID" name="editID" value="{{$data[0]['id']}}">
	<div class="form-group">
		<label>ID</label>
		<div class="input-group">
		  <input type="text" class="form-control" placeholder="Auto Generated" value="{{$data[0]['unique_id']}}" readonly>
		</div>
	</div>
	<div class="form-group">
		<label>Designation Name</label>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Designation Name" name="edit_designationName" id="edit_designationName" value="{{$data[0]['designationName']}}">
			<span id="edit_designationName_error" style="color: red"></span>
		</div>
	</div>
	<button type="button" class="btn btn-primary m-t-15 waves-effect" id="saveEditDesignationbutton">Edit Details</button>
</form>