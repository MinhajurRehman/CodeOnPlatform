<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge Verses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row text-center">
            {{-- <!-- Creator Section -->  --}}
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ $creator->profile_image ? asset($creator->profile_image) : asset('default-avatar.png') }}" alt="Creator Image" class="img-fluid rounded-circle mb-3" width="150" height="150">
                        <h4>{{ $creator->username }}</h4>
                        <p class="text-muted">Creator</p>
                    </div>
                </div>
            </div>

            <!-- VS Section -->
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <h1 class="display-4">VS</h1>
            </div>

            <!-- Joiner Section -->
            <div class="col-md-5">
                @if ($joiner)
                <div class="card">
                    <div class="card-body">
                        <img src="{{ $joiner->profile_image ? asset($joiner->profile_image) : asset('default-avatar.png') }}" alt="Joiner Image" class="img-fluid rounded-circle mb-3" width="150" height="150">
                        <h4>{{ $joiner->username }}</h4>
                        <p class="text-muted">Joiner</p>
                    </div>
                </div>
                @else
                <div class="alert alert-warning">
                    No joiner has joined this challenge yet.
                </div>
                @endif
            </div>
        </div>

        <!-- Timer Section -->
        <div class="row mt-4">
            <div class="col text-center">
                <h3 id="timer">Starting challenge in: 10</h3>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Countdown timer function
        let countdown = 10;
        const timerElement = document.getElementById('timer');

        const interval = setInterval(function() {
            countdown--;
            timerElement.innerHTML = `Starting challenge in: ${countdown}`;

            // When the countdown reaches 0, redirect both the creator and joiner to the compiler
            if (countdown === 0) {
                clearInterval(interval);
                window.location.href = "{{ url('/openChallenge-compiler', ['id' => $challenge->id]) }}";
            }
        }, 1000); // Update every second

    </script>
</body>
</html>
