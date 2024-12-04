<?php

namespace App\Http\Controllers;

use App\Mail\YourMailClass;
use App\Models\congrats;
use App\Models\participant;
use App\Models\tournament_model;
use App\Models\User;
use Illuminate\Http\Request;
use flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jorenvh\Share\Providers\ShareServiceProvider;
use Jorenvh\Share\ShareFacade as Share;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





class tournamentController extends Controller
{
    public function tournament_data_store(Request $request)
    {
        $tournaments = new tournament_model();

        $t_poster_image = $request->file('t_poster_image')->GetClientOriginalName();
        $tmpath = $request->file('t_poster_image')->storeAs('/t_poster_image', $t_poster_image);
        $request->t_poster_image->move(public_path('t_poster_image'), $t_poster_image);

        $tournaments->t_email = $request['t_email'];
        $tournaments->organizer_id = $request->users->id;
        $tournaments->t_name = $request['t_name'];
        $tournaments->t_poster_image = $tmpath;
        $tournaments->t_date_time = $request['t_date_time'];
        $tournaments->t_board_time = $request['t_board_time'];
        $tournaments->t_end_date_time = $request['t_end_date_time'];
        $tournaments->t_Plang = $request['t_Plang'];
        $tournaments->t_description = $request['t_description'];
        $tournaments->save();

        return redirect('/profile');
    }

    public function tournament_participant_data_store(Request $request)
    {
        $tournaments_participants = new participant;
        $tournaments_participants->tournament_id = $request['tournament_id'];
        $tournaments_participants->participant_id = $request['user_id'];
        $tournaments_participants->save();

        return back()->with('successfully', 'Joined we wiil mail you soon. Thank You!');
    }

    public function Share(Request $request)
    {
        $user = $request->users;

        $tournaments = tournament_model::where('Status','active')->orderBy('created_at', 'desc')->get();

        $congratulations = congrats::all();

        // Get the list of tournaments the user has joined
        $joinedTournamentIds = DB::table('tournaments_participants')
        ->where('participant_id', $user->id)
        ->pluck('tournament_id') // Plucks out all tournament IDs the user has joined
        ->toArray();



        $shareComponent =Share::page(
            url('/tournament'),
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();

        return view('tournament',data: [
            "shareComponent" => $shareComponent,
            'tournaments' => $tournaments,
            'user' => $user,
            'joinedTournamentIds' => $joinedTournamentIds,
            'congratulations' => $congratulations,
        ]);

    }


    public function startTournament($tournament_id)
    {
        // 1. Tournament aur Organizer details fetch karna
        $tournament = tournament_model::findOrFail($tournament_id);
        $organizer = User::findOrFail($tournament->organizer_id);

        // 2. Tournament ke participants fetch karna
        $participants = DB::table('tournaments_participants')
            ->join('users', 'tournaments_participants.participant_id', '=', 'users.id')
            ->where('tournaments_participants.tournament_id', $tournament_id)
            ->select('users.email', 'users.username')
            ->get();

        // 3. Sab participants ko mail bhejna
        foreach ($participants as $participant) {
            $link = url('Hackathon-online-ide/' .  $tournament->id ); // Route link generate karna

                // Check if the tournament's end time has passed
                $currentTime = now();
                $isLinkActive = $tournament->t_end_date_time > $currentTime;

            Mail::send('emails.your_view', [
                'participant' => $participant,
                'tournament' => $tournament,
                'organizer' => $organizer,
                'link' => $isLinkActive ? $link : null, // Pass the link or null
                'isLinkActive' => $isLinkActive, // Pass active status
            ], function ($message) use ($participant, $tournament) {
                $message->to($participant->email)
                        ->subject("Tournament Invitation: {$tournament->t_name}")
                        ->from('albert.08774573829920@gmail.com', 'Hackathon Heroes');
            });
        }

        return back()->with('success', 'Emails have been sent to all participants.');
    }

    public function announced_winners(Request $request){

        $congratulations = new congrats();
        $congratulations->announced_tname = $request['announced_tname'];
        $congratulations->winner_name = $request['winner_name'];
        $congratulations->winner_points = $request['winner_points'];
        $congratulations->Text = $request['Text'];
        $congratulations->save();

        return redirect('/tournament');
    }


    public function deleteTournament($id)
{
    try {
        // Begin a transaction to ensure atomicity
        DB::beginTransaction();

        // Delete participants related to the tournament
        DB::table('tournaments_participants')->where('tournament_id', $id)->delete();

        // Delete the tournament itself
        DB::table('tournaments')->where('id', $id)->delete();

        // Commit the transaction
        DB::commit();

        return redirect()->back()->with('success', 'Tournament and participants deleted successfully.');
    } catch (\Exception $e) {
        // Rollback in case of an error
        DB::rollBack();

        return redirect()->back()->with('error', 'Failed to delete the tournament. Please try again.');
    }
}



}