<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div class="container text-center">
        <h1>Compiler Page</h1>
        <p>Creator ID: {{ $creatorId }}</p>
        <p>Joiner ID: {{ $joinerId }}</p>
        <p>Redirecting in <span id="timer">5</span> seconds...</p>
    </div>

    <script>
        let countdown = 5;
        const timer = document.getElementById('timer');
        setInterval(() => {
            if (countdown > 0) {
                countdown--;
                timer.innerText = countdown;
            } else {
                window.location.href = '/Hackathon-online-ide'; // Replace with your compiler route
            }
        }, 1000);
    </script>


</body>
</html>
