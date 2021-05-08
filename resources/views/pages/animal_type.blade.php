@extends('layouts.index')

@section('title', $animal_type->name)

@section('content')
  <div class="row animal-type-border-bottom">
    <div class="col-12 col-md-6">
      <div class="mt-5 mb-2 d-flex justify-content-center align-items-center" style="max-width: 100%;">
        <img 
          src="/images/{{ $animal_type->image_uri }}" 
          width="auto"
          height="300px;"
          alt="{{ $animal_type->name }}"   
        />
      </div>
    </div>
    <div class="mt-5 col-12 col-md-6">
        <h1 class="p-3 text-white animals-jumbotron-title w-75">{{ $animal_type->name }}</h1>
        <h5 class="p-3 mt-4 mr-3 text-white animals-jumbotron-description">{{ $animal_type->description }}</h5>
    </div>
  </div>
  <div class="mt-5">
    @include('partials.search_order')
  </div>
  @include('partials.grid', ['animals' => $animals])
@endsection