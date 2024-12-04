<?php

namespace App\Observers;

use App\Models\solutions;
use App\Models\notifications;
use App\Models\post;
use App\Models\User;
class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(solutions $solutions): void
    {
        notifications::create([
            'message' => 'Thread Solution: "' . $solutions->comment . '"',
            'additional_info' => 'Comment: "' . $solutions->comment . '"',
            'url' => url('/thread'),
        ]);
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(): void
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(): void
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(): void
    {
        //
    }
}