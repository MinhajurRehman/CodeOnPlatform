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
<link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css') }}">
<link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Fonts -->
<link href="{{ url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap') }}" rel="stylesheet">
<link href="{{ url('https://fonts.googleapis.com/css?family=Libre+Baskerville:400i&amp;display=swap') }}" rel="stylesheet">
<link href="{{ url('css/style.css') }}" rel="stylesheet" media="screen">
<style>
  .modal-backdrop {
    z-index: 990 !important;
}

    .avatar-container {
        position: relative;
        display: inline-block;
      }

      .avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
      }

      .edit-overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 55px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        opacity: 0;
        cursor: pointer;
        transition: opacity 0.3s ease;
      }

      .avatar-container:hover .edit-overlay {
        opacity: 1;
      }

      .edit-overlay span {
        font-size: 16px;
        font-weight: bold;
      }

      .file-input {
        display: none;
      }


</style>
</head>
<body id="page-transition-overlay" class="{{ session('Theme') == 'Dark' ? 'dark-theme' : (session('Theme') == 'Light' ? 'light-theme' : 'Default') }}">
<br>
<br>
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
            <span class="left-pan"><i class="fa fa-microphone"></i></span>
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
      <a href="{{ url('logout') }}" class="btn btn-danger" style="color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Logout</a>
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

<br>
<br>
<br>
<br>
 <div class="row">
        <div class="col-md-12">
            <div class="scroll-stylish">
            <div class="main-body">
                <div class="row gutters-sm">

                  <div class="col-md-4 mb-3">
                    <div class="card-3">
                      <div class="card-body-3">
                        <div class="d-flex flex-column align-items-center text-center">
                          <img src="{{ asset($users->profile_image) }}" alt="Admin" style="border-radius: 50%; width: 120px; height: 120px;">
                          <div class="mt-3">
                            <h4>{{ $users->username }}</h4>
                            <p class="text-muted font-size-sm">{{ $users->email }}</p>
                            <p class="text-secondary mb-1">Full Stack Developer</p>
                            <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-8">
                    <div class="row gutters-sm">
                        <div class="col-sm-6 mb-3">
                          <div class="card-3 h-100">
                            <div class="card-body-3">
                              <small>Points ({{ $user->leaderboard }})</small>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success"  role="progressbar" style="width:{{ $user->leaderboard }}%;" aria-valuenow="{{ $user->leaderboard }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <small>Threads</small>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $posting->id }}%" aria-valuenow="{{ $posting->id }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <small>Challenges</small>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $challenges->id }}%" aria-valuenow="{{ $challenges->id }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <small>Tournaments</small>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $data->id }}%" aria-valuenow="{{ $data->id }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <small>Progress</small>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                          <div class="card-3 h-100">
                            <div class="card-body-3">
                              <br>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <br>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $data->id }}%" aria-valuenow="{{ $data->id }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <br>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $posting->id }}%" aria-valuenow="{{ $posting->id }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <br>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $challenges->id }}%" aria-valuenow="{{ $challenges->id }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <br>
                              <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width:{{ $user->leaderboard }}%;" aria-valuenow="{{ $user->leaderboard }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>


                </div>

        </div>
        </div>
    </div>
 </div>



<!-- Bootstrap CND JS -->
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ url('https://code.jquery.com/jquery-3.2.1.slim.min.js') }}" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="{{ url('https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js') }}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js') }}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Custom JS -->
<script data-cfasync="false" src="{{ url('../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script><script src="js/jquery.min.js"></script>
<script src="{{ url('js/wow.min.js') }}"></script>
<script src="{{ url('js/smoothscroll.js') }}"></script>
<script src="{{ url('js/animsition.js') }}"></script>
<script src="{{ url('js/jquery.validate.min.js') }}"></script>
<script src="{{ url('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ url('js/owl.carousel.min.js') }}"></script>
<script src="{{ url('js/jquery.pagepiling.min.js') }}"></script>

<script src="{{ url('js/scripts.js') }}"></script>
</body>

</html>

