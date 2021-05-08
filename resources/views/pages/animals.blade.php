@extends('layouts.index')

@section('title', $category->menu->name)

@section('content')
  @include('partials.jumbotron')
  <div class="d-flex justify-content-center">
      <div class="form-group d-flex justify-content-center w-75" id="search-fields">
        <input type="text" id="search-input" class="form-control" style="height: 50px; border-radius: 100px 0 0 100px;">
        <div class="optionbox primary-color-select">
          <select id="filter_by" class="form-control" style="border-radius: 0;">
            <option value="">Szűrés</option>
            <option value="created_at">Létrehozás</option>
            <option value="title">Cím</option>
          </select>
        </div>
        <div class="optionbox secondary-color-select">
          <select id="order" class="form-control" style="border-radius: 0;">
            <option value="">Sorrend</option>
            <option value="desc">Csökkenő</option>
            <option value="asc">Növekvő</option>
          </select>
        </div>
        <button 
          class="btn btn-primary" 
          style="border-radius: 0 100px 100px 0; width: 150px; font-size: 20px; letter-spacing: 1.5px;"
          onclick="redirectToSearchUrl()"
        >Keresés</button>
      </div>
  </div>
  @include('partials.grid', ['animals' => $animals, 'route' => $menu->route])
    @if (Auth::user() && ($create_button_role_id <= Auth::user()->role_id))
      <a href="{{Request::url()}}/create">
        <i class="bg-white cursor-pointer fas fa-plus text-primary position-fixed create-advertisement-button"></i>
      </a>
    @endif
@endsection