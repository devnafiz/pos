 
@extends('backend.layouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12 ">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>

                 Pending Invoice List
                 Invoice No#{{$invoice->invoice_no}}({{date('d-m-Y',strtotime($invoice->date))}})
                
                </h3>
                 <a href="{{route('invoice.pending')}}" class="btn btn-success float-right"><i class="fa fa-list "></i></a>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-x:auto;">
                @php
                 $payment=App\Payment::where('invoice_id',$invoice->id)->first();
                @endphp
                <table width="100%">
                  <tbody>
                    <tr>
                      <td width="15%"><p>Customer Info</p></td>
                       <td width="25%"><p><strong>Name:</strong>{{$payment['customer']['name']}}</p></td>
                      <td width="25%"><p><strong>Mobile No:</strong>{{$payment['customer']['mobile_no']}}</p></td>
                        <td width="35%"><p><strong>Address:</strong>{{$payment['customer']['address']}}</p></td>
                    </tr>
                    <tr>
                      <td width="15%"></td>
                      <td width="85%" colspan="3"><p>Description:{{$invoice->description}}</p></td>
                    </tr>
                  </tbody>
                  
                </table>
                <form method="post" action="{{route('approve.store',$invoice->id)}}">
                  @csrf
                  
                <table border="1" width="100%" style="margin-bottom: 10px;">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th class="text-center" style="background: #ddd">Current Stock</th>
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
                       <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                        <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                        <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                    <td>{{$key+1}}</td>
                    <td>{{$details['category']['name']}}</td>
                    <td>{{$details['product']['name']}}</td>
                    <td class="text-center" style="background: #ddd">{{$details['product']['quantity']}}</td>
                    <td>{{$details->selling_qty}}</td>
                    <td>{{$details->unit_price}}</td>
                    <td>{{$details->selling_price}}</td>
                    </tr>
                    @php 
                    $total_sub+=$details->selling_price;
                    @endphp
                    @endforeach

                    <tr>
                      <td colspan="6" class="text-right"><strong>Sub Total</strong></td>
                      <td class="text-center"><strong>{{$total_sub}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right">Discount</td>
                      <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right">Paid Amount</td>
                      <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right">Due Amount</td>
                      <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
                      <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                    </tr>
                  </tbody>
                  
                </table>
                <button type="submit" class="btn btn-success">Invoice Approved</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection