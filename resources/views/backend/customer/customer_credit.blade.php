 
@extends('backend.layouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Customers</h1>
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

                 Credit Customer list
                  </h3>
                
                <a href="{{route('customers.credit.pdf')}}" class="btn btn-success float-right" target="_blank"><i class="fa fa-download"></i> Download Pdf</a>
              </div><!-- /.card-header -->
              
               
                 
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                   
                    <th> Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key=>$payment)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$payment['customer']['name']}}-{{$payment['customer']['mobile_no']}} </td>
                    <td>{{$payment['invoice']['invoice_no']}}</td>
                    <td>{{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
                    <td>{{$payment->due_amount}}Tk</td>
                    <td>
                      <a href="{{route('customers.edit.invoice',$payment->invoice_id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                      <a href="{{route('customers.invoice.details.pdf',$payment->invoice_id)}}" class="btn btn-success" target="_blank"><i class="fa fa-eye"></i></a>
                    </td>
                  </tr>
                 @endforeach
                
                  </tbody>
                  
                </table>
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