<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title') - Zöldmenedék</title>
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans" rel="stylesheet">
      <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('css/app.css')}}"> 
      <link rel="stylesheet" href="{{asset('css/custom.css')}}">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      @yield('cdn-files')
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="{{ asset('js/share.js') }}"></script> <!-- for social share package -->
      <script src="{{ asset('js/custom.js') }}"></script>
      <script src="{{ asset('js/validation.js') }}"></script>
    </head>
    <body style="overflow-x: hidden;">
      <div class="d-flex flex-column vh-100">
        @include('partials.nav')
        @if (!empty(Session::get('success')) || !empty(Session::get('error')))
          <div class="d-flex justify-content-center position-relative" id="message-from-server">
            <div class="p-4 rounded {{ !empty(Session::get('success')) ? 'bg-success' : 'bg-danger' }} position-absolute w-50">
              <h3 class="text-white">{{ !empty(Session::get('success')) ? 'Sikeres' : 'Hiba' }}</h3>
              <h5 class="mt-2 text-white">{{ !empty(Session::get('success')) ? Session::get('success') : Session::get('error') }}</h5>
            </div>
            <button type="button" class="mb-1 ml-2 close position-absolute" aria-label="Close" onclick="closeMessageFromServer()">
              <span class="text-white h1" aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <main class="flex-grow-1">@yield('content')</main>
        @include('partials.footer')
      </div>

    </body>
</html> 