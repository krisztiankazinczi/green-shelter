@extends('layouts.index')

@section('title', $category->menu->name)

@section('content')
  @include('partials.jumbotron')
  @include('partials.search_order')
  @include('partials.grid', ['animals' => $animals, 'route' => $menu->route])
    @if (Auth::user() && ($create_button_role_id <= Auth::user()->role_id))
      <a href="{{Request::url()}}/create">
        <i class="bg-white cursor-pointer fas fa-plus text-primary position-fixed create-advertisement-button"></i>
      </a>
    @endif
@endsection