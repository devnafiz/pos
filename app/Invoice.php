<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     public function payment(){
    	return $this->belongsTo(Payment::class,'id','invoice_id');
    }

    //many to many 
    public function invoice_details(){

    	return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    	//id Invoice model er  ar invoice_id invoice details model er joonno;
    }

}
