<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\Supplier;
use App\Unit;
use App\Category;
use PDF;


class StockController extends Controller
{
     public function stockReport(){


    // dd('ok');
     	$allData=Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
     	//dd($allData);
     	return view('backend.stock.stock-report',compact('allData'));
     }


     public function stockReportPdf(){
     	 //dd('ok');
     	$data['allData']=Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
     	 $pdf = PDF::loadView('backend.pdf.stock-report-pdf', $data);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');

         
     }

     public function supplierProductWise(){

     	//dd('ok');
     	$data['suppliers']=Supplier::all();
     	$data['categories']=Category::all();
     	return view('backend.stock.supplier-product-wise-report',$data);
     }

     public function supplierWisePdf(Request $request){
        $data['allData']=Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
     	 $pdf = PDF::loadView('backend.pdf.supplier-wise-stock-report-pdf', $data);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');
     }

     public function productWisePdf(Request $request){

     	$data['product']=Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
     	 $pdf = PDF::loadView('backend.pdf.product-wise-stock-report-pdf', $data);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');
     }
}
