<!-- resources/views/admin/reports.blade.php -->

@extends('layouts.app')

@section('title', 'User Activity Reports')

@section('content')
<div class="container">
    <h1>User Activity Reports</h1>

    <h2>Charts</h2>
    <div style="max-width: 800px; margin: 0 auto;">
        <canvas id="activityChart" width="800" height="400"></canvas>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Passing data from PHP to JavaScript -->
    <script>
        const reportData = @json($reportData);

        const labels = Object.keys(reportData);

        const pageAData = labels.map(date => reportData[date]['page-a'] || 0);
        const pageBData = labels.map(date => reportData[date]['page-b'] || 0);
        const buyCowData = labels.map(date => reportData[date]['buy_cow'] || 0);
        const downloadData = labels.map(date => reportData[date]['download'] || 0);

        // Initializing Chart.js
        const ctx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Page A Views',
                        data: pageAData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false
                    },
                    {
                        label: 'Page B Views',
                        data: pageBData,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        fill: false
                    },
                    {
                        label: 'Buy a Cow Clicks',
                        data: buyCowData,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        fill: false
                    },
                    {
                        label: 'Downloads',
                        data: downloadData,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

    <h2>Reports Table</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Date</th>
                <th>Page A Views</th>
                <th>Page B Views</th>
                <th>Buy a Cow Clicks</th>
                <th>Downloads</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $date => $data)
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ $data['page-a'] }}</td>
                    <td>{{ $data['page-b'] }}</td>
                    <td>{{ $data['buy_cow'] }}</td>
                    <td>{{ $data['download'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
