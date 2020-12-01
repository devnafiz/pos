 
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

                 Invoice List
                 <a href="{{route('invoice.add')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i></a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-x:auto;">
                <table id="example1" class="table table-bordered table-striped table-sm " width="100%">
                  <thead>
                  <tr>
                    <th>SL.</th>
                     <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>description</th>
                   
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
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
                    <td><a title="print" href="{{route('invoice.print',$invoice->id)}}" target="_blank"><i class="fa fa-print"></i></a></td>
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