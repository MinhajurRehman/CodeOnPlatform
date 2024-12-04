<?php

namespace App\Http\Controllers;

use App\Mail\ChallengeAcceptedMail;
use App\Mail\ChallengeNotificationMail;
use App\Models\Challenge;
use App\Models\open;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class challengeController extends Controller
{
    // public function sendChallenge(Request $request)
    // {
    //     $challenge = Challenge::create([
    //         'sender_id' => $request->sender_id, // Jis user ny challenge bheja
    //         'receiver_id' => $request->receiver_id, // Jis ny receive kiya
    //         'challenge_name' => $request->challenge_name,
    //         'challenge_reason' => $request->challenge_reason,
    //     ]);

    //     $receiver = User::find($request->receiver_id);

    //     // Mail bhijna receiver ko
    //     Mail::to($receiver->email)->send(new ChallengeNotificationMail($challenge));

    //     return redirect()->back()->with('message', 'Challenge sent successfully!');
    // }

    // public function handleResponse(Request $request, $id, $action)
    // {
    //     $challenge = Challenge::findOrFail($id);

    //     if ($action === 'accept') {
    //         $challenge->update(['status' => 'accepted']);

    //          // Sender ko mail bhejna jab challenge accept ho jaye
    //     $url = url('Hackathon-online-ide'); // Replace with actual IDE link
    //     Mail::to($challenge->sender->email)->send(new ChallengeAcceptedMail($challenge, $url));

    //         return redirect('/Hackathon-online-ide');

    //     }elseif ($action === 'reject') {
    //         $challenge->update(['status' => 'rejected']);

    //         return redirect('/thread');

    //     }
    // }



     // Display all challenges
     public function index()
    {
         $users = User::all();
         if(Session::has('loginId')){
             $user = User::where('id','=',Session::get('loginId'))->first();
         }
         // Fetch challenges with creator's profile details using JOIN
         $challenges = DB::table('openchallenges')
             ->join('users as creators', 'openchallenges.creator_id', '=', 'creators.id')
             ->leftJoin('users as joiners', 'openchallenges.joiner_id', '=', 'joiners.id')
             ->select(
                 'openchallenges.id',
                 'creators.username as creator_username',
                 'creators.profile_image as creator_image',
                 'openchallenges.language',
                 'openchallenges.joiner_id'
             )
             ->get();

         return view('challenge',[
             "challenges" => $challenges,
             "user" => $user,
             "users" => $users,
         ]);
    }

     // Create new challenge
     public function create(Request $request)
    {

         $user = $request->users;

         DB::table('openchallenges')->insert([
             'creator_id' => $user->id, // User ID from session
             'language' => $request->language,
             'created_at' => now(),
             'updated_at' => now(),
         ]);

         return redirect()->route('challenges.index');
    }

     // Join a challenge
     public function join($id, Request $request)
     {
         $user = $request->users; // Logged-in user

         // Fetch the challenge
         $challenge = DB::table('openchallenges')->where('id', $id)->first();

         if ($challenge && $challenge->joiner_id === null) {
             // Update the challenge to set joiner_id and trigger redirect
             DB::table('openchallenges')
                 ->where('id', $id)
                 ->update([
                     'joiner_id' => $user->id,
                     'redirect_trigger' => true,
                     'updated_at' => now(),
                 ]);

             // Wait for some time and then reset trigger
            //  sleep(5); // Delay to ensure both users are redirected
             DB::table('openchallenges')
                 ->where('id', $id)
                 ->update(['redirect_trigger' => true]);

             // Redirect joiner immediately
            //  return redirect('/openChallenge-compiler');
            return redirect()->route('challenges.verses', ['id' => $challenge->id]);

         }

         return redirect()->route('challenges.index');
     }


     public function checkRedirect($id)
    {
         // Fetch the challenge
         $challenge = DB::table('openchallenges')->where('id', $id)->first();

         if ($challenge) {
             // If redirect_trigger is 1, allow redirection and update to 2
             if ($challenge->redirect_trigger == 1) {
                //  DB::table('openchallenges')
                //      ->where('id', $id)
                //      ->update(['redirect_trigger' => 2]); // Update the trigger

                 // Send redirect response
                 return response()->json(['redirect' => true]);
             }

             // If redirect_trigger is 2, delete the entry
            //  if ($challenge->redirect_trigger == 2) {
            //      DB::table('openchallenges')->where('id', $id)->delete(); // Delete the challenge
            //  }
         }

         // If no challenge found or redirect_trigger is not set properly
         return response()->json(['redirect' => false]);
    }

    public function verses($id)
    {
        // Fetch the open challenge details
        $challenge = DB::table('openchallenges')->where('id', $id)->first();

        if (!$challenge) {
            return redirect()->route('challenges.index')->with('error', 'Challenge not found!');
        }

        // Fetch creator details
        $creator = DB::table('users')->where('id', $challenge->creator_id)->first();

        // Fetch joiner details (if available)
        $joiner = null;
        if ($challenge->joiner_id) {
            $joiner = DB::table('users')->where('id', $challenge->joiner_id)->first();
        }

        // Pass data to the view
        return view('intermediate', compact('challenge', 'creator', 'joiner'));
    }

    public function deleteOpenChallenge(Request $request)
    {
        $id = $request->input('id');
        $openChallenge = open::find($id);
    
        if ($openChallenge) {
            // Update the redirect_trigger to 2
            $openChallenge->redirect_trigger = 2;
            $openChallenge->save();
    
            // Delete the record
            $openChallenge->delete();
    
            return redirect()->route('challenges.index')->with('success', 'Challenge updated and deleted successfully.');
        }
    
        return redirect()->back()->with('error', 'Unable to delete challenge. Either it does not exist or some error occurred.');
    }
    



}