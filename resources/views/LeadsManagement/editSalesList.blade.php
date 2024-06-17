<div class="card-body">
	<form method="post" id="edit_design_details">
		@csrf
		<input type="hidden" id="editDesignID" name="editDesignID" value="{{$data[0]->id}}">
		<input type="hidden" id="productID" name="productPhoto" value="{{$data[0]->designImage}}">
		<div class="row">
			<div class="col-md-12">
				<label class="design">Upload Design Image</label>
				<img src="<?php echo $data[0]->designImage;?>" style="width: 300px;">
			</div>
			<div class="col-md-12">
				<label class="design">Reupload Design Image</label>
				<input type="file" class="form-control" id="editDesignImage" name="editDesignImage">
				<span id="edit_designImage_error" style="color: red"></span>
			</div>
			<div class="col-md-12 mt-3">
				<label class="design">Notes for Designer</label>
				<textarea class="form-control" id="editDesignerNotes" name="editDesignerNotes" placeholder="Optional...."><?php echo $data[0]->designerNotes ?></textarea>
				<span id="edit_designerNotes_error" style="color: red"></span>
			</div>
		</div>
		<div class="buttons mt-3">
			<button type="button" class="btn btn-lg btn-primary" id="edituploadDesignDetails">Edit Sale</button>
			<button type="button" class="btn btn-lg btn-danger"  data-dismiss="modal">Back</button>														
		</div>
	</form>	
</div>