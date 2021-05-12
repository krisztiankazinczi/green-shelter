@extends('layouts.admin')

@section('content')


  <div class="panel panel-default" style="width: 50%; max-width: 600px; margin-top: 40px; margin-left: auto; margin-right: auto;">
    <div class="panel-heading">
      <h5>Név: {{ $contact_message->name }}</h5>
      <h5>Email: {{ $contact_message->email }}</h5>
    </div>
    <div class="panel-body">
      <h6>Tárgy: {{ $contact_message->subject }}</h6>
      <p>
        {{ $contact_message->message }}
      </p>
    </div>
    {{-- <input type="hidden" id="message-id" value="{{ $contact_message->id }}" /> --}}
    <input type="hidden" id="message-read" value="{{ $contact_message->read }}" />
    <form action="{{ route( 'read.contact.message', ['id' => $contact_message->id]) }}" method="POST" id="read-message">
      @csrf
      @method('PUT')
      <button style="display: none;" type="submit"></button>
    </form>
  </div>
      
      <script>
         window.onload = () => {
          const isRead = document.getElementById('message-read').value;
          if (!isRead || isRead === "0") {
              document.getElementById('read-message').submit();
            }
          }
      </script>
@endsection