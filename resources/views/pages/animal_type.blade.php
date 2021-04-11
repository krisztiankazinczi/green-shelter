@extends('layouts.index')

{{-- @section('title', $animals->animalType->name) --}}

@section('content')
  @if(!empty(Session::get('success')))
    <div class="alert alert-success"> {{ Session::get('success') }}</div>
  @endif
  @if(!empty(Session::get('error')))
    <div class="alert alert-danger"> {{ Session::get('error') }}</div>
  @endif
  <div class="row">
    <div class="col-12 col-md-6">
    <div class="d-flex justify-content-center" style="height: 500px; max-width: 100%;">
      <img 
        src="/images/{{ $animal_type->image_uri }}" 
        alt="{{ $animal_type->name }}"   
      />
    </div>
    </div>
    <div class="col-12 col-md-6">
      <h1>{{ $animal_type->name }}</h1>
      <h5>{!! $animal_type->description !!}</h5>
    </div>
  </div>
  @include('partials.grid', ['animals' => $animals])
@endsection