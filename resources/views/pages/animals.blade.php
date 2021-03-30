@extends('layouts.index')

@section('title', $category->title)

@section('content')
  @include('partials.jumbotron')
  {{-- <i class="fas fa-plus-circle" style="color: black;"></i> --}}
  @include('partials.grid', ['animals', $animals])
    <a href="{{Request::url()}}/create">
      <i class="fas fa-plus" style="color: green; position: fixed; bottom: 40px; right: 40px; z-index: 1000; padding:10px; font-size: 40px; border-radius: 50%; box-shadow: 0 0 10px 4px rgba(0, 0, 0, .15); cursor: pointer;"></i>
    </a>
@endsection