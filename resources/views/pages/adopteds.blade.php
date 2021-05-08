@extends('layouts.index')

@section('title', $category->menu->name)

@section('content')
  @include('partials.jumbotron')
  @include('partials.search_order')
  @include('partials.grid', ['animals' => $animals, 'route' => $category->menu->route])

@endsection