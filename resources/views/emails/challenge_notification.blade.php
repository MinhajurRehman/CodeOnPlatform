<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Challenge Send Via Email</title>
</head>
<body>
    <p>Hello {{ $challenge->receiver->name }},</p>

    <p>{{ $challenge->sender->name }} has challenged you to: {{ $challenge->challenge_name }}</p>
    <p>Reason: {{ $challenge->challenge_reason }}</p>

    <p>Do you accept the challenge?</p>

    <a href="{{ url('/challenge-response/' . $challenge->id . '/accept') }}" style="padding: 10px; background-color: green; color: white; text-decoration: none;">Accept</a>
    <a href="{{ url('/challenge-response/' . $challenge->id . '/reject') }}" style="padding: 10px; background-color: red; color: white; text-decoration: none;">Reject</a>

</body>
</html>
