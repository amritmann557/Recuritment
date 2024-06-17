<script>
$('#saveJobDetails').click(function() {
	   //alert ('hello');
        var form = $('#postJob_details')[0];
        var data = new FormData(form);

        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            url: "{{ route('JobManagement.jobManagementstore') }}",
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
                    $('#jobTitle_error').html(err.jobTitle)
                    $('#description_error').html(err.description)
                    $('#experience_error').html(err.experience)
                    $('#language_error').html(err.language)
                    $('#gender_error').html(err.gender)
                    $('#salary_error').html(err.salary)
                    $('#vacancy_error').html(err.vacancy)
                    $('#status_error').html(err.status)
                    if (err.jobTitle) {
                        toastr.error(err.jobTitle);
                    }
					if (err.description) {
                        toastr.error(err.description);
                    }
					if (err.experience) {
                        toastr.error(err.experience);
                    }
                    if (err.language) {
                        toastr.error(err.language);
                    }
                    if (err.gender) {
                        toastr.error(err.gender);
                    }
                    if (err.salary) {
                        toastr.error(err.salary);
                    }
                    if (err.vacancy) {
                        toastr.error(err.vacancy);
                    }
                    if (err.status) {
                        toastr.error(err.status);
                    }					
                }
                console.log(error)
            }
        })
    });
	
	$('#postJob_details :input').click(function() {
        $('#jobTitle_error').html('')
        $('#description_error').html('')
        $('#experience_error').html('')
        $('#language_error').html('')
        $('#gender_error').html('')
        $('#salary_error').html('')
        $('#vacancy_error').html('')
        $('#status_error').html('')
    })
	
	$('body').on('click','.swal-button',function(){
	location.reload();
    })
	
	$('body').on('click','#viewLeadsButton',function()
	{
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('viewJobDetails') }}",
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
        $('#view_Details').html(data);
        $('#viewLeadModal').modal('show');	
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
	
$('body').on('click','#closeModal',function(){
	$('#viewLeadModal').modal('hide');
})

$('body').on('click','#deleteLeadButton',function() 
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
				url: "{{ route('deleteJobDetails') }}",
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

$('body').on('click','#editClose',function(){
	$('#editLeadsModal').modal('hide');
})

$('body').on('click','#editLeadButton',function(){
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('editJobDetails') }}",
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
        $('#editLeadsModal').modal('show');	
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
	
$('body').on('click','#updateJobDetails',function(){
		//alert('Hello');
		var brokerId = $('#editID').val();
                var form = $('#edit_Job_details')[0];
                var data = new FormData(form);
				data.append('id',brokerId)
				var url= "{{ route('saveEditJobDetails') }}";
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
                    $('#edit_jobTitle_error').html(err.edit_jobTitle)
                    $('#edit_description_error').html(err.edit_description)
                    $('#edit_experience_error').html(err.edit_experience)
                    $('#edit_language_error').html(err.edit_language)
                    $('#edit_gender_error').html(err.edit_gender)
                    $('#edit_salary_error').html(err.edit_salary)
                    $('#edit_vacancy_error').html(err.edit_vacancy)
                    $('#edit_status_error').html(err.edit_status)
                    if (err.edit_jobTitle) {
                        toastr.error(err.edit_jobTitle);
                    }
					if (err.edit_description) {
                        toastr.error(err.edit_description);
                    }
					if (err.edit_experience) {
                        toastr.error(err.edit_experience);
                    }
                    if (err.edit_language) {
                        toastr.error(err.edit_language);
                    }
                    if (err.edit_gender) {
                        toastr.error(err.edit_gender);
                    }
                    if (err.edit_salary) {
                        toastr.error(err.edit_salary);
                    }
                    if (err.edit_vacancy) {
                        toastr.error(err.edit_vacancy);
                    }
                    if (err.edit_status) {
                        toastr.error(err.edit_status);
                    }					
                }
                console.log(error)
            }
        })
	});
	
$('#edit_Job_details :input').click(function() {
        $('#edit_jobTitle_error').html('')
        $('#edit_description_error').html('')
        $('#edit_experience_error').html('')
        $('#edit_language_error').html('')
        $('#edit_gender_error').html('')
        $('#edit_salary_error').html('')
        $('#edit_vacancy_error').html('')
        $('#edit_status_error').html('')
    })
</script>