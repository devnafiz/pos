<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Customer;
use PDF;
use App\Payment;
use App\PaymentDetail;


class CustomerController extends Controller
{
     public function view(){


    //dd('ok');
     	$allData=Customer::all();
     	return view('backend.customer.view-customer',compact('allData'));
     }


     public function add(){

     	return view('backend.customer.add-customer');
     }

     public function store(Request $request){

     	$customer=new Customer;

     	$customer->name=$request->name;
     	$customer->mobile_no=$request->mobile_no;
     	$customer->email=$request->email;
     	$customer->address=$request->address;
     	$customer->created_by=Auth::user()->id;
     	$customer->save();
     	return redirect()->route('customers.view')->with('success','data save Successfully');
     }

     public function edit($id){

     	$editData=Customer::find($id);

     	//dd($editData);
     	return view('backend.customer.edit-customer',compact('editData'));
     }

     public function update(Request $request,$id){
     	$customer=Customer::find($id);

     	$customer->name=$request->name;
     	$customer->mobile_no=$request->mobile_no;
     	$customer->email=$request->email;
     	$customer->address=$request->address;
     	$customer->updated_by=Auth::user()->id;
     	$customer->save();
     	return redirect()->route('customers.view')->with('success','data updated Successfully');
     }

     public function delete($id){

     	$customer=Customer::find($id);

     	$customer->delete();


     	return redirect()->route('customers.view')->with('Success','customer deleted Successfully!');
     }
     public function creditCustomer(){

          $allData=Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
          return view('backend.customer.customer_credit',compact('allData'));
     }

     public function creditCustomerPdf(){

          $data['allData']=Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
          $pdf = PDF::loadView('backend.pdf.credit-customer-pdf', $data);
          $pdf->SetProtection(['copy', 'print'], '', 'pass');
          return $pdf->stream('document.pdf');
     }

     public function editInvoice(Request $request,$invoice_id){
         $data['payment']=Payment::where('invoice_id',$invoice_id)->first();
          $data['date']=date('Y-m-d');
          return view('backend.customer.edit-invoice',$data);
     }
     public function updateInvoice(Request $request,$invoice_id){
          if($request->new_paid_amount<$request->paid_amount){
               return redirect()->back()->with('error','Srroy! you add maximum valuw');
          }else{
               $payment=Payment::where('invoice_id',$invoice_id)->first();
               $payment_details=new PaymentDetail();

               $payment->paid_status=$request->paid_status;
               if($request->paid_status=='full_paid'){
                    $payment->paid_amount=Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                    $payment->due_amount='0';
                    $payment_details->current_paid_amount=$request->new_paid_amount;

               }elseif ($request->paid_status=='partial_paid') {
                      $payment->paid_amount=Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                       $payment->due_amount=Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                        $payment_details->current_paid_amount=$request->paid_amount;
                   
               }
               $payment->save();
               $payment_details->invoice_id=$invoice_id;
               $payment_details->date=date('Y-m-d',strtotime($request->date));
               //$payment_details->created_by=Auth::user()->id;
               $payment_details->save();
               return redirect()->route('customers.credit')->with('success','updated invoice Successfully');



          }
          
     }

     public function invoiceDetailsPdf(Request $request,$invoice_id){
          $data['payment']=Payment::where('invoice_id',$invoice_id)->first();
          $pdf = PDF::loadView('backend.pdf.customer-invoice-details-pdf', $data);
          $pdf->SetProtection(['copy', 'print'], '', 'pass');
          return $pdf->stream('document.pdf');
     }
     
     public function paidCustomer(){
           $allData=Payment::where('paid_status','!=','full_due')->get();
           //dd($allData);
           return view('backend.customer.paid-customer',compact('allData'));
     }


     public function paidCustomerPdf(Request $request){
           $data['allData']=Payment::where('paid_status','!=','full_due')->get();
            $pdf = PDF::loadView('backend.pdf.customer-paid-pdf', $data);
          $pdf->SetProtection(['copy', 'print'], '', 'pass');
          return $pdf->stream('document.pdf');

     }

     public function customerWiseReport(){

          
     }

}
