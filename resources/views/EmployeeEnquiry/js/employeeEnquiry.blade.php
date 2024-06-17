<script>
$('body').on('click','#viewEnquiryButton',function()
	{
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('viewEmployeeEnquiryDetails') }}",
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

$('body').on('click','#closeStatusModal',function(){
	$('#statusUpdateModal').modal('hide');
})

$('body').on('click','#updateStatusButton',function(){
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('updateEnquiryStatus') }}",
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
	
	$('body').on('click','.swal-button',function(){
	location.reload();
})


$('body').on('click','#deleteEnquiryButton',function() 
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
				url: "{{ route('deleteEnquiryDetails') }}",
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
</script>