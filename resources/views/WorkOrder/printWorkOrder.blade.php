<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    /* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 7.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #e40101; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 95%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
article address.norm h4 {
	font-size: 125%;
	font-weight: bold;
}
article address.norm { float: left; font-size: 95%; font-style: normal; font-weight: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th:first-child {
	width:32%;
}
table.inventory th:nth-child(2) {
	width:32%;
}
table.inventory th:nth-child(3) {
	width:32%;
}
table.inventory th:nth-child(4) {
	width:32%;
}
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 15%; }
table.inventory td:nth-child(2) { width: 15%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }
table.inventory td:nth-child(6) { text-align: right; width: 12%; }
table.inventory td:nth-child(7) { text-align: right; width: 12%; }
table.inventory td:nth-child(8) { text-align: right; width: 12%; }
table.inventory td:nth-child(9) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

table.sign {
	float: left;
	width: 100%;
}
table.sign img {
	width: 100%;
}
table.sign tr td {
	border-color: transparent;
}
label{
	font-weight: 700;
}
@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
</style>
</head>
<!------ Include the above in your HEAD tag ---------->

		<header>
			<h1 style="background-color:black;">Work Order For {{$result[0]->jobName}}</h1>
			<div class="row mt-4">
			    <div class="col-md-7">
					<address >
						<p style="margin-top: 22px;font-weight: 700;"> ROGER GEAR </p>
						<p style="font-weight: 700;"> Plot No. 96, Industrial Area Business Park</p>
						<p style="font-weight: 700;"> Phase-1, Chandigarh- 160002  </p>
					</address>
				</div>
				<div class="col-md-5">
			        <span><img src="img/rogerGearLogo.jpeg" style="width: 266px; margin-top: -20px;"></span>
				</div>
			</div>
			<hr>
		</header>
		<article>
		    <div class="row" style="margin-top: -43px;">
			    <div class="col-md-12">
			    <div class="col-md-6">
				    <label>Owner To: {{$result[0]->ownerTo}}</label>
				</div>
				<div class="col-md-6">
				    <label>Order To: {{$result[0]->orderTo}}</label>
				</div>
				</div>
			</div>
			<div class="row mt-2">
			    <div class="col-md-6">
				    <label>Customer Name: {{$result[0]->customerName}}</label>
				</div>
			    <div class="col-md-6">
				    <label>M.F.G Date: {{$result[0]->manufacturedDate}}</label>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-6">
				    <label>Job Name: {{$result[0]->jobName}}</label>
				</div>
				<div class="col-md-6">
				    <label>Delivery Date: {{$result[0]->deliveryDate}}</label>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-6">
				    <label>Phone Number: {{$result[0]->contact_number}}</label>
				</div>
				<div class="col-md-6">
				    <label>Estimate No. : {{$result[0]->estimateNumber}}</label>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-6">
				    <label>City/State/Zip: {{$result[0]->city}}</label>
				</div>
				<div class="col-md-6">
				    <label>Email: {{$result[0]->emailAddress}}</label>
				</div>
			</div>
			<div class="row mt-2">
			    <div class="col-md-12" style="font-weight: 900;text-align:center;">
				    Order Details
				</div>
			</div>
			<table class="inventory mt-2">
				<thead>
					<tr>
						<th><span >Product Code/Details</span></th>
						<th><span >Price Details</span></th>
						<th><span >Qty</span></th>
						<th><span >MFG By</span></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $data){?>
						<tr>
						<td><span >{{$data->productCode;}}</span></td>
						<td><span >{{$data->priceDetails;}}</span></td>
						<td><span >{{$data->quantity;}}</span></td>
						<td><span >{{$data->manufacturedBy;}}</span></td>
						</tr>
						<?php } ?>   
				</tbody>
			</table>
	        <div class="row mt-4">
			    <div class="col-md-8">
				    <span><img src="<?php echo $result[0]->uploadImage;?>" style="border: 2px solid;"></span>
				</div>
				<div class="col-md-4">
				    <label>Mode Of Delivery: {{$result[0]->modeOfDelivery}}</label>
				</div>
			</div>
		</article>
		
