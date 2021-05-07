@extends('layouts.index')

@section('title', $category->menu->name)

@section('content')
  @include('partials.jumbotron')
  <div class="d-flex justify-content-center">
      <div class="form-group d-flex justify-content-center w-75" id="search-fields">
        <input type="text" id="search-input" class="form-control" style="height: 50px; border-radius: 100px 0 0 100px;">
        <div class="optionbox primary-color-select">
          <select class="form-control" style="border-radius: 0;">
            <option value="">Sorrend</option>
            <option value="created_at">Létrehozás</option>
            <option value="title">Cím</option>
          </select>
        </div>
        <div class="optionbox secondary-color-select">
          <select class="form-control" style="border-radius: 0;">
            <option value="">Sorrend</option>
            <option value="desc">Csökkenő</option>
            <option value="asc">Növekvő</option>
          </select>
        </div>
        <button class="btn btn-primary" style="border-radius: 0 100px 100px 0; width: 150px; font-size: 20px; letter-spacing: 1.5px;">Keresés</button>
      </div>
  </div>
  @include('partials.grid', ['animals' => $animals, 'route' => $menu->route])
    @if (Auth::user() && ($create_button_role_id <= Auth::user()->role_id))
      <a href="{{Request::url()}}/create">
        <i class="fas fa-plus" style="color: green; background-color: white; position: fixed; bottom: 40px; right: 40px; z-index: 1000; padding:10px; font-size: 40px; border-radius: 50%; box-shadow: 0 0 10px 4px rgba(0, 0, 0, .15); cursor: pointer;"></i>
      </a>
    @endif
@endsection