<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark"">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title> 403 - {{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="{{ asset('storage/img/vote.jpeg') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ asset('storage/img/vote.jpeg') }}">
                    

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"> --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

</head>
<body>
    

    <div class="text-center">
        <h1>403</h1>
        <p>Oops! The Page you're looking for is Forbidden.</p>
        <a href="{{ url('/') }}">Return Home</a>
    </div>

    
</body>
</html>