<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class settingController extends Controller
{
    public function accounts($id, Request $request){

        $request->validate([
            'username' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:15'],
            'email' => ['required', 'email'],
        ], [
            'username.regex' => 'Username contains only alphabets & spaces.',
            'username.max' => 'Allow only 15 Characters.',
        ]);

        // update the profile name & email
        $user = User::findOrFail($id);
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->save();

            return redirect('/profile');

    }

    public function security($id, Request $request){

        $request->validate([
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // update the profile name & email
        $user = User::findOrFail($id);
        $user->SQ = $request['SQ'];
        $user->SA = $request['SA'];
        if ($request->filled('password')) {
        $user->password = Hash::make($request['password']);
        }
        $user->save();

        return redirect()->back()->with('Saved', 'Your data is saved');

    }

    public function appearence($id, Request $request){

        // update the profile name & email
        $user = User::findOrFail($id);
        $user->Theme = $request['Theme'];
        $user->save();

        // Save theme in session for immediate application on frontend
        session(['Theme' => $request['Theme']]);

        return redirect()->back()->with('Updated', 'Theme is updated reload the page');

    }
}