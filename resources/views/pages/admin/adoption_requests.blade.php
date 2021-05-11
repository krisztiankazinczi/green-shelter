@extends('layouts.admin')

@section('content')
<div class="mt-5 container-fluid">
    <h2>{{ $title }}</h2>

    @include('partials.admin.adoption_info_boxes', [
      'firstBoxText' => 'Utolsó 7 napban',
      'secondBoxText' => 'Utolsó 30 napban',
      'thirdBoxText' => 'Utolsó 365 napban',
      'fourthBoxText' => 'Összes',
      'last7DaysCount' => $last7DaysCount,
      'last30DaysCount' => $last30DaysCount,
      'last365DaysCount' => $last365DaysCount,
      'allCount' => $allCount,
      'firstBoxLink' => route('admin.adoption', ['type' => 'requested', 'days' => 7]),
      'secondBoxLink' => route('admin.adoption', ['type' => 'requested', 'days' => 30]),
      'thirdBoxLink' => route('admin.adoption', ['type' => 'requested', 'days' => 365]),
    ])

  <h3>{{ $title }} az elmúlt {{ $chartData['period'] == 'week' ? 'héten' : ($chartData['period'] == 'month' ? 'hónapban' : 'évben') }}</h3>
  <div style="height: 300px; width: 600px ">
      <canvas id="chart"></canvas>
  </div>

  <div class="table-responsive" style="margin-top: 30px;">
    <table class="table mt-3 table-striped">
        <thead>
            <tr>
              <th scope="col">Hirdetés címe</th>
              <th scope="col">Felhasználó név</th>
              <th scope="col">Email</th>
              <th scope="col">Befogadási kérelem időpontja</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
            <tr>
                <td>{{ $request->animal->title }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->user->email }}</td>
                <td>{{ $request->created_at }}</td>
                <td>
                  <button 
                    class="mr-3 btn btn-success" 
                    data-toggle="modal" 
                    data-target="#{{ $request->id . '-adoption-request' }}"
                  >
                    Jóváhagyás
                  </button>
                  @include(
                  'partials.modal_confirm', 
                  [
                    'id' => $request->id . '-adoption-request',
                    'question' => 'Erősítsd meg, hogy befogadták ay ebben a hirdetesben szereplő állatot: ' . $request->animal->title,
                    'route' => 'approve.adoption',
                    'method' => 'PUT',
                    'route_params' => [$request->id],
                    'action_button_text' => 'Jóváhagyom',
                    'action_button_class' => 'btn btn-success'
                  ])  

                  <button 
                    class="mr-3 btn btn-danger" 
                    data-toggle="modal" 
                    data-target="#{{ $request->id . '-reject-request' }}"
                  >
                    Elutasítás
                  </button>
                  @include(
                  'partials.modal_confirm', 
                  [
                    'id' => $request->id . '-reject-request',
                    'question' => 'Biztosan elutasítod a befogadási kérelmet? ' . $request->animal->title,
                    'route' => 'reject.adoption',
                    'method' => 'PUT',
                    'route_params' => [$request->id],
                    'action_button_text' => 'Elutasítom',
                    'action_button_class' => 'btn btn-danger'
                  ])      
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
          const titleFromServer = {!! json_encode($title) !!};
          generateChart(titleFromServer, chartData, requestsCanvas)
      };
  </script>
  @endsection