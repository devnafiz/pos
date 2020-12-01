 
@extends('backend.layouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Purchase </li>
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

                 Pending Purchase List
                 <!-- <a href="{{route('purchase.add')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i></a> -->
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive-lg">
                <table id="example1" class="table table-bordered table-striped table-sm " width="100%">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Suopplier Name</th>
                     <th>Category</th>
                    
                    <th>Product name</th>
                    <th>description</th>
                    <th>quantity</th>
                    <th>unit Price</th>
                    <th>Buying Price</th>
                    <th>status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key=>$purchase)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$purchase->purchase_no}} </td>
                    <td>{{date('d-m-y',strtotime($purchase->date))}} </td>
                    <td>{{$purchase['supplier']['name']}}</td>
                    <td>{{$purchase['category']['name']}}</td>
                    <td>{{$purchase['product']['name']}}</td>
                    <td>{{$purchase->description}} </td>
                    <td>{{$purchase->buying_qty}} {{$purchase['product']['unit']['name']}}</td>
                     <td>{{$purchase->unit_price}}


                      </td>
                     <td>{{$purchase->buying_price}} </td>
                     <td>@if($purchase->status=='0')
                      <span style="background: red;padding: 3px;">panding</span>
                         @elseif($purchase->status=='1')
                       <span style="background: green;padding: 3px;">Approved</span> </td>
                    @endif
                    <td
                      @if($purchase->status==0)
                      <a href="{{route('purchase.approve',$purchase->id)}}"  id="approveBtn" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> approve</a>
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
  <script type="text/javascript">
  
  $(function(){
    $(document).on('click','#approveBtn',function(e){
      e.preventDefault();
     var link=$(this).attr("href");Swal.fire({
        title: 'Are you sure approved purchase?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approved it!'
      }).then((result) => {
        if (result.value) {
          window.location.href=link;
          Swal.fire(
            'Approved!',
            'Your file has been Approved.',
            'success'
          )
        }
      })


    });

  });
</script>

  @endsection