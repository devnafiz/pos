<!DOCTYPE html>
<html>
<head>
	<title> Supplier wise stock Pdf</title>
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
						 	<td><strong><span>Supplier wise stock Pdf</span></strong>

                              <strong>{{$allData['0']['supplier']['name']}}</strong>
						 	</td>

						 </tr>
						
					</tbody>
				</table>
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<table border="1" width="100%">
                  <thead>
                  <tr>
                    <th>SL.</th>
                   
                    <th>Supplier Name</th>
                    <th>Category</th>
                    <th>Product name</th>
                    <th>Unit</th>
                     <th>In qty</th>
                    <th>Out qty</th>
                    <th>stock</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key=>$product)
                    @php
                    $buying_total=App\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');
                     $selling_total=App\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
                    @endphp
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$product['supplier']['name']}} </td>
                    <td>{{$product['category']['name']}} </td>
                    <td>{{$product->name}}</td>
                    <td>{{$product['unit']['name']}} </td>
                     <td>{{$buying_total}}</td>
                     <td>{{$selling_total}}</td>
                    
                    <td>
                    	 <span style="background: #ddd;"> {{$product->quantity}}</span>
                    </td>
                  </tr>
                 @endforeach
                
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