<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>

<body>
    <h2>Welcome, {{ $user->name }} 👋</h2>

    <p>Thank you for registering with Event Management.</p>

    <p>Your account has been created successfully.</p>

    <p>
        <strong>Name:</strong> {{ $user->name }}<br>
        <strong>Email:</strong> {{ $user->email }}
    </p>

    <p>We're excited to have you with us.</p>

    <br>

    <p>Regards,</p>
    <p><strong>Event Management Team</strong></p>
</body>

</html>