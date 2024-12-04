<!DOCTYPE HTML>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="shortcut icon" href="favicon.png">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">
<title>Hackathon Heroes</title>

<!-- Bootstrap CDN links -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400i&amp;display=swap" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" media="screen">
<style>
  .modal-backdrop {
    z-index: 990 !important;
}
</style>
</head>
<body id="page-transition-overlay" class="{{ session('Theme') == 'Dark' ? 'dark-theme' : (session('Theme') == 'Light' ? 'light-theme' : 'Default') }}">

{{--  <div class="loader-container">
    <div class="loader"></div>
</div>  --}}


<script>
    $(document).ready(function() {
      $('#savePostButton').on('click', function() {
        // Get the values from the form
        const title = $('#postTitle').val();
        const content = $('#postContent').val();

        // Simple validation
        if (title && content) {
          alert('Post Saved!\n\nTitle: ' + title + '\nContent: ' + content);
          // Clear the form
          $('#createPostForm')[0].reset();
          // Close the modal
          $('#createPostModal').modal('hide');
        } else {
          alert('Please fill out all fields.');
        }
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Create the overlay element
        var overlay = document.createElement('div');
        overlay.id = 'page-transition-overlay';
        document.body.appendChild(overlay);

        // Add event listeners to all links
        var links = document.querySelectorAll('a');
        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                // Prevent default action
                event.preventDefault();

                // Start the animation by making the overlay visible
                overlay.style.transform = 'translateX(0)';
                overlay.style.opacity = '1';

                // Wait for the animation to finish before navigating
                setTimeout(function() {
                    window.location.href = link.href;
                }, 400); // This should match the duration of the animation (0.4s)
            });
        });
    });


</script>


<div class="container">
    <div class="row text-center logo-H">
        <div class="col-md-12">
           <span class="main">
              <strong> Hackathon <br>
            </strong>
               H &nbsp;e &nbsp;r &nbsp;o &nbsp;e &nbsp;s
            </span>
        </div>
    </div>

    {{--  side bar  --}}
    <div class="click-capture"></div>

<div class="menu">
<span class="close-menu icon-cross2 right-boxed"></span>
<ul class="menu-list right-boxed">

    <li class="user-info">
            <img src="{{ asset($user->profile_image) }}" alt="+" class="profile-pic" style="border-radius: 50%; width: 60px; height: 60px;">
      <div class="user-details" style="display: inline-block;">
        <span class="user-name" style="font-weight: bold;">
            <a href="{{ url('/profile') }}">
                {{ $user->username }}
                </a>
            </span>
            <br>
        <span class="user-email" style="color: #888; font-size:15px;">
            {{ $user->email }}
        </span>
    </div>
    <div class="user-icon-menu">
        <a href="{{ url('/thread') }}">
          <i class="fas fa-home"></i>
      </a>
      <a href="{{ url('/setting') }}">
          <i class="fas fa-cog"></i>
      </a>
    </div>
    </li>


    <li>
        <div class="form">
            <form action="{{ route('search') }}" method="GET">
            <i class="fa fa-search"></i>
            <input type="text" name="query" class="form-control form-input" placeholder="Search anything...">
            <span class="left-pan"></span>
            </form>
          </div>
      </li>

    <li><hr></li>

    <li>
      <i class="fas fa-trophy" style="margin-right: 10px;"></i>
      <a href="{{ url('/tournament') }}">
          <span style="font-size: 1.2em;">Announcements</span>
      </a>
    </li>

    <li>
        <i class="fas fa-chart-line" style="margin-right: 10px;"></i>
        <a href="{{ url('/leaderboard') }}">
            <span style="font-size: 1.2em;">leaderboard</span>
        </a>
      </li>

    <li>
      <i class="fas fa-fist-raised" style="margin-right: 10px;"></i>
      <a href="{{ url('/challenge') }}">
          <span style="font-size: 1.2em;">Challenges</span>
      </a>
    </li>


    <li><hr></li>

    <li style="text-align: center; padding-top: 10px;">
      <a href="{{ url('logout') }}" class="btn btn-danger" style="color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
        <i class="fa fa-sign-out" style="color:white; font-size:15px; padding-right: 5px;"></i>
        Logout
    </a>
    </li>


</ul>
</div>

<header class="navbar boxed">
<div class="navbar-bg"></div>
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</header>
