<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
class ProfileController extends Controller
{
    public function view(){
    	$id=Auth::user()->id;
    	$user=User::find($id);
    	//dd($user);
    	return view('backend.user.view-profile',compact('user'));
    }

    public function edit(){

    	$id=Auth::user()->id;
    	$editData=User::find($id);
    	return view('backend.user.edit-profile',compact('editData'));

    }

    public function update(Request $request){
        $id=Auth::user()->id; 
    	$data= User::find($id);
    	
    	$data->name=$request->name;
    	$data->email=$request->email;
    	$data->mobile=$request->mobile;
    	$data->address=$request->address;
    	$data->gender=$request->gender;
    	if($request->file('image')){

    		$file=$request->file('image');
    		@unlink(public_path('uploads/user_image/'.$data->image));
    		$filename=date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('uploads/user_image'),$filename);
    		$data['image']=$filename;

    	}
    	
    	$data->save();
    	return redirect()->route('profiles.view')->with('success','user update successfully');
    }
}
