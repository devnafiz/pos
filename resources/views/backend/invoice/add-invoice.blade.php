 
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

                 Add Invoice
                 <a href="{{route('invoice.view')}}" class="btn btn-success float-right"><i class="fa fa-list-circle"></i>Invoice list</a>
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
                    <div class="col-md-1">
                      <label for="name"> Invoice No</label>
                     <input type="text" name="invoice_no" class="form-control-sm  form-control"  id="invoice_no" value="{{$invoice_no}}" readonly >
                      
                    </div>
                    
                    <div class="col-md-2">
                      <label for="name"> Date</label>
                     <input type="text" name="date" class="form-control-sm datepicker form-control" id="date" placeholder="YYYY-MM-DD"  value="{{$date}}">
                      
                    </div>
                   

                    <div class="col-md-3">
                      <label for="name"> Category Name</label>
                      <select name="category_id" id="category_id" class="form-control select2">
                            <option value=""> select Category</option>
                            @foreach($categories as $category)
                           <option  value="{{$category->id}}">{{$category->name}}</option>
                           @endforeach
                      </select>
                      
                    </div>

                    
                    
                    <div class="col-md-3">
                      <label for="name"> Product Name</label>
                      <select name="product_id" id="product_id" class="form-control select2">
                            <option value=""> select Product</option>
                           
                      </select>
                      
                    </div>

                    <div class="col-md-3">
                      <label for="name"> Stock(psc/kg) </label>
                      <input type="text" name="current_stock_qty" id="current_stock_qty" class="form-control form-control-sm" readonly>
                      
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
                <form method="post" action="{{route('invoice.store')}}" id="myForm">
                  @csrf
                  <table class="table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>pc/kg</th>
                        <th>unit Price</th>
                       
                        <th>Total Price</th>
                         <th>Action</th>

                      </tr>
                    </thead>
                    <tbody id="addRow" class="addRow">
                      
                    </tbody >
                    <tbody>
                      <tr>
                         <td colspan="4"> discount</td>
                         <td><input type="text" name="discount_amount" id="discount_amount" class="form-control"></td>
                        
                      </tr>
                      <tr>
                        
                        <td colspan="4"></td>
                        <td>
                          <input type="text" name="estimated_amount" value="0" class="form-control" id="estimated_amount">
                        </td>
                        <td></td>
                      </tr>
                    </tbody>
                    
                  </table>
                  <div class="form-row">
                      <div class="form-group col-md-12">
                        <textarea name="description" class="form-control" id="description" placeholder="Write description"></textarea>
                        
                      </div>
                    
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label>paid status</label>
                      <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                         <option value="">Select status</option>
                         <option value="full_paid">full Paid</option>
                         <option value="full_due">full Due</option>
                         <option value="partial_paid">Partial Paid</option>
                      </select>
                      <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" style="display: none;">
                      
                    </div>
                    <div  class="form-group col-md-7">
                       <label>Customer Info</label>
                       <select name="customer_id" id="customer_id" class="form-control form-control-sm select2">
                         <option value="">Select Customer</option>
                         @foreach($customers as $customer)
                         <option value="{{$customer->id}}">{{$customer->name}} {{$customer->mobile_no}}-{{$customer->address}}</option>
                         @endforeach
                         <option value="0"> New Customer</option>
                      </select>
                      
                    </div>

                    
                  </div>
                  <div class="form-row new_customer" style="display: none;">
                     <div class="form-group col-md-4">
                      <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="write name">
                       
                     </div>
                     <div class="form-group col-md-4">
                      <input type="text" name="mobile_no" id="mobile_no" class="form-control form-control-sm" placeholder="write mobile no">
                       
                     </div>
                     <div class="form-group col-md-4">
                      <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="write mobile no">
                       
                     </div>
                    
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Invoice Store</button>
                    
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
      <input type="hidden" name="date" value="@{{date}}">
      <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
      
      <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{category_name}}
      </td>
      <td>
         <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{product_name}}
      </td>
      <td>
        <input type="number" name="selling_qty[]" min="1" class="form-control selling_qty" value="1">
      </td>
      <td>
        <input type="number" name="unit_price[]" min="1" class="form-control unit_price" value="">
      </td>
      
      <td>
         <input  name="selling_price[]"  class="form-control form-control-sm selling_price" value="0" readonly>
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
         var invoice_no=$('#invoice_no').val();
        
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
                 invoice_no:invoice_no,
                 
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
       $(document).on('keyup click','.unit_price,.selling_qty',function(){

          var unit_price=$(this).closest("tr").find("input.unit_price").val();
          var qty=$(this).closest("tr").find("input.selling_qty").val();

          var total=unit_price*qty;
          $(this).closest("tr").find("input.selling_price").val(total);
          $('#discount_amount').trigger('keyup');

       });

       $(document).on('keyup','#discount_amount',function(){
            totalAmountPrice();

       });

       function totalAmountPrice(){

         var sum =0;

         $(".selling_price").each(function(){
            var value=$(this).val();
            if(!isNaN(value) && value.length!=0){

              sum+=parseFloat(value);
            }


         });

         var discount_amount=parseFloat($('#discount_amount').val());
         if(!isNaN(discount_amount) && discount_amount.length!=0){
           sum-=parseFloat(discount_amount);
         }
         $('#estimated_amount').val(sum);
       };


    });
  </script>
  <script type="text/javascript">
    
   $(document).on('change','#paid_status',function(){
      var paid_status =$(this).val();

      if(paid_status=='partial_paid'){
         $('.paid_amount').show();
      }else{
        $('.paid_amount').hide();
      }

     

   }); 
  </script>
  <script type="text/javascript">
    
   $(document).on('change','#customer_id',function(){
     

      var customer_id =$(this).val();

      if(customer_id=='0'){
         $('.new_customer').show();
      }else{
        $('.new_customer').hide();
      }

   }); 
  </script>

  <script type="text/javascript">
    
    $(function(){

      $(document).on('change','#product_id',function(){

        var product_id=$(this).val();

        $.ajax({

             url:"{{route('check-product-stock')}}",
             type:"GET",
             data:{product_id:product_id},
             success:function(data){
              $('#current_stock_qty').val(data);


             }


        });
      });


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