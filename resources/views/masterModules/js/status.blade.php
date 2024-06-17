<script>
$(document).ready(function() {
	$('body').on('click','#saveStatusDetails',function(){
		var form = $('#statusForm')[0];
        var data = new FormData(form);
        $.ajax({
            url: "{{ route('masterModules.statusstore') }}",
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
                    $('#statusName_error').html(err.statusName)					
                }
                console.log(error)
            }
        })
	})
	
	$('#statusForm :input').click(function() {
	$('#statusName_error').html('')                
    })
	
	$('body').on('click','.swal-button',function(){
		location.reload();
	})
	
	$('body').on('click','#editStatus',function(){
		var id=$(this).attr('rel');
		$.ajax({
		url: "{{ route('editStatusDetails') }}",
		type: "get",
		data: 
		{
			"_token": "{{ csrf_token() }}",
			 id: id
		},
		dataType: "html",
		beforeSend: function() 
		{
			$('#loader').show()
		},
		success: function(data) 
		{
			$('#loader').hide();
			$('#showDetails').html(data);
			$('#editModal').modal('show');		
		},
		error: function() 
		{
			$('#loader').hide();
			alert("Fail")
		}
		})
	})
	
	$('body').on('click','#saveEditStatusbutton',function(){
		var id = $('#editID').val();
		var form = $('#editStatusForm')[0];
        var data = new FormData(form);
		data.append('id',id)
        $.ajax({
            url: "{{ route('saveEditStatusDetails') }}",
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
                if (data.status == 'success') {
					swal("Good Job", data.message, "success");
                }
				else{
					swal("Error Occur", "There is some issue while Updating", "error");
				}
                
            },
            error: function(error) {
                $('#loader').hide()
                var err = error.responseJSON.errors;
                if (error.status == 422) {
                    $('#edit_statusName_error').html(err.edit_statusName)					
                }
                console.log(error)
            }
        })
	})
	
	$('#editStatusForm :input').click(function() {
	$('#edit_statusName_error').html('')                
    })
	
	$('body').on('click','#deleteStatus',function() 
	{
		var delID= $(this).attr('rel');
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => 
			{
			     if (willDelete) 
				 {
					$.ajax({
						url: "{{ route('deleteStatusDetails') }}",
						type: "post",
						dataType: 'json',
						data: {
							"_token": "{{ csrf_token() }}",
							id: delID,
						},
						beforeSend: function() {
							$('#loader').show()
						},
						success: function(data) 
						{
							if (data.status == 'success') 
							{
								swal("Poof! Your data has been deleted!", {
									icon: "success",
								  });
							} 
							else
							{
								swal("Error", "Data Not Deleted!", "error");
							}
						}
					})
		        }
			    else {
				        swal("Your data is safe!");
				    }
			});
            })
});


</script>