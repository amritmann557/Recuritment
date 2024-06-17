<form method="post" id="update_status_Form">
	@csrf
	<input type="hidden" id="updateStatusID" name="updateStatusID" value="{{$data[0]->id}}">
	<div class="row">
		<div class="col-md-12">
			<label class="design">Select Status</label>
			<select class="form-control" id="statusUpdate" name="statusUpdate">
							<option value="">Select</option>
							@foreach($update as $status)
							<option <?php if($data[0]->status == $status->statusName){ echo 'Selected'; }?> value="{{$status->statusName}}">{{$status->statusName}}</option>
							@endforeach
						</select>
			<span id="statusUpdate_error" style="color: red"></span>
		</div>
	</div>
	<div class="buttons mt-5">
		<button type="button" class="btn btn-lg btn-primary" id="UpdateStatusButton">Update Status</button>
		<button type="button" class="btn btn-lg btn-danger"  data-dismiss="modal" id="closeStatusModal">Back</button>														
	</div>
</form>

<script>
$('#UpdateStatusButton').click(function() {
	   //alert ('hello');
        var form = $('#update_status_Form')[0];
        var data = new FormData(form);

        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            url: "{{ route('updateWebsiteLeadStatus') }}",
			headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('#loader').show()
            },
            success: function(data) {
                $('#loader').hide()
                if (data.status == 'success') {
					swal("Good Job", data.message, "success");
                }
				else{
					swal("Error Occur", "There is some issue while saving data", "error");
				}
            },
            error: function(error) {
                $('#loader').hide()
                var err = error.responseJSON.errors;
                if (error.status == 422) {
                    toastr.error("Error");
                    $('#statusUpdate_error').html(err.statusUpdate)
                    if (err.statusUpdate) {
                        toastr.error(err.statusUpdate);
                    }
                }
                console.log(error)
            }
        })
    });
	
	$('#update_status_Form :input').click(function() {
        $('#statusUpdate_error').html('')
    })
</script>