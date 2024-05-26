<?php

namespace App\Http\Controllers;

use App\Models\post;

use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function thread(){
        return view('Home');
    }

    public function thread_store(Request $request){
        $posting =  new post;
        $posting->post_content = $request['post_content'];
        $posting->post_image = $request['post_image'];
        $posting->save();

        return redirect('/thread');
    }
}