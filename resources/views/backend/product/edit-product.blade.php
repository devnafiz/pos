 
@extends('backend.layouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product </li>
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

                 Edit Product
                 <a href="{{route('products.view')}}" class="btn btn-success float-right"><i class="fa fa-list-circle"></i>Product list</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('products.update',$editData->id)}}" method="post" id="myForm">
                  {{csrf_field()}}

                  <div class="form-row">
                    
                    <div class="col-md-6">
                      <label for="name"> Supplier Name</label>
                      <select name="supplier_id"  class="form-control">
                            <option value=""> select supplier</option>
                            @foreach($suppliers as $supplier)
                           <option  value="{{$supplier->id}}" {{($editData->supplier_id==$supplier->id)?"selected":""}}>{{$supplier->name}}</option>
                           @endforeach
                      </select>
                      
                    </div>

                    <div class="col-md-6">
                      <label for="name"> Category Name</label>
                      <select name="category_id" id="usertype" class="form-control">
                            <option value=""> select category</option>
                            @foreach($categories as $category)
                           <option  value="{{$category->id}}" {{($editData->category_id==$category->id)?"selected":""}}>{{$category->name}}</option>
                           @endforeach
                      </select>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="name"> Unit Name</label>
                      <select name="unit_id" id="usertype" class="form-control">
                            <option value=""> select unit</option>
                            @foreach($units as $unit)
                           <option  value="{{$unit->id}}" {{($editData->unit_id==$unit->id)?"selected":""}}>{{$unit->name}}</option>
                           @endforeach
                      </select>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="email">product Name</label>
                      <input type="text" name="name" class="form-control" value="{{$editData->name}}">
                      <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                      
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
      name:{
          required:true,
      },
      supplier_id:{
          required:true,
      },
      category_id: {
        required: true,
        
      },
       unit_id: {
        required: true,
        
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