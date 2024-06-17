@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reset Password</div>

                <div class="card-body">
                    

                    <form method="POST" id="resetPasswordForm">
                        @csrf
                         <div class="row mb-3">
                            <label for="password">Registered Email Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>
                                <span id="email_error" style="color: red"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password">New Password</label>
                            <div class="col-md-6">
                                <input id="newPassword" type="password" class="form-control" name="newPassword" required>
                                <span id="newPassword_error" style="color: red"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" required>
                                <span id="confirmPassword_error" style="color: red"></span>
                                <span id="message"></span>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8">
                                <button type="button" class="btn btn-primary resetPass" style="float:left;" id="resetPass">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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


    $('#confirmPassword').donetyping(function () {
  if ($('#newPassword').val() == $('#confirmPassword').val()) {
    $('#message').html('Password Matched').css('color', 'green');
    $('.resetPass').prop('disabled', false);
  } else {
    $('#message').html('Paasword Not Matched').css('color', 'red');
    $('.resetPass').prop('disabled', true);
    }
});
    $('#resetPass').click(function() {
	   //alert ('hello');
        var form = $('#resetPasswordForm')[0];
        var data = new FormData(form);

        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            url: "saveResetPassword",
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
					toastr.success(data.message).fadeOut(3000);
                }
				else{
					toastr.error("Error While Updating Password");
				}
				window.location.href="https://recruitment.peopleschoice.co.in/public/";
				
            },
            error: function(error) {
                $('#loader').hide()
                var err = error.responseJSON.errors;
                if (error.status == 422) {
                    toastr.error("Error");
                    $('#newPassword_error').html(err.newPassword)
                    $('#email_error').html(err.email)
                    $('#confirmPassword_error').html(err.confirmPassword)
                    if (err.newPassword) {
                        toastr.error(err.newPassword);
                    }
					if (err.confirmPassword) {
                        toastr.error(err.confirmPassword);
                    }
                    if (err.email) {
                        toastr.error(err.email);
                    }
                }
                console.log(error)
            }
        })
    });
	
	$('#resetPasswordForm :input').click(function() {
        $('#newPassword_error').html('')
        $('#confirmPassword_error').html('')
        $('#email_error').html('')
    })
    
    $('body').on('click','.swal-button',function(){
	location.reload();
})
</script>
@endsection
