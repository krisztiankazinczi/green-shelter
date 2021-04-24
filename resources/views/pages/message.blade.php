@extends('partials.messages')

@section('message_content')
  <div class="mt-5 w-100 d-flex justify-content-center">
    <div class="card" style="width: 600px;">
      <div class="mt-3 ml-3 d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-items-center">
          <img 
            src="{{$message->from->avatar_uri ? '/images/' . $message->from->avatar_uri : '/images/users/default-profile-image.jpg'}}"
            class="rounded-circle avatar" 
            width="50px"
            height="50px" 
          />
          <p class="mt-2 ml-3 h5 bold">{{ $message->from->name }}</p>
        </div>
          <p class="mt-2 ml-3 mr-3 h5 bold">{{ Date::parse($message->created_at)->format('F j') }}</p>
      </div>
      <div class="card-body">
        <h5 class="mb-3 card-title">{{ $message->subject }}</h5>
        <p class="card-text">{{$message->message}}</p>
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <a class="card-link">Válasz</a>
            @if (!$message->archived)
              <a 
                class="card-link" 
                style="cursor: pointer;"
                data-toggle="modal" 
                data-target="#{{ $message->id . '-archive' }}"
              >
                Archiválás
              </a>
              @include(
              'partials.modal_confirm', 
              [
                'id' => $message->id . '-archive',
                'question' => 'Biztosan archiválod ezt az üzenetet?',
                'route' => 'archive.message',
                'method' => 'PUT',
                'route_params' => [$message->id],
                'action_button_text' => 'Archiválom',
                'action_button_class' => 'btn btn-success'
              ])    
            @else 
              <a 
                class="card-link" 
                style="cursor: pointer;"
                data-toggle="modal" 
                data-target="#{{ $message->id . '-revert-archive' }}"
              >
                Archiválás visszavonása
              </a>
              @include(
              'partials.modal_confirm', 
              [
                'id' => $message->id . '-revert-archive',
                'question' => 'Biztosan visszavonod az archiválást erről az üzenetről?',
                'route' => 'revert.archive.message',
                'method' => 'PUT',
                'route_params' => [$message->id],
                'action_button_text' => 'Archiválást visszavonom',
                'action_button_class' => 'btn btn-success'
              ])   
            @endif
          </div>
          <div>
            <a 
              class="card-link text-danger" 
              style="cursor: pointer;"
              data-toggle="modal" 
              data-target="#{{ $message->id . '-delete' }}"
            >
              Törlés
            </a>
            @include(
            'partials.modal_confirm', 
            [
              'id' => $message->id . '-delete',
              'question' => 'Biztosan törlöd ezt az üzenetet?',
              'route' => 'trash.message',
              'method' => 'PUT',
              'route_params' => [$message->id],
              'action_button_text' => 'Törlöm',
              'action_button_class' => 'btn btn-danger'
            ])    
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection