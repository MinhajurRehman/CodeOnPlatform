<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class leaderboardController extends Controller
{
    public function get_points(Request $request){

        // Store or update the profile
    $user = User::findOrFail($request->user_id);

    // Get the current leaderboard points
    $currentLeaderboard = $user->leaderboard ?? 0; // Default 0 if leaderboard is null
    $newPoints = $request->points ?? 0; // Points from the request

    $total = $currentLeaderboard + $newPoints;
    $user->update([
        'points' => $request->points,
        'leaderboard' => $total,
    ]);

        // Update tournament participant status to "Done"
        DB::table('tournaments_participants')
            ->where('participant_id', $user->id)
            ->where('tournament_participant_status', 'pending')
            ->update([
            'tournament_participant_status' => 'Done',
        ]);

        return redirect('/profile');

    }
}