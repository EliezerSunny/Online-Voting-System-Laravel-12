

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Login Notification ( {{ config('app.name') }} )</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f4f6f8;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    .email-container {
      max-width: 600px;
      margin: auto;
      background: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .header {
      background-color: #4A90E2;
      color: white;
      padding: 30px 20px;
      text-align: center;
    }
    .header h1 {
      margin: 0;
      font-size: 24px;
    }
    .content {
      padding: 30px 20px;
      color: #333;
      line-height: 1.6;
    }
    .content h2 {
      margin-top: 0;
      font-size: 20px;
      color: #222;
    }
    .button {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 25px;
      background-color: #4A90E2;
      color: #fff !important;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .footer {
      padding: 20px;
      font-size: 12px;
      text-align: center;
      color: #888;
    }
    @media only screen and (max-width: 600px) {
      .email-container {
        width: 100% !important;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <h1>Welcome Back, {{ $user->username }}!</h1>
    </div>
    <div class="content">
      <h2>Login Alert</h2>
      <p>We noticed a login to your account. If this was you, you can safely ignore this email.</p>
      <p><strong>Login Details:</strong><br>
        IP Address: {{ $ipAddress }}<br>
        Location: {{ $location }}<br>
        Time: {{ $loginTime  }}
      </p>
      <a href="{{ $loginUrl }}" class="button">Go to Home Page</a>
    </div>
    <div class="footer">
      If you did not perform this login, please reset your password immediately.<br><br>
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</body>
</html>
