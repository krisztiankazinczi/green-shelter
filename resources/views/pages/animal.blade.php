@extends('layouts.index')

@section('title', $animal->title)

@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
      @if(!empty(Session::get('success')))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
      @endif
      @if(!empty(Session::get('error')))
        <div class="alert alert-danger"> {{ Session::get('error') }}</div>
      @endif
    </div>
    <p class="text text-danger">
      @isset($animal->adoptions)
        @foreach ($animal->adoptions as $adoption)
          @if (Auth::user() && $adoption->user_id == Auth::user()->id)
            Befogadási szándékodat rögzítettük, hamarosan felvesszük veled a kapcsolatot.
          @endif
        @endforeach
      @endisset
    </p>
    <div class="d-flex justify-content-center">
      <h1>{{ $animal->title }}</h1>
    </div>
    <div class="d-flex justify-content-center">
      <h3 class="mt-5">{!! $animal->description !!}</h3>
    </div>
    <div class="mt-5 container-fluid">
      <div class="mt-4 mb-3 text-center row user-image">
        @foreach ($animal->images as $image)
            <img src="/images/{{$image->filename}}" alt="{{ $animal->title }}" style="height: 300px; margin-right: 10px; margin-bottom:10px; max-width: 600px; {{ $image->main ? 'border: 10px solid blue;' : '' }}" />
        @endforeach
      </div>
    </div>
    
    <div class="d-flex justify-content-between">
      <a href="{{ url()->previous() }}">
        <button class="btn btn-primary" >
          Vissza
        </button>
      </a>
      <div class="d-flex justify-content-end align-items-center">
        @include('partials.like_icon_count', [
          'likesCount' => $animal->likesCount, 
          'animal_id' => $animal->id,
          'icon_classes' => 'mr-3 mb-0 h3',
        ])
        @if (!$animal->adopted && Auth::user())
          @if ($adoptionRequest)
            <button 
              type="submit" 
              class="mr-3 btn btn-danger" 
              data-toggle="modal" 
              data-target="#{{ $animal->id . '-adopt-revert' }}"
            >
              Befogadási Szándék Visszavonás
            </button>
            @include(
            'partials.modal_confirm', 
            [
              'id' => $animal->id . '-adopt-revert',
              'question' => 'Biztosan visszavonod a befogadási szándékodat?',
              'route' => 'revert.adoption.request',
              'method' => 'DELETE',
              'route_params' => [$animal->id],
              'action_button_text' => 'Visszavonom',
              'action_button_class' => 'btn btn-danger'
            ])   
          @else
            <button 
              type="submit" 
              class="mr-3 btn btn-success" 
              data-toggle="modal" 
              data-target="#{{ $animal->id . '-adopt' }}"
            >
              Befogadás
            </button>
            @include(
            'partials.modal_confirm', 
            [
              'id' => $animal->id . '-adopt',
              'question' => 'Kérünk erősítsd meg a befogadási szándékodat!',
              'route' => 'request.adoption',
              'method' => 'POST',
              'route_params' => [$animal->id],
              'action_button_text' => 'Megerősítem',
              'action_button_class' => 'btn btn-success'
            ])    
          @endif
        @endif
        <div class="flex-row d-flex">
          @if (Auth::user() && Auth::user()->role_id == 3)
            @if (!$animal->animal_of_the_week)
              <button 
                class="mr-3 btn btn-success" 
                data-toggle="modal" 
                data-target="#{{ $animal->id . '-animal-of-week' }}"
              >
                A hét állata
              </button>
              @include(
              'partials.modal_confirm', 
              [
                'id' => $animal->id . '-animal-of-week',
                'question' => 'Biztosan beallítod a hét állatának?',
                'route' => 'set.animal.of.week',
                'method' => 'PUT',
                'route_params' => [$animal->id],
                'action_button_text' => 'A hét állata',
                'action_button_class' => 'btn btn-success'
              ])
            @endif

          @endif
          @if (Auth::user() && ($animal->user_id == Auth::user()->id || Auth::user()->role_id == 3))
            <a href="{{ Request::url() }}/edit">
              <button class="mr-3 btn btn-warning" >
                Szerkesztés
              </button>
            </a>
            
            @if (!$animal->animal_of_the_week)
              <button 
                class="btn btn-danger" 
                data-toggle="modal" 
                data-target="#{{ $animal->id . '-delete' }}"
              >
                Törlés
              </button>
              @include(
                'partials.modal_confirm', 
                [
                  'id' => $animal->id . '-delete',
                  'question' => 'Biztosan törlöd ezt a hirdetést?',
                  'route' => 'delete.advertisement',
                  'method' => 'DELETE',
                  'route_params' => [$animal->id],
                  'action_button_text' => 'Törlés',
                  'action_button_class' => 'btn btn-danger'
                ])  
            @endif    
          @endif
      
      </div>
      </div>
    </div>
  </div>
@endsection