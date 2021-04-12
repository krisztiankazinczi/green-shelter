@extends('layouts.index')

@section('title', 'My liked advertisements')

@section('content')
  <div class="d-flex justify-content-center">
    <h1>Kedvelt hirdetéseim</h1>
  </div>
  @include('partials.grid', ['animals' => $animals])
@endsection