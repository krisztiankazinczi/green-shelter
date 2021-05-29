@extends('layouts.index')

@section('title', 'My liked advertisements')

@section('content')
  <div class="mb-4 d-flex justify-content-center">
    <h1 class="mt-4 text-center">Kedvelt hirdetéseim</h1>
  </div>
  @include('partials.search_order')
  @include('partials.grid', ['animals' => $animals])
@endsection