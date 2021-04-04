@extends('layouts.index')

@section('title', 'Kezdőlap')

@section('content')
@if (session('hello'))
     <div class="alert alert-success">
         {{ session('hello') }}
     </div>
@endif
  {{-- <div class="jumbotron jumbotron-fluid" style="background: url({{ URL::to('/') . '/images/home_banner.jpg' }}) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 90vh;">
        <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
            <div class="w-50">
              <h1 class="text-center">Valamilyen meno szoveg</h1>
            </div>
        </div>
    </div> --}}
@endsection