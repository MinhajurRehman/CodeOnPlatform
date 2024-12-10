<html>
<head>
    <title>Verify Your Account</title>
</head>
<body>
    <h1>Hello, {{ $user->username }}</h1>
    <p>Thank you for registering with us. Please use the following One-Time Password (OTP) to verify your account:</p>
    <h2 style="color: #2d3748; font-size: 24px;">{{ $otp }}</h2>
    <p>This OTP is valid for 10 minutes. If you did not request this, please ignore this email.</p>
    <p>Thank you,</p>
    <p>Hackathon Heroes</p>
</body>
</html>
