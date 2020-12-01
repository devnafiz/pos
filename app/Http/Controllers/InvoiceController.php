<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\Supplier;
use App\Unit;
use App\Category;
use App\Purchase;
use DB;
use App\Invoice;
use App\InvoiceDetail;
use App\Payment;
use App\PaymentDetail;
use App\Customer;
 use PDF;
class InvoiceController extends Controller
{
     public function view(){


    //dd('ok');
     	$allData=Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
     	return view('backend.invoice.view-invoice',compact('allData'));
     }


     public function add(){
         
         $data['categories']=Category::all();
        $invoice_data=Invoice::orderBy('id','desc')->first();
        if($invoice_data==null){
           $firstReg='0';
           $data['invoice_no']=$firstReg+1;
        }else{
             $invoice_data=Invoice::orderBy('id','desc')->first()->invoice_no;
             $data['invoice_no']=$invoice_data+1;
        }
        $data['customers']=Customer::all();
        $data['date']=date('Y-m-d');
     	return view('backend.invoice.add-invoice',$data);
     }

     public function store(Request $request){
     	if($request->category_id==null){
         return redirect()->back()->with('error','You do not select field');
     	}else{

     		if($request->paid_amount>$request->estimated_amount){
     			 return redirect()->back()->with('error','You enter maximum value frm total value');
     		}else{
     			$invoice=new Invoice;
     			$invoice->invoice_no=$request->invoice_no;
     			$invoice->date=date('Y-m-d',strtotime($request->date));
     			$invoice->description=$request->description;
                $invoice->status='0';
                $invoice->created_by=Auth::user()->id;
                DB::transaction(function() use($request,$invoice){
                	if($invoice->save()){
                     $count_category=count($request->category_id);
                     for ($i=0; $i <$count_category ; $i++) { 
                     	$invoice_details=new InvoiceDetail();
                     	$invoice_details->date=$request->date;
                     	$invoice_details->invoice_id=$invoice->id;
                     	$invoice_details->category_id=$request->category_id[$i];
                     	$invoice_details->product_id=$request->product_id[$i];
                     	$invoice_details->selling_qty=$request->selling_qty[$i];
                     	$invoice_details->unit_price=$request->unit_price[$i];
                     	$invoice_details->selling_price=$request->selling_price[$i];
                     	$invoice_details->status='0';
                     	$invoice_details->save();


                     }
                     if($request->customer_id=='0'){
                     	$customer=new Customer();

                     	$customer->name=$request->name;
                     	$customer->mobile_no=$request->mobile_no;
                     	$customer->address=$request->address;
                     	$customer->save();
                     	$customer_id=$customer->id;//last id select
                     }else{
                     	$customer_id=$request->customer_id;
                     }
                     $payment=new Payment();
                      $paymet_details=new PaymentDetail();
                     $payment->invoice_id=$invoice->id;
                     $payment->customer_id=$customer_id;
                     $payment->paid_status=$request->paid_status;
                    
                     $payment->discount_amount=$request->discount_amount;
                     $payment->total_amount=$request->estimated_amount;
                     if($request->paid_status=='full_paid'){
                     	$payment->paid_amount=$request->estimated_amount;
                     	$payment->due_amount='0';

                     	$paymet_details->current_paid_amount=$request->estimated_amount;

                     }elseif($request->paid_status=='full_due'){

                     	$payment->paid_amount='0';
                     	$payment->due_amount=$request->estimated_amount;

                     	$paymet_details->current_paid_amount='0';
                     }elseif($request->paid_status=='partial_paid'){
                     	$payment->paid_amount=$request->paid_amount;
                     	$payment->due_amount=$request->estimated_amount-$request->paid_amount;

                     	$paymet_details->current_paid_amount=$request->paid_amount;


                     }
                     $payment->save();
                     $paymet_details->invoice_id=$invoice->id;
                     $paymet_details->date=date('Y-m-d',strtotime($request->date));
                     $paymet_details->save();


                	}

                });
     		}
     		
     			
     			


     		


     	}
     	//dd('ok');

     	

     	
     	
     	return redirect()->route('invoice.view')->with('success','data save Successfully');
     }

     public function pending(){

     	$allData=Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
     	return view('backend.invoice.pending-invoice',compact('allData'));
     }

     public function update(Request $request,$id){
     	$product=Product::find($id);

     	

     	$product->supplier_id=$request->supplier_id;
     	$product->category_id=$request->category_id;
     	$product->unit_id=$request->unit_id;
     	$product->name=$request->name;
     	$product->quantity='0';
     	
     	
     	$product->updated_by=Auth::user()->id;
     	$product->save();
     	return redirect()->route('products.view')->with('success','data updated Successfully');
     }


     public function approve($id){

     	$invoice=Invoice::with('invoice_details')->find($id);
     	//invoice er sathe invoice detail er manay to many reletionship
     	//dd('ok');
     	
         return view('backend.invoice.invoice-appreove',compact('invoice'));

     }

     public function approvalStore(Request $request,$id){
      //dd($id);
     	foreach ($request->selling_qty as $key => $val) {
     		$invoice_details=InvoiceDetail::where('id',$key)->first();
     		$product=Product::where('id',$invoice_details->product_id)->first();
     		//dd($request->selling_qty[$key]);
     		if($product->quantity< $request->selling_qty[$key]){
     			return redirect()->back()->with('error','Sorry ! It was maximum value');
     		}
     	}


     	$invoice=Invoice::find($id);
     	$invoice->approved_by=Auth::user()->id;
     	$invoice->status='1';
     	DB::transaction(function() use($request,$invoice,$id){
                   foreach ($request->selling_qty as $key => $val) {
                   	$invoice_details=InvoiceDetail::where('id',$key)->first();
                   $invoice_details->status='1';
                   $invoice_details->save();
                   	$product=Product::where('id',$invoice_details->product_id)->first();
                   	$product->quantity=((float)$product->quantity)-((float)$request->selling_qty[$key]);
                   	$product->save();

                   }
                   $invoice->save();

     	});
     	return redirect()->route('invoice.pending')->with('success','Invoice Successfully approved');

     }

     public function delete($id){

     	$invoice=Invoice::find($id);

     	$invoice->delete();
     	InvoiceDetail::where('invoice_id',$invoice->id)->delete();
     	Payment::where('invoice_id',$invoice->id)->delete();
     	PaymentDetail::where('invoice_id',$invoice->id)->delete();


     	return redirect()->route('invoice.pending')->with('Success',' deleted Successfully!');
     }
     public function printInvoiceList(){
     	$allData=Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
     	return view('backend.invoice.invoice-print-list',compact('allData'));


     }
     




	public function printInvoice($id) {
		$data['invoice'] =Invoice::with('invoice_details')->find($id);
		$pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');
	}

	public function invoiceReport(){
		//dd('ok');
		return view('backend.invoice.daily-invoice-report');
	}

	public function invoiceReportPdf(Request $request){
		//dd('ok');

		$sdate=date('Y-m-d',strtotime($request->start_date));
		$edate= date('Y-m-d',strtotime($request->end_date));
		$data['allData']=Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->get();
		$data['start_date']=date('Y-m-d',strtotime($request->start_date));
		$data['end_date']=date('Y-m-d',strtotime($request->end_date));

		$pdf = PDF::loadView('backend.pdf.daily-invoice-report-pdf', $data);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');

	}
}
