@extends('layouts.admin')

@section('content')
<div class="mt-5 container-fluid">
    <h2>Megkeresések az oldalról</h2>

    @include('partials.admin.adoption_info_boxes', [
      'firstBoxText' => 'Utolsó 7 napban',
      'secondBoxText' => 'Utolsó 30 napban',
      'thirdBoxText' => 'Utolsó 365 napban',
      'fourthBoxText' => 'Összes',
      'last7DaysCount' => $last7DaysCount,
      'last30DaysCount' => $last30DaysCount,
      'last365DaysCount' => $last365DaysCount,
      'allCount' => $allCount,
      'firstBoxLink' => route('contact.messages', ['days' => 7]),
      'secondBoxLink' => route('contact.messages', ['days' => 30]),
      'thirdBoxLink' => route('contact.messages', ['days' => 365]),
    ])

    <h3>Megkeresések az oldalról az elmúlt {{ $chartData['period'] == 'week' ? 'héten' : ($chartData['period'] == 'month' ? 'hónapban' : 'évben') }}</h3>
    <div style="height: 300px; width: 600px ">
        <canvas id="chart"></canvas>
    </div>


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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    window.onload = function() {
        const requestsCanvas = document.getElementById("chart");
        const chartData = {!! json_encode($chartData) !!}
        generateChart('Üzenetek', chartData, requestsCanvas, 'created_at')
    };
</script>
@endsection