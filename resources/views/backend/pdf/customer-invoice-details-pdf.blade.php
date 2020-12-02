<!DOCTYPE html>
<html>
<head>
	<title> Customer Invoice details Pdf</title>
	<!-- Tempusdominus Bootstrap 4 -->
  
</head>
<body>

	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						
						<tr>
							<td>Invoice No#{{$payment['invoice']['invoice_no']}}</td>
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
						 	<td><strong><span>Customer Invoice Details</span></strong></td>
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
                      
                       <td width="30%"><p><strong>Name:</strong>{{$payment['customer']['name']}}</p></td>
                      <td width="30%"><p><strong>Mobile No:</strong>{{$payment['customer']['mobile_no']}}</p></td>
                        <td width="40%"><p><strong>Address:</strong>{{$payment['customer']['address']}}</p></td>
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
                   
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                     $total_sub='0';
                     $invoice_details=App\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                     @endphp
                    @foreach( $invoice_details as $key=>$details)
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
                      <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                      <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right"><strong>Grand Total</strong></td>
                      <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                    </tr>
                    <tr>
                    	<td colspan="6" style="text-align: center;font-weight: bold;">Paymet summery</td>
                    </tr>
                    <tr>
                    	<td colspan="3" >date</td>
                    	<td colspan="3">Amount</td>
                    </tr>
                    @php
                    $payment_details=App\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
                    @endphp
                    @foreach( $payment_details as $details)
                    <tr>
                    	<td colspan="3">{{$details->date}}</td>
                    	<td colspan="3">{{$details->current_paid_amount}}Tk</td>
                    </tr>
                    @endforeach
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