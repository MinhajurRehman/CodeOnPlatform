<?php

use App\Http\Controllers\adminLogin;
use App\Http\Controllers\challengeController;
use App\Http\Controllers\leaderboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\notifyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\tournamentController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\LoginCheck;
use App\Models\Challenge;
use App\Models\complaint;
use App\Models\open;
use App\Models\participant;
use App\Models\post;
use App\Models\tournament_model;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User Routes


// Login Routes
Route::get('/', [LoginController::class, 'login']);
Route::post('registeruser', [LoginController::class, 'registerUser']);
Route::post('loginuser', [LoginController::class, 'loginUser'])->name('loginuser');
Route::get('logout', [LoginController::class, 'logout']);

// social media login's integration
// Route::get('/auth/github/redirect',[LoginController::class,'githubredirect'])->name('githublogin');
// Route::get('/auth/github/callback',[LoginController::class,'githubcallback']);

// Route::get('/auth/google/redirect',[LoginController::class,'googleredirect'])->name('googlelogin');
// Route::get('/auth/google/callback',[LoginController::class,'googlecallback']);


Route::middleware("LoginCheck")->group(function(){

    Route::get('/thread', [ThreadController::class, 'thread']);

    Route::post('/thread', [ThreadController::class, 'thread_store']);
    Route::get('/thread/del/{id}', [ThreadController::class, 'deletePosting'])->name('posting.delete');


    Route::post('/comment', [ThreadController::class, 'comments'])->name('commentsave');
    Route::get('/Comment/del/{id}', [ThreadController::class, 'deleteComments'])->name('Comment.delete');

    Route::post('/complaint', [ThreadController::class, 'complaint'])->name('reports');

    Route::get('/leaderboard', [ThreadController::class, 'read']);

    Route::get('/challenge', function () {
        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();

            $theme = $user->Theme ?? 'Light';
            Session::put('theme', $theme);
        }
        $users = User::all(); // Yeh list of users dropdown mein display karay gi
        return view('challenge',data: [
            'user' => $user,
            'users' => $users,
        ]);
    });


    Route::get('/profile', function (Request $request) {
        $tournaments = tournament_model::where('Status','active')->where("organizer_id", $request->users->id)->get();

        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();

            $theme = $user->Theme ?? 'Light';
            Session::put('theme', $theme);
        }

         $posting = post::all()->first();
         $challenges = Challenge::all()->first();
         $data = tournament_model::all()->first();

         // Get the current date and time
        $currentDateTime = Carbon::now();

        // dd($tournaments);
        return view('profile',data: [
            "user" => $user,
            "tournaments" => $tournaments,
            'currentDateTime' => $currentDateTime,
            'posting' => $posting,
            'challenges' => $challenges,
            'data' => $data,
        ]);
    });
    Route::post('/profile', [ProfileController::class, 'Profile_data']);



    Route::get('/setting', function () {

        $user = null;

        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();

            $theme = $user->Theme ?? 'Light';
            Session::put('theme', $theme);
        }

        return view('setting',data: [
            'user' => $user,
        ]);
    });

    Route::post('setting/accounts/{id}', [settingController::class, 'accounts'])->name('accoounts');
    Route::post('setting/security/{id}', [settingController::class, 'security'])->name('security');
    Route::post('setting/appearence/{id}', [settingController::class, 'appearence'])->name('appearence');

    Route::get('/Hackathon-online-ide/{id}', function ($id) {
        if(Session::has('loginId')) {
            $user = User::where('id', '=', Session::get('loginId'))->first();
        }
         // User ke banaye gaye tournaments ko fetch karna
         $tournaments = tournament_model::where('id', $id)->get()->first();

         // Agar koi tournament nahi mila to error message dikhana
         if (!$tournaments) {
             return redirect('/profile')->with('error', 'No tournaments found.');
         }


        return view('ide.ui.ide', [
            'user' => $user,
            'tournaments' => $tournaments,
        ]);
    });

    Route::post('/Hackathon-online-ide',[leaderboardController::class, 'get_points']);

    Route::get('/tournament', [tournamentController::class, 'Share'])->name('tournament_get');

    Route::post('/tournament',[tournamentController::class, 'tournament_data_store'])->name('tournament');

    Route::post('/tournament_participant',[tournamentController::class, 'tournament_participant_data_store'])->name('tournament_participant');

    Route::post('/tournament/{tournament_id}/start', [TournamentController::class, 'startTournament'])->name('tournament.start');

    // Route::post('/send-challenge', [ChallengeController::class, 'sendChallenge']);
    // Route::get('/challenge-response/{id}/{action}', [ChallengeController::class, 'handleResponse']);

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/users/{id}', [SearchController::class, 'show'])->name('users.show');

    Route::post('/send-congratulations', [notifyController::class, 'sendCongratulations'])->name('send.congratulations');

    Route::get('/challenge', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::post('/challenges/create', [ChallengeController::class, 'create'])->name('challenges.create');
    Route::get('/challenges/join/{id}', [ChallengeController::class, 'join'])->name('challenges.join');
    Route::get('/challenges/{id}/check-redirect', [ChallengeController::class, 'checkRedirect'])->name('challenges.checkRedirect');
    Route::get('/challenges/{id}/verses', [ChallengeController::class, 'verses'])->name('challenges.verses');


    Route::post('/congratulate',[tournamentController::class, 'announced_winners'])->name('congratulate_winners');


    Route::get('/openChallenge-compiler/{id}', function ($id) {
        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();
        }

        $openChallenge = open::find($id);

        return view('ide.ui.Open_challenge',[
            'user' => $user,
            'openChallenge' => $openChallenge,
        ]);
    });

    Route::post('/store-points', function (Request $request) {
        $openChallenge = open::find($request->challenge_id);

        if ($openChallenge) {
            if ($request->user_role === 'joiner') {
                $openChallenge->points_joiner = $request->points;
            } elseif ($request->user_role === 'creator') {
                $openChallenge->points_receiver = $request->points;
            }
            $openChallenge->save();
        }

        return redirect()->route('results', ['id' => $openChallenge->id]);
    });

    Route::get('/results/{id}', function ($id) {
        $openChallenge = open::find($id);

            // Ensure the record exists before proceeding
         if (!$openChallenge) {
               return redirect()->route('challenges.index')->with('error', 'Challenge not found.');
        }


        $creator = User::find($openChallenge->creator_id);
        $joiner = User::find($openChallenge->joiner_id);

        return view('result', [
            'openChallenge' => $openChallenge,
            'creator' => $creator,
            'joiner' => $joiner,
        ]);
    })->name('results');


    Route::post('/delete-openChallenge', [ChallengeController::class, 'deleteOpenChallenge'])->name('delete.openChallenge');

    Route::post('/tournament/delete/{id}', [tournamentController::class, 'deleteTournament'])->name('tournament.delete');

});


