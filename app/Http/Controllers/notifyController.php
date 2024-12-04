<?php

namespace App\Http\Controllers;

use App\Models\tournament_model;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class notifyController extends Controller
{
    public function sendCongratulations(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'message' => 'required',
        'tournament_id' => 'required|exists:tournaments,id',
    ]);

    // Fetch tournament and user details
    $tournament = tournament_model::find($request->tournament_id);
    $organizer = User::find($tournament->organizer_id);
    $recipient = User::where('email', $request->email)->first();

    if (!$recipient) {
        return back()->with('error', 'Recipient not found!');
    }

    // Generate the congratulatory image
    $imagePath = $this->generateCongratulationImage($tournament, $organizer, $recipient, $request->message);

    // Send the email with the generated image
    Mail::send([], [], function ($message) use ($request, $imagePath) {
        $message->to($request->email)
            ->subject('Congratulations! You Are a Winner!')
            ->attach($imagePath, [
                'as' => 'congratulations.png',
                'mime' => 'image/png',
            ])
            ->setBody('Congratulations! Please find the attached image for details.', 'text/html');
    });

        return back()->with('success', 'Congratulations email sent successfully!');
    }

    private function generateCongratulationImage($tournament, $organizer, $recipient, $customMessage)
    {
    $img = Image::canvas(600, 400, '#ffffff');

    if ($img) {
        echo "GD is working!";
    } else {
        echo "GD is not available.";
    }

    $img->text('Congratulations! You are a winner.', 50, 50, function ($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(20);
        $font->color('#ff0000');
    });

    $img->text("Tournament: {$tournament->t_name}", 50, 120, function ($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(16);
        $font->color('#000000');
    });

    $img->text("Organizer: {$organizer->username}", 50, 160, function ($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(16);
        $font->color('#000000');
    });

    $img->text("Points: {$recipient->points}", 50, 200, function ($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(16);
        $font->color('#000000');
    });

    $img->text("Message: $customMessage", 50, 250, function ($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(14);
        $font->color('#000000');
    });

    $filePath = storage_path('app/public/congratulations.png');
    $img->save($filePath);

    return $filePath;
    }

}