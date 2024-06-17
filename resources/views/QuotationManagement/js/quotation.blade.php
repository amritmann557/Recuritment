<script>
(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;

                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

$('.total_amount').keyup(function(){
       
        var total_amount = $('.total_amount').val();
        var amount_received = $('.amount_received').val();
		$('.pending_balance').val(parseFloat(total_amount) - parseFloat(amount_received));
});

$('.amount_received').keyup(function(){
       
        var total_amount = $('.total_amount').val();
        var amount_received = $('.amount_received').val();
		$('.pending_balance').val(parseFloat(total_amount) - parseFloat(amount_received));
});

$('#saveQuotationDetails').click(function() {
	   //alert ('hello');
        var form = $('#add_Quotation_details')[0];
        var data = new FormData(form);

        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            url: "{{ route('QuotationManagement.quotationstore') }}",
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
                    $('#quotationNumber_error').html(err.quotationNumber)
                    $('#quotationDate_error').html(err.quotationDate)
                    $('#uploadQuotation_error').html(err.uploadQuotation)
                    if (err.quotationNumber) {
                        toastr.error(err.quotationNumber);
                    }
					if (err.quotationDate) {
                        toastr.error(err.quotationDate);
                    }
					if (err.uploadQuotation) {
                        toastr.error(err.uploadQuotation);
                    }					
                }
                console.log(error)
            }
        })
    });
	
	$('#add_Quotation_details :input').click(function() {
        $('#quotationNumber_error').html('')
        $('#quotationDate_error').html('')
        $('#uploadQuotation_error').html('')
    })
	
	$('body').on('click','.swal-button',function(){
	location.reload();
    })
	
	$('body').on('click','#viewQuotationButton',function()
	{
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('viewQuotationDetails') }}",
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
        $('#viewQuotationModal').modal('show');	
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
	$('#viewQuotationModal').modal('hide');
})

$('body').on('click','#editClose',function(){
	$('#editQuotationModal').modal('hide');
})

$('body').on('click','#editQuotationButton',function(){
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('editQuotationDetails') }}",
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
        $('#editQuotationModal').modal('show');	
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
	
$('body').on('click','#saveEditQuotationButton',function(){
		//alert('Hello');
		var brokerId = $('#editID').val();
                var form = $('#edit_quotation_details')[0];
                var data = new FormData(form);
				data.append('id',brokerId)
				var url= "{{ route('save_editQuotationDetails') }}";
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
                    $('#edit_quotationDate_error').html(err.edit_quotationDate)
                    $('#edit_quotationNumber_error').html(err.edit_quotationNumber)
                    if (err.edit_quotationDate) {
                        toastr.error(err.edit_quotationDate);
                    }
					if (err.edit_quotationNumber) {
                        toastr.error(err.edit_quotationNumber);
                    }					
                }
                console.log(error)
            }
        })
	});
	
$('#edit_quotation_details :input').click(function() {
        $('#edit_quotationDate_error').html('')
        $('#edit_quotationNumber_error').html('')
    })
	
$('body').on('click','#deleteQuotationButton',function() 
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
				url: "{{ route('deleteQuotationDetails') }}",
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