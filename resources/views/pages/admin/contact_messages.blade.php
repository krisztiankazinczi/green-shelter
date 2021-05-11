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
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ Date::parse($message->created_at)->format('Y F j H:i') }}</td>
                </tr>
                @endforeach            
            </tbody>
        </table>
    </div>
  </div>

  {{-- <h3>Chart with Chart.js</h3>
    <div style="height: 300px; width: 600px ">
        <canvas id="chart"></canvas>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        window.onload = function() {
            var densityCanvas = document.getElementById("chart");
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            var densityData = {
            label: 'Density of Planet (kg/m3)',
            data: [5427, 5243, 5514, 3933, 1326, 687, 1271, 1638],
            backgroundColor: 'rgba(0, 99, 132, 0.6)',
            borderWidth: 0,
            yAxisID: "y-axis-density"
            };

            var gravityData = {
            label: 'Gravity of Planet (m/s2)',
            data: [3.7, 8.9, 9.8, 3.7, 23.1, 9.0, 8.7, 11.0],
            backgroundColor: 'rgba(99, 132, 0, 0.6)',
            borderWidth: 0,
            yAxisID: "y-axis-gravity"
            };

            var planetData = {
            labels: ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune"],
            datasets: [densityData, gravityData]
            };

            var chartOptions = {
                responsive: true,

            scales: {
                xAxes: [{
                barPercentage: 1,
                categoryPercentage: 0.6
                }],
                yAxes: [{
                id: "y-axis-density"
                }, {
                id: "y-axis-gravity"
                }]
            }
            };

            var barChart = new Chart(densityCanvas, {
            type: 'bar',
            data: planetData,
            options: chartOptions
            });

        };
    </script> --}}
@endsection