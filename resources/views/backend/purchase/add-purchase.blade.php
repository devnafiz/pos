 
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

                 Add Purchase
                 <a href="{{route('purchase.view')}}" class="btn btn-success float-right"><i class="fa fa-list-circle"></i>Purchase list</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                

                  <div class="form-row">
                    
                    <div class="col-md-6">
                      <label for="name"> Date</label>
                     <input type="text" name="date" class="form-control-sm datepicker form-control" id="date" placeholder="YYYY-MM-DD" >
                      
                    </div>
                    <div class="col-md-6">
                      <label for="name"> Purchase No</label>
                     <input type="text" name="purchase_no" class="form-control-sm  form-control"  id="purchase_no" >
                      
                    </div>

                    <div class="col-md-6">
                      <label for="name"> Supplier Name</label>
                      <select name="supplier_id" id="supplier_id" class="form-control select2">
                            <option value=""> select supplier</option>
                            @foreach($suppliers as $supplier)
                           <option  value="{{$supplier->id}}">{{$supplier->name}}</option>
                           @endforeach
                      </select>
                      
                    </div>

                    <div class="col-md-6">
                      <label for="name"> Category Name</label>
                      <select name="category_id" id="category_id" class="form-control select2">
                            <option value=""> select category</option>
                           
                      </select>
                      
                    </div>
                    
                    <div class="col-md-6">
                      <label for="name"> Product Name</label>
                      <select name="product_id" id="product_id" class="form-control select2">
                            <option value=""> select Product</option>
                           
                      </select>
                      
                    </div>
                    
                    
                    
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                      <a class="btn btn-primary addeventmore btn-sm">
                     <i class=" fa fa-plus-circle  ">add</i></a>
                       
                     </div>
                    
                  </div>

                  
                
               
              </div>
              <!-- /.card-body -->

              <div class="card-body">
                <form method="post" action="{{route('purchase.store')}}" id="myForm">
                  @csrf
                  <table class="table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>pc/kg</th>
                        <th>unit Price</th>
                        <th>Description</th>
                        <th>Total Price</th>
                         <th>Action</th>

                      </tr>
                    </thead>
                    <tbody id="addRow" class="addRow">
                      
                    </tbody >
                    <tbody>
                      <tr>
                        
                        <td colspan="5"></td>
                        <td>
                          <input type="text" name="estimated_amount" value="0" class="form-control" id="estimated_amount">
                        </td>
                        <td></td>
                      </tr>
                    </tbody>
                    
                  </table>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Purchase add</button>
                    
                  </div>
                  

                </form>
                
              </div>
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
  <script  id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
      <input type="hidden" name="data[]" value="@{{date}}">
      <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
      <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
      <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{category_name}}
      </td>
      <td>
         <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{product_name}}
      </td>
      <td>
        <input type="number" name="buying_qty[]" min="1" class="form-control buying_qty" value="1">
      </td>
      <td>
        <input type="number" name="unit_price[]" min="1" class="form-control unit_price" value="">
      </td>
      <td>
         <input type="text" name="description[]"  class="form-control">
      </td>
      <td>
         <input  name="buying_price[]"  class="form-control form-control-sm buying_price" value="0" readonly>
      </td>
      <td>
        <i class="fa fa-window-close removeeventmore"></i>
      </td>
      

      
    </tr>
    

  </script>
  <script type="text/javascript">
    
    $(document).ready(function(){
       $(document).on('click','.addeventmore',function(){

         var date=$('#date').val();
         var purchase_no=$('#purchase_no').val();
         var supplier_id=$('#supplier_id').val();
         //var supplier_name=$('#supplier_name').find('option:selected').text();
         var category_id=$('#category_id').val();
         var category_name=$('#category_id').find('option:selected').text();
         var product_id=$('#product_id').val(); 

         var product_name=$('#product_id').find('option:selected').text();

         //if(date==''){
             //$.notify("Date is Required",{globalPosition:'top right',className:'error'});
             //return false;
         //}

         var source=$('#document-template').html();
         var template= Handlebars.compile(source);
         var data={
                 date:date,
                 purchase_no:purchase_no,
                 supplier_id:supplier_id,
                 category_id:category_id,
                 category_name:category_name,
                 product_id:product_id,
                 product_name:product_name


         };
         var html=template(data);
         $('#addRow').append(html);



       });
       $(document).on('click','.removeeventmore',function(event){

         $(this).closest('.delete_add_more_item').remove();
         totalAmountPrice();
       });
       $(document).on('keyup click','.unit_price,.buying_qty',function(){

          var unit_price=$(this).closest("tr").find("input.unit_price").val();
          var qty=$(this).closest("tr").find("input.buying_qty").val();

          var total=unit_price*qty;
          $(this).closest("tr").find("input.buying_price").val(total);
          totalAmountPrice();

       });

       function totalAmountPrice(){

         var sum =0;

         $(".buying_price").each(function(){
            var value=$(this).val();
            if(!isNaN(value) && value.length!=0){

              sum+=parseFloat(value);
            }


         });
         $('#estimated_amount').val(sum);
       };


    });
  </script>
  <script type="text/javascript">
    $('#datepicker').datepicker({
      uilibrary:'bootstrap4',
      format:'yyyy-mm-dd'
    });
     $(function() {
    $("#datepicker").datepicker();
  });
  </script>

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