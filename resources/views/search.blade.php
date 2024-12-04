@include('nav.header')

<style>
    /* Body and Container Styling */
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Centering the search form */
    .search-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .search-input {
        width: 60%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .search-btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        background-color: #28a745;
        color: white;
        border: none;
    }

    .search-btn:hover {
        background-color: #28a745 !important;
    }

    /* Results Section Styling */
    .result-item {
        color:green;
        padding: 15px;
        margin: 10px 0;
        border-bottom: 2px solid green;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .result-item a {
        margin: 0;
        font-size: 20px;
        text-decoration: none !important;
        color: #28a745;
        padding-left: 20px;
    }


    h2, h4 {
        color: #333;
        text-align: center;
    }

    /* Styling for empty results */
    .text-center {
        text-align: center;
    }

</style>

<div class="container">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search tournaments, posts, or users" class="form-control" required>
        <button type="submit" class="btn btn-success mt-2">Search</button>
    </form>

    <h2 class="mt-4">Search Results</h2>

    @if($tournaments->isEmpty() && $posts->isEmpty() && $users->isEmpty())
    <p class="text-center">No results found for "{{ $query }}".</p>
@else
    <!-- Tournaments Section -->
    @if($tournaments->isNotEmpty())
    <div class="mt-4">
        @foreach($tournaments as $tournament)
            <div class="result-item">
                <img src=" {{ asset($tournament->t_poster_image) }}" class="img rounded-circle" height="40px" width="40px">
                <a href="{{ url('/tournament') }}">
                    {{ $tournament->t_name }}
                </a>
            </div>
        @endforeach
    </div>
    @endif

    <!-- Posts Section -->
    @if($posts->isNotEmpty())
    <div class="mt-4">
        @foreach($posts as $post)
            <div class="result-item">
                <img src=" {{ asset($post->post_image) }}" class="img rounded-circle" height="40px" width="40px">
                <a href="{{ url('/thread') }}">{{ $post->post_content }}</a>
            </div>
        @endforeach
    </div>
    @endif

    <!-- Users Section -->
    @if($users->isNotEmpty())
    <div class="mt-4">
        @foreach($users as $user)
            <div class="result-item">

                <img src=" {{ asset($user->profile_image) }}" class="img rounded-circle" height="40px" width="40px">
                <a href="{{ route('users.show', $user->id) }}">
                    {{ $user->username }}
                </a>
            </div>
        @endforeach
    </div>
    @endif
@endif

</div>

<!-- Bootstrap CND JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<!-- Custom JS -->
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/animsition.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.pagepiling.min.js"></script>

<script src="js/scripts.js"></script>

</body>
</html>
