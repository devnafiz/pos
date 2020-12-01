 
@extends('backend.layouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage credit Customers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer </li>
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

                 Edit Invoice (Invoice NO#{{$payment['invoice']['invoice_no']}})
                
                </h3>
                 <a href="{{route('customers.credit')}}" class="btn btn-success float-right"><i class="fa fa-list"></i></a>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <table width="100%">
                  <tbody>
                    <tr>
                      
                       <td width="30%"><p><strong>Name:</strong>{{$payment['customer']['name']}}</p></td>
                      <td width="30%"><p><strong>Mobile No:</strong>{{$payment['customer']['mobile_no']}}</p></td>
                        <td width="40%"><p><strong>Address:</strong>{{$payment['customer']['address']}}</p></td>
                    </tr>
                   
                  </tbody>
                  
                </table>
                 <form action="{{route('customers.update.invoice',$payment->invoice_id)}}" method="post" id="myForm">
                  @csrf
                <table id="example1" class="table table-bordered table-striped">
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
                  </tbody>
                  
                </table>
              
                
                  </tbody>
                  
                </table>
               
                  

                   <div class="row">
                  <div class="form-group col-md-3">
                      <label>paid status</label>
                      <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                         <option value="">Select status</option>
                         <option value="full_paid">full Paid</option>
                        
                         <option value="partial_paid">Partial Paid</option>
                      </select>
                      <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" style="display: none;">
                      
                    </div>
                     <div class="col-md-2">
                      <label for="name"> Date</label>
                     <input type="text" name="date" class="form-control-sm datepicker form-control" id="date" placeholder="YYYY-MM-DD"  value="{{$date}}">
                      
                    </div>
                    <div class="col-md-3" style="padding-top: 30px;">
                      <button type="submit" class="btn btn-success">update</button>
                      
                    </div>
                  
                </div>
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
  <script type="text/javascript">
    
   $(document).on('change','#paid_status',function(){
      var paid_status =$(this).val();

      if(paid_status=='partial_paid'){
         $('.paid_amount').show();
      }else{
        $('.paid_amount').hide();
      }

     

   }); 
  </script>
 <script>
$(function () {
  
  $('#myForm').validate({
    rules: {
      paid_status:{
          required:true,
      },
      date:{
          required:true,
      }
      

      
     
    },
    messages: {
        
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
  @endsection