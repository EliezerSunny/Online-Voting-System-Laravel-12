<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  
    <title>Welcome to {{ config('app.name') }}</title>
</head>
<body style="text-align: center">




    <img src="{{asset('https://media.istockphoto.com/id/1710661883/photo/online-voting-in-the-ballot-box.jpg?s=612x612&w=0&k=20&c=D9y8w62Kd29fkvRX3E-xU6CGMqorB4RBWG0BIrmRUM8=')}}" title="${APP_NAME}" alt="${APP_NAME}" 
           style="width: 80px;"
            >

    <div style="border: 1px solid gray; padding:12px; border-radius:5px;">
    <h2>Welcome Back To {{ config('app.name') }},  {{ $user['username'] }}</h2>
           <h4>Your login details</h4>
    <p style="text-align: left">Email: {{$user['email']}}</p>
    <p style="text-align: left">Password: {{$user['username']}}</p>


    <br>


    <p>Access your account <a href="http://127.0.0.1:8000/login">here</a>. Vote Wisely!!! &#128521; </p>

    <p>Please keep this information secure. Thank you!</p>

    </div>


</body>
</html>

