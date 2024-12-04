<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="favicon.png">
        <title>Hackathon Heroes | Admin Panel</title>

        <!-- Bootstrap CDN links -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400i&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}" />
    </head>
        <header class="head">
            <div class="logo border-bottom">
                <strong> HACKATHON ADMIN PANEL </strong>
                <a class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <div id="navbarNav" class="navcol pt-0 d-none d-lg-block">
                <ul>
                    <li class="border-bottom"><a href="{{ url('/admin-Dashboard') }}"><i class="bi  bi-people fs-6 me-2"></i> Users Accounts </a></li>
                    <li class="border-bottom"><a href="{{ url('/admin-Post') }}"><i class="bi fs-6 me-2 bi-file-post"></i>Users Posts</a></li>
                    <li class="border-bottom"><a href="{{ url('/admin-Tournaments') }}"><i class="bi me-2 fs-6  bi-trophy"></i> Tournament</a></li>
                    <li class="border-bottom"><a href="{{ url('/admin-report') }}"><i class="bi me-2 fs-6  bi-mailbox2"></i> Report</a></li>
                </ul>
            </div>
        </header>
        <div  class="main-content">
           <div class="nav-bar sticky-top-xl bg-white shadow-sm w-100 p-3">
               <div class="row">
                   <div class="col-md-5">
                   </div>
                   <div class="col-md-2"></div>
                   <div class="col-md-4 text-end">
                       <div class="dropdown pt-2">
                          <a class="cp pt-4 fw-bolder fs-8 dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            ADMIN
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ url('adminlogout') }}">Logout</a></li>
                          </ul>
                        </div>
                   </div>
                   <div class="col-md-1"></div>
               </div>
           </div>
