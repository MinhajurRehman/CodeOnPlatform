<!DOCTYPE HTML>
<html lang="en">

<!-- robert/  03:29:43 GMT -->
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
<body id="page-transition-overlay">
<div class="animsition">
<div class="loader"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>

<div class="notifications" onclick="openModal()">
    <i class="fas fa-bell"></i>
    <div class="badge">1</div>
</div>

<div id="notificationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="Profile Picture">
            <div class="text">
                <div class="name">John Doe</div>
                <div class="message">Leave a Solution on your post</div>
            </div>
        </div>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="Profile Picture">
            <div class="text">
                <div class="name">John Doe</div>
                <div class="message">Sent to you challenge</div>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('notificationModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('notificationModal').style.display = 'none';
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('notificationModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }


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

    <div class="click-capture"></div>

<div class="menu">
<span class="close-menu icon-cross2 right-boxed"></span>
<ul class="menu-list right-boxed">
<li data-menuanchor="page1">
  <i class="fas fa-home"></i>
  <a href="{{ url('/thread') }}">
  Home
  </a>
</li>
<li data-menuanchor="page2">
  <i class="fas fa-search"></i>
<a href="{{ url('/search') }}">Search</a>
</li>
<li data-menuanchor="page3">
  <i class="fas fa-user"></i>
<a href="{{ url('/profile') }}">Profile</a>
</li>
<li data-menuanchor="page4">
  <i class="fas fa-chart-line"></i>
<a href="{{ url('/leaderboard') }}">leaderboard</a>
</li>
<li data-menuanchor="page5">
  <i class="fas fa-cog"></i>
<a href="{{ url('/setting') }}">Setting</a>
</li>
<li data-menuanchor="page6">
  <i class="fas fa-trophy"></i>
<a href="{{ url('/tournament') }}">Tournaments</a>
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
