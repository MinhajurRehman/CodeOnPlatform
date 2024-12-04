<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function Profile_data(Request $request){

        // $request->validate([
        //     'profile_image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        //     'user_city' => 'required',
        //     'user_about' => 'required',
        // ]);

        // Handle image upload

        $profile_image = $request->file('profile_image')->GetClientOriginalName();
        $imagePath = $request->file('profile_image')->storeAs('/profile_image', $profile_image);
        $request->profile_image->move(public_path('profile_image'), $profile_image);


    // Store or update the profile
    $user = User::findOrFail($request->user_id);
    $user->update([
        'user_about' => $request->user_about,
        'profile_image' => $imagePath ?? $imagePath ?? null,
        'user_city' => $request->user_city,
    ]);

        return redirect('/profile');

    }
}