// Admin Routes
Route::get('/AdminPanel', function () {
return view('Admin.adminLogin');
});
Route::post('/AdminPanel', [adminLogin::class, 'adminlogin']);

Route::middleware("AuthCheck")->group(function(){

    Route::get('/admin-Dashboard', function () {
        $users = User::all();
        return view('Admin.adminDashboard')->with('users',$users);

    });

    Route::get('/admin-Post', function () {
        $posting = post::all();
        return view('Admin.adminPost')->with('posting',$posting);

    });

    Route::get('/admin-Tournaments', function () {
        $tournaments = tournament_model::all();
        return view('Admin.adminTournaments')->with('tournaments',$tournaments);

    });

    Route::get('/post/del/{id}', function ($id) {
        // variable define
        $posting = post::find($id);
        // conditions
        if (!is_null($posting)) {
            $posting->delete();
        }
        return redirect('/admin-Post');

    })->name('post.delete');

    Route::get('/accept_tournament/{id}', function($id){

        $tournaments = tournament_model::find($id);

        $tournaments->Status='active';

        $tournaments->save();

        return redirect()->back();
    });

    Route::get('/reject_tournament/{id}', function($id){

        $tournaments = tournament_model::find($id);

        $tournaments->Status='Reject';

        $tournaments->save();

        return redirect()->back();
    });


    Route::get('/admin-report', function(){

        $report = Complaint::orderBy('created_at', 'desc')->get();

        return view('Admin.adminReport',[
            'report' => $report
        ]);
    });


    Route::get('adminlogout', [adminLogin::class, 'adminlogout']);

});