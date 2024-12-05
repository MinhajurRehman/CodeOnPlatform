<?php

namespace App\Http\Controllers;

use App\Events\notifyEvent;
use App\Models\complaint;
use App\Models\notifications;
use App\Models\post;
use App\Models\solutions;
use App\Models\User;
use App\Notifications\MyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ThreadController extends Controller
{
    public function thread(Request $request)
    {
        $posting = post::all()->sortByDesc('created_at');
        $user = $request->users;
        $userId = $user->id;


        $comments = solutions::select('comments.*', 'users.username', 'users.profile_image')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->get();

        $notifications = notifications::latest()->get();

        return view('Home', data: [
            "comments" => $comments,
            "posting" => $posting,
            "user" => $user,
            "notifications" => $notifications,
            "userId" => $userId,
        ]);
    }


    public function thread_store(Request $request)
    {

        $request->validate([
            'post_image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post_image = $request->file('post_image')->GetClientOriginalName();
        $path = $request->file('post_image')->storeAs('/post_image', $post_image);
        $request->post_image->move(public_path('post_image'), $post_image);
        $posting = new post();
        $posting->user_id = $request['user_id'];
        $posting->post_content = $request['post_content'];
        $posting->post_image = $path;
        $posting->save();

        return redirect('/thread');
    }

    public function comments(Request $request)
    {
        $user = $request->users;


        $request->validate([
            'comment' => 'required',
        ]);
        $comments = new solutions;
        $comments->comment = $request['comment'];
        $comments->user_id = $user->id;
        $comments->posting_id = $request['posting_id'];
        $comments->save();

        return redirect('/thread');
    }

    public function complaint(Request $request)
    {

        $request->validate([
            'complaint' => 'required',
            'Screenshot' => 'required',
        ]);

        $Screenshot = $request->file('Screenshot')->GetClientOriginalName();
        $Screenshot = $request->file('Screenshot')->storeAs('/Screenshot', $Screenshot);
        $request->Screenshot->move(public_path('Screenshot'), $Screenshot);

        $report = new complaint;
        $report->complaint = $request['complaint'];
        $report->Screenshot = $Screenshot;
        $report->save();

        return redirect('/thread');
    }

    public function read(){
        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();

            $theme = $user->Theme ?? 'Light';
            Session::put('theme', $theme);
        }

        $users = User::orderBy('leaderboard', 'desc')->get();

        return view('leaderboard',data: [
            'user' => $user,
            'users' => $users,
        ]);
    }


    public function deleteComments($id)
    {
        // variable define
        $comments = solutions::find($id);
        // conditions
        if (!is_null($comments)) {
            $comments->delete();
        }
        return redirect()->back();
    }


    public function deletePosting($id)
    {
        // variable define
        $posting = post::find($id);
        // conditions
        if (!is_null($posting)) {
            $posting->delete();
        }
        return redirect()->back();
    }


}