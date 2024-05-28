<?php

namespace App\Http\Controllers;

use App\Models\complaint;
use App\Models\post;
use App\Models\solutions;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function thread()
    {
        $comments = solutions::all();

        return view('Home')->with(['comments' => $comments]);
    }

    public function thread_store(Request $request)
    {
        $posting = new post;
        $posting->post_content = $request['post_content'];
        $posting->post_image = $request['post_image'];
        $posting->save();

        return redirect('/thread');
    }

    public function comments(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $comments = new solutions;
        $comments->comment = $request['comment'];
        $comments->save();

        return redirect('/thread');
    }

    public function complaint(Request $request)
    {

        $request->validate([
            'complaint' => 'required',
            'Screenshot' => 'required',
        ]);

        $report = new complaint;
        $report->complaint = $request['complaint'];
        $report->Screenshot = $request['Screenshot'];
        $report->save();

        return redirect('/thread');
    }
}
