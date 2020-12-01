 
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
              <li class="breadcrumb-item active">Pending Invoice </li>
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
                    <th>Status</th>
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
                    <td>@if($invoice->status=='0')
                      <span style="background: red;padding: 3px;">panding</span>
                         @elseif($invoice->status=='1')
                       <span style="background: green;padding: 3px;">Approved</span>
                          @endif
                        </td>
                   
                    <td>
                      @if($invoice->status==0)
                      <a href="{{route('invoice.approve',$invoice->id)}}"   class="btn btn-sm btn-danger"><i class="fa fa-check"></i> </a>
                       <a href="{{route('invoice.delete',$invoice->id)}}" id="deleta" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                      @endif
                     
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