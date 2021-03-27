@extends('layouts.index')

@section('title', $category->title)

@section('content')
  @include('partials.jumbotron')
  @include('partials.grid', ['animals', $animals])
@endsection