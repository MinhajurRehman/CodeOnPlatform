<?php

namespace App\Observers;

use App\Models\notifications;
use App\Models\post;




class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post)
    {
        Notifications::create([
            'message' => 'A new thread: ' . $post->post_content,
            'url' => url('/thread'),
        ]);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}