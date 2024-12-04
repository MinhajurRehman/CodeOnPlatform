<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Invitation</title>
</head>
<body>
    <h1>Hello {{ $participant->username }},</h1>
    <p>You have joined the '{{ $tournament->t_name }}' tournament organized by {{ $organizer->username }}.</p>
    <p><strong>Details:</strong></p>
    <p>Date & Time: {{ $tournament->t_date_time }}</p>
    <p>Winning Prize: {{ $tournament->t_win_price }}</p>
    <p>Description: {{ $tournament->t_description }}</p>
@if($isLinkActive)
    <p>Click on this link to join: <a href="{{ $link }}">Join Tournament</a></p>
    @else
    <p style="color: red;">The tournament has ended, and this link is no longer active.</p>
@endif
</body>
</html>
