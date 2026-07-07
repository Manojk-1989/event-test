<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>

<h2>Hello {{ $user->name }},</h2>

<p>You requested a password reset.</p>

<p>Use the following token to reset your password:</p>

<h3>{{ $token }}</h3>

<p>This token is valid for 60 minutes.</p>

<p>If you didn't request this, please ignore this email.</p>

</body>
</html>