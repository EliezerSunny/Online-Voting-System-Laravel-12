<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="{{ asset('storage/img/vote.jpeg') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ asset('storage/img/vote.jpeg') }}">
                    

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"> --}}

  {{-- ajax --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  {{-- ajax end --}}


  


      <link rel="stylesheet" href="{{ asset('storage/assets/css/countdown.css') }}" />

<script type="module" src="{{ asset('storage/assets/js/countdown.js') }}"></script>


  



@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
