@extends('layouts.admin')

@section('content')
<div class="mt-5 container-fluid">
    <h2>Üzenetek az oldalról</h2>

    @include('partials.admin.adoption_info_boxes', [
      'firstBoxText' => 'Utolsó 7 napban',
      'secondBoxText' => 'Utolsó 30 napban',
      'thirdBoxText' => 'Utolsó 365 napban',
      'fourthBoxText' => 'Összes',
      'last7DaysCount' => $last7DaysCount,
      'last30DaysCount' => $last30DaysCount,
      'last365DaysCount' => $last365DaysCount,
      'allCount' => $allCount,
      'firstBoxLink' => route('contact.messages', ['type' => 'all', 'days' => 7]),
      'secondBoxLink' => route('contact.messages', ['type' => 'all', 'days' => 30]),
      'thirdBoxLink' => route('contact.messages', ['type' => 'all', 'days' => 365]),
    ])

    <div class="row" style="margin-top: 20px;">
        <a href="{{ route('contact.messages', ['type' => 'unread', 'days' => 365]) }}">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-maroon"><i class="fa fa-envelope"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Olvasatlan üzenetek</span>
                <span class="info-box-number" style="font-size: 30px;">{{ $unread_messages }}</span>
                </div> 
            </div> 
            </div> 
        </a>

        <a href="{{ route('contact.messages', ['type' => 'uncomplete', 'days' => 365]) }}">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-orange"><i class="fa fa-times-circle"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Megválaszolatlan üzenetek</span>
                <span class="info-box-number" style="font-size: 30px;">{{ $uncompleted_messages }}</span>
                </div> 
            </div> 
            </div> 
        </a>
        <div class="clearfix visible-sm-block"></div>
        <a href="{{ route('contact.messages', ['type' => 'completed', 'days' => 365]) }}">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-check-circle"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Megválaszolt üzenetek</span>
                <span class="info-box-number" style="font-size: 30px;">{{ $completed_messages }}</span>
                </div> 
            </div> 
            </div> 
        </a>
    </div>

    <h3>{{ Request::segment(3) == 'unread' ? 'Olvasatlan' : (Request::segment(3) == 'completed' ? 'Megválaszolt' : (Request::segment(3) == 'uncomplete' ? 'Megválaszolatlan' : '')) }}  Üzenetek az oldalról az elmúlt {{ $chartData['period'] == 'week' ? 'héten' : ($chartData['period'] == 'month' ? 'hónapban' : 'évben') }}</h3>
    <div style="display: flex;" id="charts">
        <div style="height: 300px; width: 600px ">
            <canvas id="chart"></canvas>
        </div>
        <div style="height: 300px; width: 500px ">
            <canvas id="pie-chart"></canvas>
        </div>
    </div>

    <h2 style="margin-top: 40px;">Üzenetek</h2>

    <div class="table-responsive-sm" style="margin-top: 20px;">
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

  <style>
   /* charts */
 @media (max-width: 1280px) {
  #charts {
    flex-direction: column;
  }
}
  </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    window.onload = function() {
        const requestsCanvas = document.getElementById("chart");
        const chartData = {!! json_encode($chartData) !!}
        generateChart('Üzenetek', chartData, requestsCanvas, 'created_at');

        const uncompletedMessages = {!! json_encode($uncompleted_messages) !!};
        const completedMessages = {!! json_encode($completed_messages) !!};
        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
            labels: ['Megválaszolt', 'Megválaszolatlan'],
            datasets: [{
                label: "Üzenetek (db)",
                backgroundColor: ["#3e95cd", "#8e5ea2"],
                data: [completedMessages,uncompletedMessages]
            }]
            },
            options: {
            title: {
                display: true,
                text: 'Üzenetek kezelése'
            }
            }
        });
    };
</script>
@endsection