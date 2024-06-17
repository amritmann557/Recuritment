<script>
var room = 1;
function repair_fields() {
 
    room++;
    var objTo = document.getElementById('repair_fields')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="row mt-2"><div class="col-md-6"><label class="design">Product Code/Details</label><input type="text" class="form-control" id="productCode" name="productCode[]"><span id="productCode_error" style="color: red"></span></div><div class="col-md-6"><label class="design">Price Details</label><input type="text" class="form-control" id="priceDetails" name="priceDetails[]"><span id="priceDetails_error" style="color: red"></span></div></div><div class="row mt-2"><div class="col-md-6"><label class="design">Quantity</label><input type="text" class="form-control" id="quantity" name="quantity[]"><span id="quantity_error" style="color: red"></span></div><div class="col-md-6"><label class="design">Manufactured By</label><input type="text" class="form-control" id="manufacturedBy" name="manufacturedBy[]"><span id="manufacturedBy_error" style="color: red"></span></div></div><div class="col-sm-3 nopadding><div class="form-group"><button class="btn btn-danger" style="margin-top: 10px;" type="button" onclick="remove_education_fields('+ room +');"> Remove</button></div></div><div class="clear"></div>';
    objTo.appendChild(divtest)
}
function remove_education_fields(rid) {
   $('.removeclass'+rid).remove();
}

var room = 1;
function edit_repair_fields() {
 
    room++;
    var objTo = document.getElementById('edit_repair_fields')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="row mt-2"><div class="col-md-6"><label class="design">Product Code/Details</label><input type="text" class="form-control" id="new_edit_productCode" name="new_edit_productCode[]"><span id="new_edit_productCode_error" style="color: red"></span></div><div class="col-md-6"><label class="design">Price Details</label><input type="text" class="form-control" id="new_edit_priceDetails" name="new_edit_priceDetails[]"><span id="new_edit_priceDetails_error" style="color: red"></span></div></div><div class="row mt-2"><div class="col-md-6"><label class="design">Quantity</label><input type="text" class="form-control" id="new_edit_quantity" name="new_edit_quantity[]"><span id="new_edit_quantity_error" style="color: red"></span></div><div class="col-md-6"><label class="design">Manufactured By</label><input type="text" class="form-control" id="new_edit_manufacturedBy" name="new_edit_manufacturedBy[]"><span id="new_edit_manufacturedBy_error" style="color: red"></span></div></div><div class="col-sm-3 nopadding><div class="form-group"><button class="btn btn-danger" style="margin-top: 10px;" type="button" onclick="remove_education_fields('+ room +');"> Remove</button></div></div><div class="clear"></div>';
    objTo.appendChild(divtest)
}
function remove_education_fields(rid) {
   $('.removeclass'+rid).remove();
}

$('#saveSalesOrderDetails').click(function() {
	   //alert ('hello');
        var form = $('#add_saleOrder_details')[0];
        var data = new FormData(form);

        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            url: "{{ route('WorkOrder.workOrderstore') }}",
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
                    $('#orderDate_error').html(err.orderDate)
                    $('#customerName_error').html(err.customerName)
                    $('#ownerTo_error').html(err.ownerTo)
                    $('#orderTo_error').html(err.orderTo)
                    $('#jobName_error').html(err.jobName)
                    $('#productCode_error').html(err.productCode)
                    $('#manufacturedBy_error').html(err.manufacturedBy)
                    $('#uploadImage_error').html(err.uploadImage)
                    if (err.orderDate) {
                        toastr.error(err.orderDate);
                    }
					if (err.customerName) {
                        toastr.error(err.customerName);
                    }
					if (err.ownerTo) {
                        toastr.error(err.ownerTo);
                    }
                    if (err.orderTo) {
                        toastr.error(err.orderTo);
                    }
                    if (err.jobName) {
                        toastr.error(err.jobName);
                    }
                    if (err.productCode) {
                        toastr.error(err.productCode);
                    }
                    if (err.manufacturedBy) {
                        toastr.error(err.manufacturedBy);
                    }
                    if (err.uploadImage) {
                        toastr.error(err.uploadImage);
                    }					
                }
                console.log(error)
            }
        })
    });
	
	$('#add_saleOrder_details :input').click(function() {
        $('#orderDate_error').html('')
        $('#customerName_error').html('')
        $('#ownerTo_error').html('')
        $('#orderTo_error').html('')
        $('#jobName_error').html('')
        $('#productCode_error').html('')
        $('#manufacturedBy_error').html('')
        $('#uploadImage_error').html('')
    })
	
	$('body').on('click','.swal-button',function(){
	location.reload();
    })
	
	$('body').on('click','#viewSalesOrderButton',function()
	{
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('viewSalesOrder') }}",
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
        $('#viewSalesOrderModal').modal('show');	
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
	$('#viewSalesOrderModal').modal('hide');
})

