<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;




class LoginController extends Controller
{
    public function login(){
        return view('credentials');
    }

    // public function registerUser(Request $request){
    //     $request->validate([
    //         'username' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:15'],
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ], [
    //         'username.regex' => 'Username contains only alphabets & spaces.',
    //         'username.max' => 'Allow only 15 Characters.',
    //     ]);

    //     $user = new User();
    //     $user->username = $request->username;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $res = $user->save();

    //     if($res){
    //         return back()->with('success','You have registerd successfully! Now Login ');
    //     }else{
    //         return back()->with('fail','Something Wrong!');
    //     }
    // }

    public function registerUser(Request $request){
        $request->validate([
            'username' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:15'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'username.regex' => 'Username contains only alphabets & spaces.',
            'username.max' => 'Allow only 15 Characters.',
        ]);

        // Check if email already exists
        if (User::where('email', $request->email)->exists()) {
            return redirect('/')->with('fail' , 'This email is already registered.');
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

         // Send OTP via email
        Mail::send('emails.otp', ['user' => $user, 'otp' => $otp], function ($message) use ($user) {
        $message->to($user->email);
        $message->subject('Verify Your Account - OTP');
        });

        // Store email in session for OTP verification
        Session::put('unverifiedEmail', $user->email);

        // Prompt for OTP verification
        return view('verify-otp', ['email' => $user->email])
        ->with('success', 'Registration successful! Please verify your email using the OTP sent to your email.');

    }


    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|integer',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found for this email.'])->withInput();
        }

        if ($user->otp !== $request->otp) {
            $user->delete();
            return redirect('/')->with('fail', 'otp verification failed. Try again');
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            $user->delete();
            return redirect('/')->with('fail', 'otp expired. Try again');
        }

        // Redirect to the login page with success message
        return redirect('/')->with('success', 'Registration successfully! Now login.');
    }


    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
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

            $theme = $user->Theme ?? 'Light';
            Session::put('theme', $theme);
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