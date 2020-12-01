<!DOCTYPE html>
<html>
<head>
	<title>Invoice Pdf</title>
	<!-- Tempusdominus Bootstrap 4 -->
  
</head>
<body>

	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						
						<tr>
							<td></td>
							<td><span>Nafiz Shopping Mol</span></td>
							<td><span>owner No:01273638389<br>
								Showroom:028327239239
							 </span></td>
						</tr>
					</tbody>
				</table>
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						 <tr>
						 	<td><strong><span>Daily  Invoice Report{{date('d-m-Y',strtotime($start_date))}}-{{date('d-m-Y',strtotime($end_date))}}</span></strong></td>
						 </tr>
						
					</tbody>
				</table>
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				 <table border="1" class="table table-bordered table-striped table-sm " width="100%">
                  <thead>
                  <tr>
                    <th>SL.</th>
                     <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>description</th>
                   
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@php
                     $total_sub='0';
                     @endphp
                   @foreach($allData as $key=>$invoice)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$invoice['payment']['customer']['name']}} {{$invoice['payment']['customer']['mobile_no']}}</td>
                    <td>{{$invoice->invoice_no}}</td>
                    <td>{{$invoice->date}}</td>
                    
                     <td>{{$invoice->description}} </td>
                     
                   
                    <td>
                     {{$invoice['payment']['total_amount']}}
                    </td>
                    @php
                     $total_sub+=$invoice['payment']['total_amount'];
                     @endphp
                  </tr>
                 @endforeach
                 <tr>
                 	<td colspan="5">{{$total_sub}}</td>
                 	<td ></td>
                 </tr>
                
                  </tbody>
                  
                </table>
				
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<hr style="margin-bottom: 0px">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td style="width: 40%">
								
							</td>
							<td style="width: 20%"></td>
							<td style="width: 40%">
								<p style="text-align: center;">Owmer signeture</p>
							</td>
						</tr>
					</tbody>
					
				</table>
				
			</div>
			
		</div>
	</div>
 
               
</body>
</html>