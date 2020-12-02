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
						 	<td><strong><span>Paid Customer List</span></strong></td>
						 </tr>
						
					</tbody>
				</table>
				
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-md-12">
				 <table border="1" width="100%" style="margin-bottom: 10px;">
                  <thead>
                    <tr>
                      <th>SL.</th>
                   
                    <th> Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Amount</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                  	 @php
                     $total_sub='0';
                     @endphp
                    @foreach($allData as $key=>$payment)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$payment['customer']['name']}}-{{$payment['customer']['mobile_no']}} </td>
                    <td>{{$payment['invoice']['invoice_no']}}</td>
                    <td>{{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
                    <td>{{$payment->paid_amount}}Tk</td>
                    
                  </tr>
                  @php 
                    $total_sub+=$payment->paid_amount;
                    @endphp
                 @endforeach
                  <tr>
                      <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
                      <td class="text-center"><strong>{{$total_sub}}</strong></td>
                    </tr>
                
                  </tbody>
                  
                </table>
                @php
                $date= new DateTime('now',new DateTimezone('Asia/Dhaka')); 
                @endphp

				<i>Printing Time:{{$date->format("F j, Y, g:i a")}}</i>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<hr style="margin-bottom: 0px">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td style="width: 40%">
								<p style="text-align: center;margin: left;">Nafix</p>
							</td>
							<td style="width: 20%"></td>
							<td style="width: 40%">
								<p style="text-align: center;">Nazmul hossain</p>
							</td>
						</tr>
					</tbody>
					
				</table>
				
			</div>
			
		</div>
	</div>
 
               
</body>
</html>