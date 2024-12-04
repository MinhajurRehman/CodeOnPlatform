<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\post;
use App\Models\tournament_model;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class searchController extends Controller
{
    public function search(Request $request)
    {
        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();

            $theme = $user->Theme ?? 'Light';
            Session::put('theme', $theme);
        }

        $query = $request->input('query');

        // Searching tournaments by name
        $tournaments = tournament_model::where('t_name', 'like', '%' . $query . '%')->get();

        // Searching posts by content
        $posts = Post::where('post_content', 'like', '%' . $query . '%')->get();

        // Searching users by username
        $users = User::where('username', 'like', '%' . $query . '%')->get();

        // Returning the results to the view
        return view('search', [
            'tournaments' => $tournaments,
            'posts' => $posts,
            'users' => $users,
            'user' => $user,
            'query' => $query,
        ]);
    }

    public function show($id)
    {
        $users = User::findOrFail($id);

        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();

            $theme = $user->Theme ?? 'Light';
            Session::put('theme', $theme);
        }

        $posting = post::all()->first();
        $challenges = Challenge::all()->first();
        $data = tournament_model::all()->first();


        return view('users', [
            'users' => $users,
            'user' => $user,
            'posting' => $posting,
            'challenges' => $challenges,
            'data' => $data,
        ]);
    }
}