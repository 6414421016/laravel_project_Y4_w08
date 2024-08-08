@extends('layout')
@section('title')
@endsection
@section('content')
    <div>
        <h2>Vaccine Record Year 2023</h2>
        <canvas height="100px" id="vaccineChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // ข้อมูล labels และ data ที่ได้รับจาก PHP
        var labels = @json($labels);
        var data = @json($data);

        // กำหนดค่าข้อมูลและการตั้งค่าสำหรับ Chart.js
        var ctx = document.getElementById('vaccineChart').getContext('2d');
        var vaccineChart = new Chart(ctx, {
            type: 'bar', // กำหนดประเภทกราฟ เช่น 'line', 'bar', 'pie', ฯลฯ
            data: {
                labels: labels, // ข้อมูล labels ที่ได้รับ
                datasets: [{
                    label: 'จำนวนวัคซีนที่ได้รับในแต่ละเดือน',
                    data: data, // ข้อมูล data ที่ได้รับ
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // เริ่มต้นแกน y ที่ค่า 0
                    }
                }
            }
        });
    </script>
@endsection
