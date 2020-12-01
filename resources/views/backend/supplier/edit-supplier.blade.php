 
@extends('backend.layouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier </li>
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

                 Edit Supplier
                 <a href="{{route('suppliers.view')}}" class="btn btn-success float-right"><i class="fa fa-list-circle"></i>Supplier view</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('suppliers.update',$editData->id)}}" method="post" id="myForm">
                  {{csrf_field()}}

                  <div class="form-row">
                    
                    <div class="col-md-6">
                      <label for="name">Supplier Name</label>
                      <input type="text" name="name" class="form-control" value="{{$editData->name}}">
                      <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="mobile_no">Mobile Number</label>
                      <input type="text" name="mobile_no" class="form-control" value="{{$editData->mobile_no}}">
                      <font style="color: red">{{($errors->has('mobile_no'))?($errors->first('mobile_no')):''}}</font>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="name">Email</label>
                      <input type="email" name="email" class="form-control" value="{{$editData->email}}" >
                      <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="address">Address</label>
                      <input type="text" name="address" class="form-control" value="{{$editData->address}}" >
                      <font style="color: red">{{($errors->has('address'))?($errors->first('address')):''}}</font>
                      
                    </div>
                    
                    
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                      <input type="submit" value="update" class="btn btn-primary">
                       
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
  <script>
$(function () {
  
  $('#myForm').validate({
    rules: {
      usertype: {
        required: true,
       
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6
      },
      password2:{
        required: true,
         equalTo:'#password'
      },
     
    },
    messages: {
       usertype: {
        required: "Please select user",
        
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      password2: {
        required: "Please provide a password",
        equalTo: "Your password not match"
      },
      terms: "Please accept our terms"
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