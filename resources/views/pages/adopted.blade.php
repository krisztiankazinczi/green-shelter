@extends('layouts.index')

@section('title', $animal->title)

@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
      @if(!empty(Session::get('success')))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
      @endif
      @if(!empty(Session::get('error')))
        <div class="alert alert-danger"> {{ Session::get('error') }}</div>
      @endif
    </div>
    <div class="d-flex justify-content-center">
      <h1>{{ $animal->title }}</h1>
    </div>
    <div class="d-flex justify-content-center">
      <h3 class="mt-5">{!! $animal->description !!}</h3>
    </div>
    <div class="container-fluid mt-5">
      <div class="row user-image mb-3 text-center mt-4">
        @foreach ($animal->images as $image)
            <img src="/images/{{$image->filename}}" alt="{{ $animal->title }}" style="height: 300px; margin-right: 10px; margin-bottom:10px; max-width: 600px; {{ $image->main ? 'border: 10px solid blue;' : '' }}" />
        @endforeach
      </div>
    </div>
    
    <div class="d-flex justify-content-between">
      <a href="{{ url()->previous() }}">
        <button class="btn btn-primary" >
          Vissza
        </button>
      </a>
      <div class="d-flex flex-row">
        @if (Auth::user() && ($animal->user_id == Auth::user()->id || Auth::user()->role_id == 3))
          {{-- <form action="{{ route('delete.advertisement', [$animal->id]) }}" method="POST">
            @csrf
            @method('DELETE') 
            <button type="submit" class="btn btn-danger" >
              Törlés
            </button>
          </form> --}}
        @endif
      </div>
    </div>
  </div>
@endsection