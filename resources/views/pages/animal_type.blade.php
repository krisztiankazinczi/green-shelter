@extends('layouts.index')

{{-- @section('title', $animals->animalType->name) --}}

@section('content')
  {{-- @include('partials.jumbotron') --}}
  @include('partials.grid', ['animals' => $animals])
    {{-- @if (Auth::user() && ($create_button_role_id <= Auth::user()->role_id))
      <a href="{{Request::url()}}/create">
        <i class="fas fa-plus" style="color: green; background-color: white; position: fixed; bottom: 40px; right: 40px; z-index: 1000; padding:10px; font-size: 40px; border-radius: 50%; box-shadow: 0 0 10px 4px rgba(0, 0, 0, .15); cursor: pointer;"></i>
      </a>
    @endif --}}
@endsection