<form method="get">
		     @csrf
			<div class="row">
			    <div class="col-md-6">
				    <label>ID: {{$data[0]->id}}</label>
				</div>
			    <div class="col-md-6">
				    <label>Name: {{$data[0]->name}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Contact Number: {{$data[0]->phone}}</label>
				</div>
			    <div class="col-md-6">
				    <label>Email Address: {{$data[0]->email}}</label>
				</div>
			</div>
			<hr>
			<div class="row mt-2">
			    <div class="col-md-12">
				    <label>Enquiry Detail: {{$data[0]->tellus}}</label>
				</div>
			</div>
			<hr>
		    <div class="buttons mt-2">
			    <button type="button" class="btn btn-lg btn-danger" style="width: 291px; margin-left: 343px;" id="closeModal">Back</button>														
			</div>	
		</form>