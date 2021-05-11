@extends('layouts.admin')

@section('content')
<div class="container-fluid">
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
  ])

<div class="table-responsive" style="margin-top: 30px;">
    <table class="table mt-3 table-striped">
        <thead>
            <tr>
              <th scope="col">Hirdetés címe</th>
              <th scope="col">Felhasználó név</th>
              <th scope="col">Email</th>
              <th scope="col">Befogadás időpontja</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
            <tr>
                <td>{{ $request->animal->title }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->user->email }}</td>
                <td>{{ $request->updated_at }}</td>
                <td>
                  <p 
                    class="mr-3 btn btn-link" 
                    data-toggle="modal" 
                    data-target="#{{ $request->id . '-adoption-revert' }}"
                  >
                    Befogadás visszavonása
                  </p>
                  @include(
                  'partials.modal_confirm', 
                  [
                    'id' => $request->id . '-adoption-revert',
                    'question' => 'Biztosan visszavonod a következő állat befogadását? - ' . $request->animal->title,
                    'route' => 'revert.adoption',
                    'method' => 'PUT',
                    'route_params' => [$request->id],
                    'action_button_text' => 'Befogadás visszavonása',
                    'action_button_class' => 'btn btn-danger'
                  ])    
                </td>
            </tr>
            @endforeach            
        </tbody>
    </table>
  </div>
</div>

<h3>Chart with Chart.js</h3>
    <div style="height: 300px; width: 600px ">
        <canvas id="chart"></canvas>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        window.onload = function() {
            var densityCanvas = document.getElementById("chart");
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            const chartData = {!! json_encode($chartData) !!}
            let xAxisLabels;
            let numberOfRequests;
            if (chartData.period === 'week') {
              const result = createWeeklyData(chartData.data);
              xAxisLabels = result.xLabels;
              numberOfRequests = result.numberOfRequests;
            }


            var requestData = {
            label: {!! json_encode($title) !!} + ' száma (db)',
            data: numberOfRequests,
            backgroundColor: 'rgba(0, 99, 132, 0.6)',
            borderWidth: 0,
            yAxisID: "number-of-requests"
            };

            var adoptionData = {
            labels: xAxisLabels,
            datasets: [requestData]
            };

            var chartOptions = {
                responsive: true,

            scales: {
                xAxes: [{
                barPercentage: 1,
                categoryPercentage: 0.6
                }],
                yAxes: [{
                id: "number-of-requests"
                }]
            }
            };

            var barChart = new Chart(densityCanvas, {
            type: 'bar',
            data: adoptionData,
            options: chartOptions
            });

        };
    </script>

@endsection