@extends('layouts.index')

@section('title', 'Profil - ' . Auth::user()->name)

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-5 col-md-3 col-lg-2">
        <div class="d-flex justify-content-center align-items-center flex-column">
          <img
            src="{{Auth::user()->avatar_uri ? 'images/' . Auth::user()->avatar_uri : 'images/users/default-profile-image.jpg'}}"
            class="rounded-circle"
            style="width: 200px; height: 200px;"
          />
          <a href="{{ route('edit.profile') }}">
            <button 
              type="button"
              class="btn btn-secondary mt-4"
            >Szerkesztés</button>
          </a>
        </div>
      </div>
      <div class="col-12 col-sm-7 col-md-9 col-lg-10">
        <div class="ml-3 mt-3">
          One of three columnssdag sad gas gsd gasd,m ngvbqs; kjcvq flcsderqsk;dagvo sdgak
        </div>
      </div>
    </div>
  </div>
@endsection