@extends('layouts_new.app_new')

@section('content')
<style>
    .required:after{ 
        content:'*'; 
        color:red; 
        padding-left:5px;
    }
</style>
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Master Options</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Status Master</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Status Master</h4>
		        </div>
				<div class="buttons mt-3">
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float:right;margin-right:31px;width:170px;">Add Status</button>
                </div>
		        <div class="card-body">
			        <div class="table-responsive">
			            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
							<thead>
							    <tr>
									<th class="text-center">
									  #
									</th>
									<th>ID</th>
									<th>Status Name</th>
									<th>Actions</th>
							    </tr>
							</thead>
							<tbody>
							    @foreach($result as $key=>$data)
									<tr>
										<td class="text-center">{{$key+1}}</td>
										<td>{{$data->unique_id}}</td>
										<td>{{$data->statusName}}</td>									   
										<td>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="editStatus">Edit</a>
											<a href="#" class="btn btn-primary" rel="{{$data->id}}" id="deleteStatus">Delete</a>
										</td>
									</tr>
                                @endforeach
						    </tbody>
			            </table>
			        </div>
		        </div>
		    </div>
	    </div>
    </div> 
</section>
<!-- Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="modal-header">
				<h5 class="modal-title" id="formModal">Add Status Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
		    <div class="modal-body">
			    <form id="statusForm">
				@csrf
				    <div class="form-group">
					    <label>ID</label>
						<div class="input-group">
						  <input type="text" class="form-control" placeholder="Auto Generated" readonly>
						</div>
				    </div>
			        <div class="form-group">
				        <label>Status Name</label>
						<div class="input-group">
						    <input type="text" class="form-control" placeholder="Status Name" name="statusName" id="statusName">
							<span id="statusName_error" style="color: red"></span>
						</div>
			        </div>
			        <button type="button" class="btn btn-primary m-t-15 waves-effect" id="saveStatusDetails">Save</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<!-- End Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="modal-header">
				<h5 class="modal-title" id="formModal">Edit Status Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
		    <div class="modal-body" id="showDetails">
			    
		    </div>
		</div>
	</div>
</div>
<!-- End Modal -->

@section('javascript')
@include('masterModules.js.status')
@endsection
@endsection