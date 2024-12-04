<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light">
    <div class="container my-5" id="results-section">
        <div class="row text-center">
            {{--  <!-- Joiner Section -->  --}}
            <div class="col-md-5">
                <div class="card">
                    {{--  <!-- WINNER Badge -->  --}}
                    @if ($openChallenge->points_joiner > $openChallenge->points_receiver)
                        <span class="badge bg-success position-absolute top-0 start-50 translate-middle-x">WINNER</span>
                    @endif
                    <div class="card-body">
                        <img src="{{ $joiner->profile_image ? asset($joiner->profile_image) : asset('default-avatar.png') }}"
                             alt="Joiner Image" class="img-fluid rounded-circle mb-3" width="150" height="150">
                        <h4>{{ $joiner->username }}</h4>
                        <p class="text-muted">Points: {{ $openChallenge->points_joiner ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{--  <!-- VS Section -->  --}}
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <h1 class="display-4">VS</h1>
            </div>

            {{--  <!-- Creator Section -->  --}}
            <div class="col-md-5">
                <div class="card">
                    {{--  <!-- WINNER Badge -->  --}}
                    @if ($openChallenge->points_receiver > $openChallenge->points_joiner)
                        <span class="badge bg-success position-absolute top-0 start-50 translate-middle-x">WINNER</span>
                    @endif
                    <div class="card-body">
                        <img src="{{ $creator->profile_image ? asset($creator->profile_image) : asset('default-avatar.png') }}"
                             alt="Creator Image" class="img-fluid rounded-circle mb-3" width="150" height="150">
                        <h4>{{ $creator->username }}</h4>
                        <p class="text-muted">Points: {{ $openChallenge->points_receiver ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{--  <!-- Screenshot Button -->  --}}
        <div class="text-center mt-4">
            <button class="btn btn-primary" onclick="takeScreenshot()">Take Screenshot</button>
        </div>
        <div class="mt-3">
            <form action="{{ route('delete.openChallenge') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $openChallenge->id }}">
                <button type="submit" class="btn btn-secondary">Back to Platform</button>
            </form>
        </div>

    </div>


    <script>
        function takeScreenshot() {
            const resultsSection = document.getElementById('results-section');
            html2canvas(resultsSection).then(canvas => {
                // Convert screenshot to data URL
                const screenshotData = canvas.toDataURL('image/png');

                // Create a download link
                const downloadLink = document.createElement('a');
                downloadLink.href = screenshotData;
                downloadLink.download = 'challenge_results.png'; // File name for the screenshot
                downloadLink.click(); // Automatically trigger the download
            });
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
