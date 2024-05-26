<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;




class LoginController extends Controller
{
    public function login(){
        return view('credentials');
    }

    public function registerUser(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:12'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();

        if($res){
            return back()->with('success','You have registerd successfully! Now Login ');
        }else{
            return back()->with('fail','Something Wrong!');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:12'
        ]);


        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId',$user->id);
                return redirect('/thread');
            }else{
                return back()->with('fail','Password does not match.');
            }
        }else{
            return back()->with('fail','This email is not registered.');
        }
    }

    public function profile(){
        $user = array();
        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();
        }
        return view('profile',compact('user'));
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('/');
        }
    }

    // public function githubredirect(Request $request){
    //     return Socialite::driver('github')->redirect();
    // }

    // public function githubcallback(Request $request){
    //     $userdata = Socialite::driver('github')->user();

    //     $user = User::where('email', $userdata->email)->where('auth_type','github')->first();

    //     if($user){
    //         // do login
    //         Auth::login($user);
    //         return redirect('/profile');

    //     }else{
    //         // register
    //         $uuid = Str::uuid()->toString();

    //         $user = new User();
    //         $user->username = $userdata->name;
    //         $user->email = $userdata->email;
    //         $user->password = Hash::make($uuid.now());
    //         $user->auth_type = 'github';
    //         $user->save();
    //         Auth::login($user);
    //         return redirect('/profile');
    //     }

    // }

    // public function googleredirect(Request $request){
    //     return Socialite::driver('google')->redirect();
    // }

    // public function googlecallback(Request $request){
    //     $userdata = Socialite::driver('google')->user();

    //     $user = User::where('email', $userdata->email)->where('auth_type','google')->first();

    //     if($user){
    //         // do login
    //         Auth::login($user);
    //         return redirect('/profile');

    //     }else{
    //         // register
    //         $uuid = Str::uuid()->toString();

    //         $user = new User();
    //         $user->username = $userdata->name;
    //         $user->email = $userdata->email;
    //         $user->password = Hash::make($uuid.now());
    //         $user->auth_type = 'google';
    //         $user->save();
    //         Auth::login($user);
    //         return redirect('/profile');
    //     }

    // }

}
