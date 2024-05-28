<!DOCTYPE HTML>
<html lang="en">

<!-- robert/  03:29:43 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="shortcut icon" href="favicon.png">
<title>Hackathon Heroes</title>

<!-- Bootstrap CDN links -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400i&amp;display=swap" rel="stylesheet">
<link href="css/adminstyle.css" rel="stylesheet" media="screen">

</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="admin-logo">
                    <h1>HACKATHON HEROES</h1>
                    <img src="images/admin-login.png">
                    <h3>ADMIN PANEL</h3>
                </div>
            </div>
            <div class="col-md-5">
                <div class="admin-login">
                    <form method="post">
                        @csrf
                        <div class="header">
                            <input type="email" placeholder="Enter Credentials" name="adminemail">
                        </div>
                        <div class="header">
                            <input type="password" placeholder="Enter Credentials" name="adminpassword">
                        </div>
                        <div class="footer">
                            <input type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Bootstrap CND JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/jquery.min.js"></script>
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
