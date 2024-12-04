<html>
<head>
    <title>Congratulations!</title>
</head>
<body>
    <h1>Congratulations! You Are a Winner!</h1>
    <p><strong>Tournament:</strong> {{ $tournament->t_name }}</p>
    <p><strong>Organizer:</strong> {{ $tournament->organizer->username }}</p>
    <p><strong>Your Points:</strong> {{ $user->points }}</p>
    <p>Message: {{ $customMessage }}</p>
    <p>Check the attached image for more details!</p>
</body>
</html>
