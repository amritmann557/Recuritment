<script>
$(document).ready(function() {
	$('body').on('click','#saveDesignationDetails',function(){
		var form = $('#designationForm')[0];
        var data = new FormData(form);
        $.ajax({
            url: "{{ route('masterModules.designationstore') }}",
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
                    $('#designationName_error').html(err.designationName)					
                }
                console.log(error)
            }
        })
	})
	
	$('#designationForm :input').click(function() {
	$('#designationName_error').html('')                
    })
	
	$('body').on('click','.swal-button',function(){
		location.reload();
	})
	
	$('body').on('click','#editDesignation',function(){
		var id=$(this).attr('rel');
		$.ajax({
		url: "{{ route('editDesignationDetails') }}",
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
	
	$('body').on('click','#saveEditDesignationbutton',function(){
		var id = $('#editID').val();
		var form = $('#editDesignationForm')[0];
        var data = new FormData(form);
		data.append('id',id)
        $.ajax({
            url: "{{ route('saveEditDesignationDetails') }}",
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
                    $('#edit_designationName_error').html(err.edit_designationName)					
                }
                console.log(error)
            }
        })
	})
	
	$('#editDesignationForm :input').click(function() {
	$('#edit_designationName_error').html('')                
    })
	
	$('body').on('click','#deleteDesignation',function() 
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
						url: "{{ route('deleteDesignationDetails') }}",
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