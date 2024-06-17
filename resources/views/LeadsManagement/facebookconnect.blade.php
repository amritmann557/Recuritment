@extends('layouts_new.app_new')
@section('content')
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Leads Management</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Leads Management</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Leads Management</h4>
		        </div>
				<!-- div class="buttons mt-3">
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="float:right;margin-right:31px;width:170px;">Add Lead</button>
                </div -->
		        <div class="card-body">
			        <div class="row">
			            <div class="col-md-6">
			             <button class="bt btn-primary" id="facebookButton" name="facebookButton" onclick="myFacebookLogin()">Connect With Facebook</button>
			            </div>
			        </div>
		        </div>
		    </div>
	    </div>
    </div> 
</section>
<!-- End View Staff Details Modal -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '776863757522205',
      cookie     : true,
      xfbml      : true,
      version    : 'v19.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

function myFacebookLogin() {
    FB.login(function(response){
		jQuery.ajax({
          type: "POST",
          url: "{{ route('callback') }}",
		  headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
          beforeSend: function() { jQuery('#wait').show()},
          complete: function() { jQuery('#wait').hide() },
          data: {'postdata':response},
          dataType: 'json',
		  success : function (data) {
                $("#resultMsg").html('<div class="ajax_report alert-message alert alertSuccess updatecartDetail" style="color:green;font-size:18px;" role="alert"><span class="ajax_message updateclientmessage">Facebook Account Connected successfully .</span></div>').fadeOut(5000);
				setTimeout(window.location.reload(), 5000);	
            }
      });

  }, {scope: 'ads_management,ads_read,read_insights,business_management,public_profile,catalog_management,pages_show_list,pages_read_engagement,pages_manage_ads',return_scopes: true});
  }
</script>
@endsection