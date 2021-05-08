@extends('layouts.index')

@section('title', $animal->title)

@section('content')
<div class="mt-5 mb-5 d-flex justify-content-center">
  <div class="mx-3 card animal-card">
    <div class="card-body">
      <div class="d-flex justify-content-center">
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
    <div class="mt-2 d-flex justify-content-end">
      <h5 class="font-italic">Hirdetés feladása: <span class="font-weight-bold">{{ Date::parse($animal->updated_at)->format('Y F j.') }}</span></h5>
    </div>
    <div class="d-flex justify-content-center animal-action-container">
      <div class="mt-4 d-flex justify-content-center align-items-center">
        @include('partials.like_icon_count', [
          'likesCount' => $animal->likesCount, 
          'animal_id' => $animal->id,
          'icon_classes' => 'mr-4 mb-0 h3',
        ])
        @auth
          <div>
            <i 
              class="mb-0 mr-4 far fa-envelope-open h3"
              style="cursor: pointer; color: #38C172"
              data-toggle="modal" 
              data-target="#send-message-{{ $animal->id }}"
            ></i>
            @include('partials.modal_send_message', [
              'modal_id' => "send-message-" . $animal->id,
              'from_id' => Auth::user()->id,
              'to_id' => $animal->user_id,
              'animal_id' => $animal->id,
              'subject' => '',
              'cbFunction' => 'closeModal("{{send-message-$animal->id}}")'
            ])
          </div>
        @endauth
        @include('partials.social_share', [
          'main_icon_classes' => 'mr-4 mb-0 h3',
          'collapse_id' => $animal->id . '-collapse',
          'url' => Request::url(),
        ])
        @if (!$animal->adopted && Auth::user())
          @if ($adoptionRequest)
            <button 
              type="submit" 
              class="mr-4 btn btn-danger" 
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
              class="mr-4 btn btn-success" 
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
      </div>
      <div class="mt-4 d-flex justify-content-center align-items-center">
        <div class="flex-row d-flex">
          @if (Auth::user() && Auth::user()->role_id == 3)
            @if (!$animal->animal_of_the_week)
              <button 
                class="mr-4 btn btn-success" 
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
              <button class="mr-4 btn btn-warning" >
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
    <div class="d-flex justify-content-center">
      <h4 class="mx-4 mt-5 text-justify" style="line-height: 30px;">{!! $animal->description !!}</h4>
    </div>
    <div class="mt-5 container-fluid">
      <div class="mt-4 mb-3 user-image animal-photos">
        @foreach ($animal->images as $image)
            <img 
              src="/images/{{$image->filename}}" 
              alt="{{ $animal->title }}" 
              style="{{ $image->main ? 'border: 10px solid;' : '' }} box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;" 
              class="{{ $image->main ? 'border-secondary' : '' }}"
            />
        @endforeach
      </div>
    </div>
    
    <div class="d-flex justify-content-between">
      <a href="{{ url()->previous() }}">
        <button class="btn btn-primary" >
          Vissza
        </button>
      </a>
      
    </div>
  </div>
</div>
@endsection