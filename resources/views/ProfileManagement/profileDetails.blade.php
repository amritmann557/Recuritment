@extends('layouts_new.app_new')
@section('content')
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Profile</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item">Profile</li>
    </ul>
    <div class="section-body">
	    <div class="row mt-sm-4">
	        <div class="col-12 col-md-12 col-lg-4">
		        <div class="card author-box">
		            <div class="card-body">
			            <div class="author-box-center">
							<?php if(Auth::user()->gender == 'Female'){?>
							    <img alt="image" src="assets/img/user.png" class="rounded-circle author-box-picture">
							<?php } ?> 
							<?php if(Auth::user()->gender == 'Male'){?>
							    <img alt="image" src="assets/img/users/user-8.png" class="rounded-circle author-box-picture">
							<?php } ?>
							<?php if(Auth::user()->gender == 'Others'){?>
							    <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle author-box-picture">
							<?php } ?> 
							<div class="clearfix"></div>
			                <div class="author-box-name">
				                <a href="#">{{Auth::user()->name;}}</a>
			                </div>
			                <div class="author-box-job">{{Auth::user()->position;}}</div>
			            </div>
		            </div>
		        </div>
	        </div>
	        <div class="col-12 col-md-12 col-lg-8">
		        <div class="card">
		            <div class="padding-20">
						<ul class="nav nav-tabs" id="myTab2" role="tablist">
						  <li class="nav-item">
							<a class="nav-link active" id="profile-tab2" data-bs-toggle="tab" href="#settings" role="tab"
							  aria-selected="false">Personal Details</a>
						  </li>
						</ul>
			            <div class="tab-content tab-bordered" id="myTab3Content">
			                <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
				                <form method="post" class="needs-validation">
									<div class="card-header">
										<h4>Edit Profile</h4>
									</div>
				                    <div class="card-body">
									<div class="row">
									    <div class="form-group col-md-6 col-12">
										    <label>Employee Name</label>
										    <input type="text" class="form-control" value="{{$employee[0]->employeeName;}}" Readonly>
									    </div>
									    <div class="form-group col-md-6 col-12">
										    <label>Contact Number</label>
										    <input type="text" class="form-control" value="{{$employee[0]->contact_number}}" readonly>
									    </div>
									</div>					    
					                <div class="row">
					                    <div class="form-group col-md-7 col-12">
						                    <label>Email</label>
						                    <input type="email" class="form-control" value="{{$employee[0]->email}}"Readonly>
					                    </div>
					                </div>
							    </div>
				                <!-- div class="card-footer text-end">
					                <button class="btn btn-primary">Save Changes</button>
				                </div -->
				            </form>
			            </div>
			        </div>
		        </div>
		    </div>
	    </div>
	</div>
</div>
</section>
@section('javascript')
@include('ProfileManagement.js.employee')
@endsection
@endsection