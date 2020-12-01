 
@extends('backend.layouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User </li>
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

                 Edit profile
                 <a href="{{route('profiles.view')}}" class="btn btn-success float-right"><i class="fa fa-list-circle"></i>your profile</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('profiles.update')}}" method="post" id="myForm" enctype="mulipart/form-data">
                  {{csrf_field()}}

                  <div class="form-row">
                    
                    <div class="col-md-4">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" value="{{$editData->name}}">
                      <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                      
                    </div>
                    <div class="col-md-4">
                      <label for="name">Email</label>
                      <input type="email" name="email" class="form-control" value="{{$editData->email}}" >
                      <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                      

                    </div>
                    <div class="col-md-4">
                      <label for="name">Mobile</label>
                      <input type="text" name="mobile" class="form-control" value="{{$editData->mobile}}" >
                      <font style="color: red">{{($errors->has('mobile'))?($errors->first('mobile')):''}}</font>
                      
                      
                    </div>
                    <div class="col-md-4">
                      <label for="name">Address</label>
                      <input type="text" name="address" class="form-control" value="{{$editData->address}}" >
                      <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                      
                      
                    </div>
                    <div class="form-group col-md-4">
                      <label for="usertype">gender</label>
                      <select name="gender" id="gender" class="form-control">
                            <option value=""> User gender</option>
                            <option value="Male" {{($editData->gender=="Male")?"selected":""}}> Male</option>
                            <option value="Female" {{($editData->usertype=="Female")?"selected":""}}>Female</option>
                      </select>
                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Image</label>
                      <input type="file" name="image" id="image" class="form-control">
                      
                    </div>
                    <div class="form-group col-md-4" >
                      <img id="showImage" src="{{(!empty($editData->image))?url('uploads/user_image/'.$editData->image):url('uploads/user_image/no-image.png')}}" style="height: 160px;width: 150px; border: 1px solid #f32;">
                      
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