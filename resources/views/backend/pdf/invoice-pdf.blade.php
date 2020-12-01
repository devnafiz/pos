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
							<td>Invoice No#{{$invoice->invoice_no}}</td>
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
						 	<td><strong><span>Customer Invoice</span></strong></td>
						 </tr>
						
					</tbody>
				</table>
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				@php
                 $payment=App\Payment::where('invoice_id',$invoice->id)->first();
                @endphp
                <table width="100%">
                  <tbody>
                    <tr>
                      
                       <td width="30%"><p><strong>Name:</strong>{{$payment['customer']['name']}}</p></td>
                      <td width="30%"><p><strong>Mobile No:</strong>{{$payment['customer']['mobile_no']}}</p></td>
                        <td width="40%"><p><strong>Address:</strong>{{$payment['customer']['address']}}</p></td>
                    </tr>
                    <tr>
                      <td width="15%"></td>
                      <td width="85%" colspan="3"><p>Description:{{$invoice->description}}</p></td>
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
                      <th>Category</th>
                      <th>Product Name</th>
                     
                      <th>qty</th>
                      <th>Unit Price</th>
                      <th>Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                     <!--invoice er sathe invoice details er  relation ship many to many-->
                     @php
                     $total_sub='0';
                     @endphp
                    @foreach($invoice['invoice_details'] as $key=>$details)
                    <tr class="text-center">
                       
                    <td>{{$key+1}}</td>
                    <td>{{$details['category']['name']}}</td>
                    <td>{{$details['product']['name']}}</td>
                    
                    <td>{{$details->selling_qty}}</td>
                    <td>{{$details->unit_price}}</td>
                    <td>{{$details->selling_price}}</td>
                    </tr>
                    @php 
                    $total_sub+=$details->selling_price;
                    @endphp
                    @endforeach

                    <tr>
                      <td colspan="5" class="text-right"><strong>Sub Total</strong></td>
                      <td class="text-center"><strong>{{$total_sub}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right">Discount</td>
                      <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right">Paid Amount</td>
                      <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right">Due Amount</td>
                      <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right"><strong>Grand Total</strong></td>
                      <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
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