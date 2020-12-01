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
use PDF;

class PurchaseController extends Controller
{
    public function view(){


    //dd('ok');
     	$allData=Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
     	return view('backend.purchase.view-purchase',compact('allData'));
     }


     public function add(){
         $data['suppliers']=Supplier::all();
         $data['categories']=Category::all();
         $data['units']=Unit::all();
     	return view('backend.purchase.add-purchase',$data);
     }

     public function store(Request $request){
     	if($request->category_id==null){
         return redirect()->back()->with('error','You do not select field');
     	}else{
     		$count_category=count($request->category_id);
     		for ($i=0; $i <$count_category ; $i++) { 
     			$purchase=new Purchase;
     			$purchase->date=date('Y-m-d',strtotime($request->date[$i]));
     			$purchase->purchase_no=$request->purchase_no[$i];
     			$purchase->supplier_id=$request->supplier_id[$i];
		     	$purchase->category_id=$request->category_id[$i];
		     	$purchase->product_id=$request->product_id[$i];
		     	$purchase->buying_qty=$request->buying_qty[$i];
		     	$purchase->unit_price=$request->unit_price[$i];
		     	$purchase->buying_price=$request->buying_price[$i];
		     	$purchase->description=$request->description[$i];
		     	$purchase->created_by=Auth::user()->id;
		     	$purchase->status='0';
     	        $purchase->save();


     		}


     	}
     	//dd('ok');

     	

     	
     	
     	return redirect()->route('purchase.view')->with('success','data save Successfully');
     }

     public function pending(){

     	$allData=Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
     	return view('backend.purchase.view-pending-list',compact('allData'));
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

     	$purchase=Purchase::find($id);
     	//dd('ok');
     	$product=Product::where('id',$purchase->product_id)->first();
     	$purchase_qty=((float)($purchase->buying_qty))+((float)($product->quantity));
     	$product->quantity=$purchase_qty;
     	if($product->save()){

     		DB::table('purchases')->where('id',$id)->update(['status'=>1]);
     	}
         return redirect()->route('purchase.view')->with('success','data save Successfully');

     }

     public function delete($id){

     	$purchase=Purchase::find($id);

     	$purchase->delete();


     	return redirect()->route('purchase.view')->with('Success',' deleted Successfully!');
     }

     public function purchaseReport(Request $request){

       return view('backend.purchase.daily-purchase-report');
     }

     public function purchaseReportPdf(Request $request){

        $sdate=date('Y-m-d',strtotime($request->start_date));
        $edate= date('Y-m-d',strtotime($request->end_date));
        $data['allData']=Purchase::whereBetween('date',[$sdate,$edate])->orderBy('supplier_id')->orderBy('category_id')->orderBy('product_id')->where('status','1')->get();
        $data['start_date']=date('Y-m-d',strtotime($request->start_date));
        $data['end_date']=date('Y-m-d',strtotime($request->end_date));

        $pdf = PDF::loadView('backend.pdf.daily-purchase-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');


     }
}
