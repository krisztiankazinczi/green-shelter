@extends('layouts.index')

@section('title', 'Profil - ' . Auth::user()->name)

@section('content')
  <div class="container mt-4">
    <div class="row">
      <div class="col-12 col-sm-5 col-md-3 col-lg-2">
        <div class="d-flex justify-content-center align-items-center flex-column">
          <img
            src="{{Auth::user()->avatar_uri ? '/images/' . Auth::user()->avatar_uri : '/images/users/default-profile-image.jpg'}}"
            class="avatar img-circle rounded-circle img-thumbnail"
            style="width: 200px;"
          />
          <a href="{{ route('edit.profile') }}">
            <button 
              type="button"
              class="mt-4 btn btn-secondary btn-sm"
            >Szerkesztés</button>
          </a>
          <a href="#">
            <button 
              type="button"
              class="mt-2 btn btn-secondary btn-sm"
            >Jelszó változtatás</button>
          </a>
          <a href="#">
            <button 
              type="button"
              class="mt-2 btn btn-danger btn-sm"
            >Profil törlése</button>
          </a>
        </div>
      </div>
      <div class="col-12 col-sm-7 col-md-9 col-lg-10">
        <div class="mt-3 ml-3 row">
          <div class="col-md-2">
            Name 
          </div>
          <div class="col-md-10">
            {{ Auth::user()->name }}
          </div>
        </div>
        <div class="mt-3 ml-3 row">
          <div class="col-md-2">
            Email 
          </div>
          <div class="col-md-10">
            {{ Auth::user()->email }}
          </div>
        </div>
        <div class="mt-3 ml-3 row">
          <div class="col-md-2">
            Bio 
          </div>
          <div class="col-md-10">
            {!! Auth::user()->bio !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection