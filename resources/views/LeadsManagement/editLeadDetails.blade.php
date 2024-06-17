<form method="post" id="edit_Lead_details">
	@csrf
	<input type="hidden" id="editID" name="editID" value="{{$data[0]->id}}">
	<div class="row">
		<div class="col-md-6">
			<label class="design">Lead Added By</label>
			<input type="text" class="form-control" value="{{$data[0]->leadAddedBy}}" id="edit_leadAddedBy" name="edit_leadAddedBy">
		</div>
		<div class="col-md-6">
			<label class="design">Name</label>
			<input type="text" class="form-control" id="edit_leadName" name="edit_leadName" value="{{$data[0]->leadName}}">
			<span id="edit_leadName_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Company Name</label>
			<input type="text" class="form-control" id="edit_companyName" name="edit_companyName" value="{{$data[0]->companyName}}">
			<span id="edit_companyName_error" style="color: red"></span>
		</div>
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
	</div>
	<div class="row">
		<div class="col-md-6">
			<label class="design">Position Of The Contact Person</label>
			<input type="text" class="form-control" id="edit_contactPerson" name="edit_contactPerson" value="{{$data[0]->contactPerson}}">
			<span id="edit_contactPerson_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Location</label>
			<input type="text" class="form-control" id="edit_leadLocation" name="edit_leadLocation" value="{{$data[0]->leadLocation}}">
			<span id="edit_leadLocation_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Status Of Lead</label>
			<select class="form-control" id="edit_leadStatus" name="edit_leadStatus">
				<option value="">Select</option>
				<?php foreach($status as $stat){?>
				<option <?php if($data[0]->leadStatus == $stat->statusName){ echo 'Selected';}?> value="{{$stat->statusName}}">{{$stat->statusName}}</option>
				<?php } ?>
			</select>
			<span id="edit_leadStatus_error" style="color: red"></span>
		</div>
		<?php if(Auth::user()->position == 'Super Admin'){?>
		<div class="col-md-6">
			<label class="design">Assigned To</label>
			<select class="form-control" id="edit_assignedTo" name="edit_assignedTo">
				   <option>Select</option>
				   <?php foreach($employee as $emp){?>
					<option <?php if($data[0]->assignedTo == $emp->employeeName){ echo 'Selected';}?> value="{{$emp->employeeName}}">{{$emp->employeeName}}</option>
				   <?php }?>
			</select>
			<span id="edit_assignedTo_error" style="color: red"></span>
		</div>
		<?php } else{?>
		<div class="col-md-6">
			<label class="design">Assigned To</label>
			<input type="text" class="form-control" id="assignedTo" name="assignedTo" value="{{$data[0]->assignedTo}}" readonly>
			<span id="edit_assignedTo_error" style="color: red"></span>
		</div>
		<?php } ?>
	</div>
	<?php if($data[0]->leadDate != NULL){?>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Date</label>
			<input type="date" class="form-control" id="edit_leadDate" name="edit_leadDate" value="{{$data[0]->leadDate}}">
			<span id="leadDate_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Time</label>
			<input type="time" class="form-control" id="edit_leadTime" name="edit_leadTime" value="{{$data[0]->leadTime}}">
			<span id="leadTime_error" style="color: red"></span>
		</div>
		<div class="col-md-12 mt-2">
			<label class="design">Notes</label>
			<textarea class="form-control" id="edit_notes" name="edit_notes">{{$data[0]->notes}}</textarea>
			<span id="notes_error" style="color: red"></span>
		</div>
	</div>
	<?php } else{?>
	<div class="row mt-2 leadInfo" style="display:none;">
		<div class="col-md-6">
			<label class="design">Date</label>
			<input type="date" class="form-control" id="edit_leadDate" name="edit_leadDate">
			<span id="leadDate_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Time</label>
			<input type="time" class="form-control" id="edit_leadTime" name="edit_leadTime" >
			<span id="leadTime_error" style="color: red"></span>
		</div>
		<div class="col-md-12 mt-2">
			<label class="design">Notes</label>
			<textarea class="form-control" id="edit_notes" name="edit_notes"></textarea>
			<span id="notes_error" style="color: red"></span>
		</div>
	</div>
	<?php } ?>
	<div class="buttons mt-4">
		<button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="saveEditLeadButton">Save Changes</button>
		<button type="button" class="btn btn-lg btn-danger" style="width: 257px;" id="editClose" data-dismiss="modal">Back</button>														
	</div>
</form>