$('body').on('click','#editClose',function(){
	$('#editWorkOrderModal').modal('hide');
})

$('body').on('click','#editSalesOrderButton',function(){
	var id=$(this).attr('rel');
    $.ajax({
    url: "{{ route('editSalesOrder') }}",
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
        $('#editWorkOrderModal').modal('show');	
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
	
$('body').on('click','#removeWork',function() 
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
				url: "{{ route('deletework') }}",
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

$('body').on('click', '#saveEditSalesButton', function(e) {
	var form = $('#edit_salesOrder_details')[0];
	var data = new FormData(form);
	var url = "{{ route('save_editSalesOrder') }}";
	$.ajax({
		url: url,
		headers: {
			'X-CSRF-TOKEN': $('input[name="_token"]').val()
		},
		type: 'post',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		dataType: 'json',
		beforeSend: function() {
			$('#user_loder').show()
		},
		success: function(data) {
			// console.log(data);

			if (data.status == 'success') 
			{
				if (data.status == 'success') 
				{
					swal("Good Job", data.message, "success");
				}
				else
				{
					swal("Error Occur", "There is some issue while Updating", "error");
				}
			} 
			else if (data.status == 'error') 
			{                    
				$.each(data.error1, function(key, value) {                           
					
					var temp_key = key.replace(".", "_");
					$("#edit_" + temp_key + "_error").text(value);
					$("#edit_" + temp_key + "_error").show().delay(5000).fadeOut();
				});                        

				var temp_i = 0;

				$('.edit_count_class').each(function(index, item){
					var temp_length = $(item).attr('length');
					
					$.each(data.error2, function(key, value) {                           
						
						var temp_key = key.replace("."+temp_i, "_"+temp_length);
						$("#" + temp_key + "_error").text(value);
						$("#" + temp_key + "_error").show().delay(5000).fadeOut();  
					});     
					
					temp_i++;
				});
			}
			else
			{
				swal("Good Job", data.message, "success");
			}                    
		},
		error: function(error) {
			var err = error.responseJSON.errors;
			if (error.status == 422) {
				toastr.error("Error");
				$('#edit_orderDate_error').html(err.edit_orderDate)
				$('#edit_customerName_error').html(err.edit_customerName)
				$('#edit_ownerTo_error').html(err.edit_ownerTo)
				$('#edit_orderTo_error').html(err.edit_orderTo)
				$('#edit_jobName_error').html(err.edit_jobName)
				$('#edit_productCode_error').html(err.edit_productCode)
				$('#edit_manufacturedBy_error').html(err.edit_manufacturedBy)
				
				if (err.edit_orderDate) {
					toastr.error(err.edit_orderDate);
				}
				if (err.edit_customerName) {
					toastr.error(err.edit_customerName);
				}
				if (err.edit_ownerTo) {
					toastr.error(err.edit_ownerTo);
				}
				if (err.edit_orderTo) {
					toastr.error(err.edit_orderTo);
				}
				if (err.edit_jobName) {
					toastr.error(err.edit_jobName);
				}
				if (err.edit_productCode) {
					toastr.error(err.edit_productCode);
				}
				if (err.edit_manufacturedBy) {
					toastr.error(err.edit_manufacturedBy);
				}
											
			}
			console.log(error);
		}
	});

	e.preventDefault();
});
	
$('#edit_salesOrder_details :input').click(function() {
        $('#edit_orderDate_error').html('')
        $('#edit_customerName_error').html('')
        $('#edit_ownerTo_error').html('')
        $('#edit_orderTo_error').html('')
        $('#edit_jobName_error').html('')
        $('#edit_productCode_error').html('')
        $('#edit_manufacturedBy_error').html('')
        
    })
	
$('body').on('click','#deleteSalesOrderButton',function() 
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
				url: "{{ route('deleteworkOrderDetails') }}",
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