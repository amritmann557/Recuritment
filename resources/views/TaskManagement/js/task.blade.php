<script>
$('body').on('click','#addBtn',function(){
	$('#taskForm').modal('show');
})

$('#submitData').click(function() {
	   //alert ('hello');
        var form = $('#myForm')[0];
        var data = new FormData(form);

        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            url: "{{ route('TaskManagement.taskstore') }}",
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
                    $('#staffName_error').html(err.staffName)
                    $('#title_error').html(err.title)
                    $('#date_error').html(err.date)
                    $('#priority_error').html(err.priority)
                    if (err.staffName) {
                        toastr.error(err.staffName);
                    }
					if (err.title) {
                        toastr.error(err.title);
                    }
					if (err.date) {
                        toastr.error(err.date);
                    }
					if (err.priority) {
                        toastr.error(err.priority);
                    }					
                }
                console.log(error)
            }
        })
    });
	
	$('#myForm :input').click(function() {
        $('#staffName_error').html('')
        $('#title_error').html('')
        $('#date_error').html('')
        $('#priority_error').html('')
    })
	
$('body').on('click','.swal-button',function(){
	location.reload();
})

$('body').on('click','#editTaskButton',function(){
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('editTaskDetails') }}",
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
        $('#show_edit_Details').html(data);
        $('#editTaskModal').modal('show');	
        $('#loader').hide();		
		//alert("Pass")	
    },
    error: function() 
	{
        $('#loader').hide();
        alert("Fail")
    }
    })
	});
	
$('body').on('click','#edit_submitData',function(){
		//alert('Hello');
		var brokerId = $('#editID').val();
                var form = $('#edit_task_details')[0];
                var data = new FormData(form);
				data.append('id',brokerId)
				var url= "{{ route('save_editTaskDetails') }}";
                toastr.options = 
				{
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };
            $.ajax
			({
                url: url,
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
            error: function(error) 
			{
                $('#loader').hide()
                var err = error.responseJSON.errors;
                if (error.status == 422) {
                    toastr.error("Error");
                    $('#edit_staffName_error').html(err.edit_staffName)
                    $('#edit_title_error').html(err.edit_title)
                    $('#edit_date_error').html(err.edit_date)
                    $('#edit_priority_error').html(err.edit_priority)
                    if (err.edit_staffName) {
                        toastr.error(err.edit_staffName);
                    }
					if (err.edit_title) {
                        toastr.error(err.edit_title);
                    }
					if (err.edit_date) {
                        toastr.error(err.edit_date);
                    }
					if (err.edit_priority) {
                        toastr.error(err.edit_priority);
                    }				
                }
                console.log(error)
            }
        })
	});
	
$('#edit_task_details :input').click(function() {
        $('#edit_staffName_error').html('')
        $('#edit_title_error').html('')
        $('#edit_date_error').html('')
        $('#edit_priority_error').html('')
    })
	
$('body').on('click','#deleteTaskButton',function() 
{
var delID= $(this).attr('rel');
//alert(delID)
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
				url: "{{ route('deleteTaskDetails') }}",
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

$('body').on('click','#statusButton',function(){
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('updateTaskStatus') }}",
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
        $('#status_details').html(data);
        $('#statusUpdateModal').modal('show');	
        $('#loader').hide();		
		//alert("Pass")	
    },
    error: function() 
	{
        $('#loader').hide();
        alert("Fail")
    }
    })
	});
	
$('body').on('click','#all',function(){
	window.location.replace("{{ route('TaskManagement.task') }}");
})
</script>