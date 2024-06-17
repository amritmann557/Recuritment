@extends('layouts_new.app_new')
@section('content')
<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Sales</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Sales</li>
	  </ul>
    <div class="row">
	    <div class="col-12">
		    <div class="card">
		        <div class="card-header">
			        <h4>Sales</h4>
		        </div>
				<!-- div class="buttons mt-3">
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="float:right;margin-right:31px;width:170px;">Add Lead</button>
                </div -->
		        <div class="card-body">
			        <div class="table-responsive">
			            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
							<thead>
							    <tr>
									<th class="text-center">
									  #
									</th>
									<th>Design Image</th>
									<th>Lead ID</th>
									<th>Name</th>
									<th>Company Name</th>
									<th>Contact Number</th>
									<th>Actions</th>
							    </tr>
							</thead>
							<tbody>
							    @foreach($sales as $key=>$data)
									<tr>
										<td class="text-center">{{$key+1}}</td>
										<?php if($data->designImage == NULL){?>
										<td>NO Image Uploaded Yet</td>
										<?php } else{?>
										<td><img src="<?php echo $data->designImage;?>" style="width: 60px;"></td>
										<?php } ?>
										<td>{{$data->unqiue_id}}</td>
										<td>{{$data->leadName}}</td>									   
										<td>{{$data->companyName}}</td>									   
										<td>{{$data->contact_number}}</td>									   										
										<td>
											<a href="#" rel="{{$data->id}}" class="btn btn-primary" id="editImageButton">Edit</a>
											<a href="download_Design?id={{$data->id}}" class="btn btn-primary" id="downloadImageButton">Download Design</a>
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

<!-- Start View Student Details Modal -->
<div class="modal fade bd-example-modal-md" id="editSalesModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">Edit Sales Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body">
				    <section class="section">
					    <!-- ul class="breadcrumb breadcrumb-style ">
							<li class="breadcrumb-item">
							  <h4 class="page-title m-b-0">Sales Management</h4>
							</li>
							<li class="breadcrumb-item">
							  <a href="{{route('home')}}">
								<i data-feather="home"></i></a>
							</li>
							<li class="breadcrumb-item">Edie Sales Details</li>
					    </ul -->
					    <div class="section-body" id="view_Details">
					    
						</div>
                    </section>
				</div>
	        </div>    
		</div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="editLeadsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="myLargeModalLabel">Edit Lead Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="modal-body">
			    <div class="card-body" id="show_edit_Details">
					
				</div>
	        </div>    
		</div>
    </div>
</div>
<!-- End View Staff Details Modal -->
@section('javascript')
@include('LeadsManagement.js.leads')
@endsection
@endsection