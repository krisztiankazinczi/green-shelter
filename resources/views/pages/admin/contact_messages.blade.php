@extends('layouts.admin')

@section('content')
<div class="mt-5 container-fluid">
    <h2>Megkeresések az oldalról</h2>
    <div class="table-responsive-sm">
        <table class="table mt-3 table-striped">
            <thead>
                <tr>
                <th scope="col">Név</th>
                <th scope="col">Email cím</th>
                <th scope="col">Tárgy</th>
                <th scope="col">Üzenet</th>
                <th scope="col">Időpont</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contact_messages as $message)
                
                    <tr>
                        <td>
                            <a style="text-decoration: none; cursor: pointer;" href="{{ route('contact.message', ['id' => $message->id]) }}">
                                {{ $message->name }}
                            </a>
                        </td>
                        <td>
                            <a style="text-decoration: none; cursor: pointer;" href="{{ route('contact.message', ['id' => $message->id]) }}">
                                {{ $message->email }} 
                            </a>
                        </td>
                        <td>
                            <a style="text-decoration: none; cursor: pointer;" href="{{ route('contact.message', ['id' => $message->id]) }}">
                                {{ $message->subject }}
                            </a>
                        </td>
                        <td>
                            <a style="text-decoration: none; cursor: pointer;" href="{{ route('contact.message', ['id' => $message->id]) }}">
                                {{ substr( $message->message, 0, 100) . '...' }}            
                            </a>
                        </td>
                        <td>
                            <a style="text-decoration: none; cursor: pointer;" href="{{ route('contact.message', ['id' => $message->id]) }}">
                                {{ Date::parse($message->created_at)->format('Y F j H:i') }}
                            </a>  
                        </td>
                        <td>
                            @if ($message->completed)
                                <button 
                                    class="btn btn-link" 
                                    data-toggle="modal" 
                                    data-target="#{{ $message->id . '-uncomplete' }}"
                                >
                                    Teljesítés visszavonása
                                </button>
                                @include(
                                'partials.modal_confirm', 
                                [
                                    'id' => $message->id . '-uncomplete',
                                    'question' => 'Biztosan visszavonod a teljesítést?',
                                    'route' => 'revert.complete.contact.message',
                                    'method' => 'PUT',
                                    'route_params' => [$message->id],
                                    'action_button_text' => 'Megerősítem',
                                    'action_button_class' => 'btn btn-success'
                                ])  
                            @else
                                <button 
                                    class="btn btn-link" 
                                    data-toggle="modal" 
                                    data-target="#{{ $message->id . '-complete' }}"
                                >
                                    Teljesítés
                                </button>
                                @include(
                                'partials.modal_confirm', 
                                [
                                    'id' => $message->id . '-complete',
                                    'question' => 'Biztosan elvégeztél mindent a megkereséssel kapcsolatban?',
                                    'route' => 'complete.contact.message',
                                    'method' => 'PUT',
                                    'route_params' => [$message->id],
                                    'action_button_text' => 'Megerősítem',
                                    'action_button_class' => 'btn btn-success'
                                ])  
                            @endif
                        </td>
                    </tr>
                @endforeach            
            </tbody>
        </table>
    </div>
  </div>

  <script>
    var messages = {!! json_encode($contact_messages) !!}
    console.log(messages);
  </script>
@endsection