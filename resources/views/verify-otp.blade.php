<!DOCTYPE HTML>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="shortcut icon" href="favicon.png">
<title>Hackathon Heroes</title>

{{--  <!-- Bootstrap CDN links -->  --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

{{--  <!-- Fonts -->  --}}
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400i&amp;display=swap" rel="stylesheet">

<style>
    body {
        font-family: poppins, sans-serif;
        font-size: 1rem;
        font-weight: 400;
        letter-spacing: .025em;
        color: #868686;
        background-image: url('/images/display.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        -webkit-overflow-scrolling: touch;
        position: fixed;
        z-index: 1;
        overflow: hidden;
    }

    body::before {
        content: " ";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('/images/display.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        filter: brightness(0.1);
        opacity: 0.9;
        z-index: -1;
    }

    .logo-image img{
        padding-top: 120px;
        height: 500px;
    }

    .login{
        padding-top: 50px;
        color: white;
    }

    .login h3{
        font-family: Fantasy;
        font-size: 40px;
    }

    .login h1{
        color: green;
        font-family: Fantasy;
        font-size: 50px;
    }

    .header input{
        background-color: transparent;
        border-bottom: 2px solid green;
        color: white;
        width: 100%;
        border-top: none;
        border-right: none;
        border-left: none;
    }

    .header,
    .footer{
        padding: 20px;
    }

    .footer input{
        background-color: green;
        color: white;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 3px;
        outline: none;
    }

    input:focus{
    outline: none;
    border-bottom: 2px solid #BF40BF;
    transition: 0.4s;
    box-shadow: none;
}

    .register a{
        text-decoration: none;
    }

    .with i{
        font-size: 30px;
        padding-right: 25px;
        padding-bottom: 20px;
        padding-top: 10px;
        color: green;
    }

    .form-container {
    perspective: 1000px;
}

.form {
    transition: transform 0.6s;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    backface-visibility: hidden;
}

.hidden {
    display: none;
}

#verify-form.show {
    transform: rotateY(0deg);
}

#signup-form.show {
    transform: rotateY(360deg);
}

.toggle-link {
    cursor: pointer;
    color: blue;
    text-decoration: underline;
}

/* Change the white to any color */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active{
    -webkit-box-shadow: 0 0 0px 1000px inset;
}

/*Change text in autofill textbox*/
input:-webkit-autofill{
    -webkit-text-fill-color: white !important;
}


</style>

</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 logo-image">
                <img src="images/login2.png">
            </div>
            <div class="col-md-6 login text-center form-container">
                <h1>Hackathon</h1>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

            <form action="{{ route('verify.otp') }}" method="POST" id="verify-form" class="form">
                @csrf
                <div class="header">
                <input type="hidden" name="email" value="{{ old('email', $email) }}">
                <label for="otp">Enter OTP:</label>
                <input type="number" name="otp" placeholder="Enter OTP" required>
                </div>
                @if ($errors->has('otp'))
                    <span class="text-danger">{{ $errors->first('otp') }}</span>
                @endif
                <div class="footer">
                <input type="submit" value="verify">
                </div>
            </form>


            </div>
        </div>
    </div>

{{--  <!-- Bootstrap CND JS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->  --}}

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
{{--  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->  --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

{{--  <!-- Custom JS -->
<!-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->  --}}
<script src="js/jquery.min.js"></script>
<script src="js/wow.min.js"></script>
{{--  <!-- <script src="js/smoothscroll.js"></script> -->
<script src="js/animsition.js"></script>
<!-- <script src="js/jquery.validate.min.js"></script> -->
<!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
<!-- <script src="js/owl.carousel.min.js"></script> -->
<!-- <script src="js/jquery.pagepiling.min.js"></script> -->  --}}

<script src="js/scripts.js"></script>

{{--  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->  --}}

</body>

</html>

