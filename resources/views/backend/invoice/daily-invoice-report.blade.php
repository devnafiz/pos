 
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

                 Select Criteria

                 
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="GET" action="{{route('daily.invoice.pdf')}}" target="_blank" id="myForm">

                  <div class="form-row">
                    
                    
                    <div class="col-md-4">
                      <label for="name">Start Date</label>
                     <input type="text" name="start_date" class="form-control-sm datepicker form-control" id="start_date" placeholder="YYYY-MM-DD"  >
                      
                    </div>
                    <div class="col-md-4">
                      <label for="name">End Date</label>
                     <input type="text" name="end_date" class="form-control-sm datepicker form-control" id="end_date" placeholder="YYYY-MM-DD"  >
                      
                    </div>
                  
                    
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                      <button type="submit" class="btn btn-success">search</button>
                       
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
    $('.datepicker').datepicker({
      uilibrary:'bootstrap4',
      format:'yyyy-mm-dd'
    });
     $(function() {
    $(".datepicker").datepicker();
  });
  </script>

  <script>
$(function () {
  
  $('#myForm').validate({
    rules: {
      start_date:{
          required:true,
      },
      end_date:{
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
<script type="text/javascript">
  
  $(function(){

    $(document).on('change','#supplier_id',function(){

         var supplier_id=$(this).val();

         $.ajax({

              url:"{{route('get-category')}}",
              type:"GET",
              data:{supplier_id:supplier_id},
              success:function(data){
                var html='<option value="">select Category</option>';
                $.each(data,function(key,v){
                 html+='<option value="'+v.category_id+'">'+v.category.name+'</option>'
                });
                $('#category_id').html(html);
              }

         });
    });

  });
</script>

<script type="text/javascript">
  
  $(function(){

    $(document).on('change','#category_id',function(){

         var category_id=$(this).val();

         $.ajax({

              url:"{{route('get-product')}}",
              type:"GET",
              data:{category_id:category_id},
              success:function(data){
                var html='<option value="">select Product</option>';
                $.each(data,function(key,v){
                 html+='<option value="'+v.id+'">'+v.name+'</option>'
                });
                $('#product_id').html(html);
              }

         });
    });

  });
</script>

  @endsection