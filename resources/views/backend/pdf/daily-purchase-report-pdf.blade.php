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
						 	<td><strong><span>Daily  Purchase Report{{date('d-m-Y',strtotime($start_date))}}-{{date('d-m-Y',strtotime($end_date))}}</span></strong></td>
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
                    <th>Purchase No</th>
                    <th>Date</th>
                    
                    
                    <th>Product name</th>
                    
                    <th>quantity</th>
                    <th>unit Price</th>
                    <th>Buying Price</th>
                   
                    
                  </tr>
                  </thead>
                  <tbody>

                  	@php
                  	$total_sum='0';
                  	@endphp
                    @foreach($allData as $key=>$purchase)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$purchase->purchase_no}} </td>
                    <td>{{date('d-m-y',strtotime($purchase->date))}} </td>
                    
                    <td>{{$purchase['product']['name']}}</td>
                    
                    <td>{{$purchase->buying_qty}} {{$purchase['product']['unit']['name']}}</td>
                     <td>{{$purchase->unit_price}}


                      </td>
                     <td>{{$purchase->buying_price}} </td>
                     @php
                     $total_sum+=$purchase->buying_price;
                     @endphp
                     
                    
                  </tr>
                 @endforeach
                 <tr>
                 	<td colspan="6">Grand Total</td>
                 	<td>{{$total_sum}}</td>
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