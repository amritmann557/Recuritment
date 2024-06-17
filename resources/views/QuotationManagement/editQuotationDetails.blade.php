<form method="post" id="edit_quotation_details">
	@csrf
	<input type="hidden" id="editID" name="editID" value="{{$data[0]->id}}">
	<input type="hidden" id="editQuotationPic" name="editQuotationPic" value="{{$data[0]->uploadQuotation}}">
	<div class="row">
		<div class="col-md-6">
			<label class="design">Quotation ID</label>
			<input type="text" class="form-control" value="{{$data[0]->unique_id}}" readonly>
		</div>
		<div class="col-md-6">
			<label class="design">Quotation Date</label>
			<input type="date" class="form-control" id="edit_quotationDate" name="edit_quotationDate" value="{{$data[0]->quotationDate}}">
			<span id="edit_quotationDate_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Quotation Number</label>
			<input type="text" class="form-control" id="edit_quotationNumber" name="edit_quotationNumber" value="{{$data[0]->quotationNumber}}">
			<span id="edit_quotationNumber_error" style="color: red"></span>
		</div>
		<div class="col-md-6">
			<label class="design">Customer Name</label>
			<input type="text" class="form-control" id="edit_customerName" name="edit_customerName" value="{{$data[0]->customerName}}">
			<span id="edit_customerName_error" style="color: red"></span>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-6">							    
			<label class="design">Total Amount</label>
			<input type="text" class="form-control edit_total_amount" id="edit_total_amount" name="edit_total_amount" value="{{$data[0]->total_amount}}">
			<span id="edit_total_amount_error" style="color: red"></span>								
		</div>
		<div class="col-md-6">
			<label class="design">Amount Recieved</label>
			<input type="text" class="form-control edit_amount_received" id="edit_amount_received" name="edit_amount_received" value="{{$data[0]->amount_received}}">
			<span id="edit_amount_received_error" style="color: red"></span>								
		</div>						    
	</div>
	<div class="row mt-2">
		<div class="col-md-6">
			<label class="design">Pending Balance</label>
			<input type="text" class="form-control edit_pending_balance" id="edit_pending_balance" name="edit_pending_balance" value="{{$data[0]->pending_balance}}">
			<span id="edit_pending_balance_error" style="color: red"></span>								
		</div>
		<div class="col-md-6">
			<label class="design">Upload Quotation</label>
			<input type="file" class="form-control" id="edit_uploadQuotation" name="edit_uploadQuotation" value="{{$data[0]->uploadQuotation}}">
			<span id="edit_uploadQuotation_error" style="color: red"></span>
		</div>
	</div>
	<div class="buttons mt-4">
		<button type="button" class="btn btn-lg btn-primary" style="width: 257px;margin-left:288px;" id="saveEditQuotationButton">Save Changes</button>
		<button type="button" class="btn btn-lg btn-danger" style="width: 257px;" id="editClose" data-dismiss="modal">Back</button>														
	</div>
</form>

<script>
$('.edit_total_amount').keyup(function(){
       
        var total_amount = $('.edit_total_amount').val();
        var amount_received = $('.edit_amount_received').val();
		$('.edit_pending_balance').val(parseFloat(total_amount) - parseFloat(amount_received));
});

$('.edit_amount_received').keyup(function(){
       
        var total_amount = $('.edit_total_amount').val();
        var amount_received = $('.edit_amount_received').val();
		$('.edit_pending_balance').val(parseFloat(total_amount) - parseFloat(amount_received));
});
</script>

