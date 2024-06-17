<script>
    $('body').on('click','#viewFeedbackButton',function()
	{
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('viewFeedbackDetails') }}",
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
        $('#viewEnquiryModal').modal('show');	
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
	$('#viewEnquiryModal').modal('hide');
})

$('body').on('click','#deleteFeedbackButton',function() 
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
				url: "{{ route('deleteFeedbackDetails') }}",
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

	$('body').on('click','.swal-button',function(){
	location.reload();
    })
	
</script>