@extends('layouts.index')

@section('title', $animal->title)

@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
      <h1>{{ $animal->title }}</h1>
    </div>
    <div class="d-flex justify-content-center">
      <h3 class="mt-5">{{ $animal->description }}</h3>
    </div>
    <div class="container-fluid mt-5">
      <div class="row">
        @foreach ($animal->images as $image)
          <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <img class="card-img-top img-fluid" style="height: 15rem; {{ $image->main ? 'border: 10px solid blue;' : '' }}" src="/images/{{ $image->filename }}" alt={{ $animal->title }}>
          </div>
        @endforeach
      </div>
    </div>
    <div class="d-flex justify-content-between">
      <a href="{{ url()->previous() }}">
        <button class="btn btn-primary" >
          Vissza
        </button>
      </a>
      <div>
        @if (Auth::user() && ($animal->user_id == Auth::user()->id || Auth::user()->role_id == 3))
          <a href="/{{ $animal->menu->route }}/{{ $animal->id }}/edit">
            <button class="btn btn-warning" >
              Szerkesztés
            </button>
          </a>
          <a href="/{{ $animal->menu->route }}/{{ $animal->id }}/delete">
            <button class="btn btn-danger" >
              Törlés
            </button>
          </a>
        @endif
      </div>
    </div>
  </div>
@endsection