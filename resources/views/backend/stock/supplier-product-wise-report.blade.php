 
@extends('backend.layouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Stock</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock </li>
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
                <!-- <a href="" class="btn btn-success float-right" target="_blank"><i class="fa fa-download"></i>Download PDF</a> -->
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                   <div class="col-md-12">
                    <strong>Supplier wise Report</strong>
                    <input type="radio" name="supplier_product_wise" class="search_value" value="supplier_wise">&nbsp; &nbsp;
                    <strong>Product wise Report</strong>
                    <input type="radio" name="supplier_product_wise" class="search_value" value="product_wise">
                     
                   </div>
                  
                </div>
                <div class="show_supplier" style="display: none;">
                  <form method="GET" action="{{route('stock.report.supplier.wise.pdf')}}" id="supplierWiseForm" target="_blank">
                    <div class="form-row">
                       <div class="col-md-8">
                        <label>Supplier Name</label>
                        <select name="supplier_id" class="form-control select2">
                          <option value=""> select supplier</option>
                          @foreach($suppliers as $supplier)
                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                          @endforeach
                        </select>
                         
                       </div>
                       <div class="col-md-4">
                        <button type="submit" class="btn btn-success" style="margin-top:29px; "> search</button>
                         
                       </div>
                      
                    </div>
                  </form>
                  
                </div>
                 <div class="show_product" style="display: none;">
                     <form method="GET" action="{{route('stock.report.product.wise.pdf')}}" id="productWiseForm" target="_blank">
                    <div class="form-row">
                       <div class="col-md-5">
                        <label>Category Name</label>
                        <select name="category_id" class="form-control select2" id="category_id">
                          <option value=""> select Category</option>
                          @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        </select>
                         
                       </div>
                       <div class="col-md-5">
                      <label for="name"> Product Name</label>
                      <select name="product_id" id="product_id" class="form-control select2">
                            <option value=""> select Product</option>
                           
                      </select>
                      
                    </div>
                       <div class="col-md-2">
                        <button type="submit" class="btn btn-success" style="margin-top:29px; "> search</button>
                         
                       </div>
                      
                    </div>
                  </form>
                 </div>
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
    $(document).on('change','.search_value',function(){
        var search_value=$(this).val();
        if(search_value=='supplier_wise'){

          $('.show_supplier').show();
        }else{
           $('.show_supplier').hide();
        }

        if(search_value=='product_wise'){

          $('.show_product').show();
        }else{
           $('.show_product').hide();
        }

    });
  </script>
   <script>
$(document).ready(function () {
  
  $('#supplierWiseForm').validate({

    ignore:[],
    errorPlacement:function(error,element){

      if(element.attr("name")=="supplier_id"){error.insertAfter(
        element.next());
      }else{
        error.insertAfter(element);
      }
    },
    errorClass:"text-danger",
    validClass:"text-success",
    rules: {
      supplier_id:{
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
<script>

$(document).ready(function () {
  
  $('#productWiseForm').validate({

    ignore:[],
    errorPlacement:function(error,element){

      if(element.attr("name")=="category_id"){error.insertAfter(
        element.next());
      }
      else if(element.attr("name")=="product_id"){error.insertAfter(
        element.next());
      }
      else{
        error.insertAfter(element);
      }
    },
    errorClass:"text-danger",
    validClass:"text-success",
    rules: {
      category_id:{
          required:true,
      },
      product_id:{
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