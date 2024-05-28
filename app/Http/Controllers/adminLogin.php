<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class adminLogin extends Controller
{
    public function adminlogin(Request $request){
        $request->validate([
            'adminemail'=>'required|email',
            'adminpassword'=>'required|min:6|max:12'
        ]);


        $admin_login = admin::where('adminemail','=',$request->adminemail)->first();
        if($admin_login){
            if(Hash::check($request->adminpassword, $admin_login->adminpassword)){
                $request->session()->put('AdminloginId',$admin_login->id);
                return redirect('/admin-Dashboard');
            }else{
                return back()->with('fail','You are not admin');
            }
        }else{
            return back()->with('fail','This admin is not registered in hackthon.');
        }
    }
}