@extends('partials.messages')

@section('message_content')
  <div class="mt-5 w-100 d-flex justify-content-center">
    <div class="card" style="width: 600px;">
      @if(!empty(Session::get('success')))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
      @endif
      @if(!empty(Session::get('error')))
        <div class="alert alert-danger"> {{ Session::get('error') }}</div>
      @endif
      <div class="mt-3 ml-3 d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-items-center">
          <img 
            @if (request()->segments()[1] == 'sent')
              src="{{$message->to->avatar_uri ? '/images/' . $message->to->avatar_uri : '/images/users/default-profile-image.jpg'}}"
            @else
              src="{{$message->from->avatar_uri ? '/images/' . $message->from->avatar_uri : '/images/users/default-profile-image.jpg'}}"
            @endif
            class="rounded-circle avatar" 
            width="50px"
            height="50px" 
          />
          <p class="mt-2 ml-3 h5 bold">{{request()->segments()[1] != 'sent' ? $message->from->name : $message->to->name }}</p>
        </div>
          <p class="mt-2 ml-3 mr-3 h5 bold">{{ Date::parse($message->created_at)->format('Y F j @ H:i') }}</p>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-end">
          <a 
            class="mb-3 card-link" 
            style="cursor: pointer;"
            target="_blank" 
            rel="noopener noreferrer"
            href="{{ 
              !$message->animal->adopted ? 
              route('show.advertisement', ['page' => $message->animal->menu->route, 'id' => $message->animal->id]) :
              route('success.story', ['id' => $message->animal->id])
              }}"
            >
            Hirdetés megtekintése
          </a>
        </div>
        <h5 class="mb-3 card-title">{{ $message->subject }}</h5>
        <p class="card-text">{!! $message->message !!}</p>
        <input type="hidden" id="message-id" value="{{ $message->id }}" />
        <input type="hidden" id="message-read" value="{{ $message->read }}" />
        <form action="{{ route( 'read.message', ['id' => $message->id]) }}" method="POST" id="read-message">
          @csrf
          @method('PUT')
          <button style="display: none;" type="submit"></button>
        </form>
        <div class="d-flex justify-content-between align-items-center" id="action-buttons" style="visibility: @if ($errors->any()) hidden @else visible; @endif">
          <div>
            @if (!$message->inTrash)
              <a class="card-link" style="cursor: pointer;" onclick="showMessageBox()">Válasz</a>
              @if (request()->segments()[1] != 'sent')
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
              @endif
            @endif
          </div>
          <div>
            @if (request()->segments()[1] != 'sent')
              @if (!$message->inTrash)
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
              @else 
                <a 
                  class="card-link" 
                  style="cursor: pointer;"
                  data-toggle="modal" 
                  data-target="#{{ $message->id . '-revert-delete' }}"
                >
                  Áthelyezem a bejövő üzenetekhez
                </a>
                @include(
                'partials.modal_confirm', 
                [
                  'id' => $message->id . '-revert-delete',
                  'question' => 'Biztosan visszahelyezed az inboxba az üzenetet?',
                  'route' => 'revert.trash.message',
                  'method' => 'PUT',
                  'route_params' => [$message->id],
                  'action_button_text' => 'Áthelyezem',
                  'action_button_class' => 'btn btn-success'
                ])  
              @endif
            @endif
          </div>
        </div>
        <div id="response-container" style="display: @if ($errors->any()) block @else none; @endif">
          @include('partials.send_message', [
            'from_id' => request()->segments()[1] != 'sent' ? $message->to_id : $message->from_id,
            'to_id' => request()->segments()[1] != 'sent' ? $message->from_id : $message->to_id,
            'animal_id' => $message->animal_id,
            'subject' => $message->subject,
            'cbFunction' => 'deleteMessageBox()'
          ])
        </div>
      </div>
    </div>
  </div>

  <script>
    window.onload = () => {
      const isRead = document.getElementById('message-read').value;
      var url_segments = {!! json_encode(request()->segments()) !!}
      // var APP_URL = {!! json_encode(url('/')) !!} - kesobb kelleni fog
      // ez egy tomb es a masodik eleme mondja meg hogy ez elkuldott uzenet e vagy sem
     if (!isRead && url_segments[1] !== 'sent') {
        document.getElementById('read-message').submit();
      }
    }

    const showMessageBox = () => {
      document.getElementById('response-container').style.display = 'block';
      document.getElementById('action-buttons').style.visibility = 'hidden';
    }
    const deleteMessageBox = () => {
      document.getElementById('response-container').style.display = 'none';
      document.getElementById('action-buttons').style.visibility = 'visible';
    }
  </script>
  {{-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> --}}
  {{-- <script>
  
   window.onload = () => {
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    const id = document.getElementById('message-id').value;
    fetch(`/api/read-message/${id}`, {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token": CSRF_TOKEN,
        },
        method: "GET",
        credentials: "same-origin",
        //body: JSON.stringify({ id })
      })
      .then(response => console.log(response))
      //.then(res => console.log(res));
    }

</script> --}}
@endsection