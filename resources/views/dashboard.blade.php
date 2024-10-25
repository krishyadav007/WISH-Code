@extends('layouts.app')
@section('heady')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script differ src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
@endsection('heady')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $msg_count }}</h5>
                        <p class="card-text">Messages</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $aptitude_count }}</h5>
                        <p class="card-text">Aptitude tests</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $likert_count }}</h5>
                        <p class="card-text">Likert tests</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $teacher_count }}</h5>
                        <p class="card-text">Teacher feedbacks</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">Sentiments (24 hours)</p>
                        <canvas id="sentiment_24" style="width:100%;max-width:700px"></canvas>
                        <script>
                            var xValues = ["Positive", "Negative", "Neutral"];
                            var yValues = [15, 9, 23];
                            var barColors = [
                                "#007C00",
                                "#FF746D",
                                "#BBBBBB"
                            ];

                            new Chart("sentiment_24", {
                                type: "doughnut",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: barColors,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Sentiments during past 24 hours"
                                    }
                                }
                            });

                        </script>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">Sentiments (All)</p>
                        <canvas id="sentiment_all" style="width:100%;max-width:700px"></canvas>
                        <script>
                            var xValues = ["Positive", "Negative", "Neutral"];
                            var yValues = [15, 9, 23];
                            var barColors = [
                                "#007C00",
                                "#FF746D",
                                "#BBBBBB"
                            ];

                            new Chart("sentiment_all", {
                                type: "doughnut",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: barColors,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Sentiments since start"
                                    }
                                }
                            });

                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">Interest level in STEM</p>
                        <canvas id="liker_dayz" style="width:100%;"></canvas>

                        <script>
                            const xValues_likert = [0, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
                            const yValues_likert = [1, 2, 2, 1, 5, 1, 3, 3, 5, 4, 0];

                            new Chart("liker_dayz", {
                                type: "line",
                                data: {
                                    labels: xValues_likert,
                                    datasets: [{
                                        fill: false,
                                        lineTension: 0,
                                        backgroundColor: "rgba(0,0,255,1.0)",
                                        borderColor: "rgba(0,0,255,0.1)",
                                        data: yValues_likert
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                min: 0,
                                                max: 5
                                            }
                                        }],
                                    }
                                }
                            });

                        </script>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">Aptitude marks</p>
                        <canvas id="aptitude_dayz" style="width:100%;"></canvas>

                        <script>
                            const xValues_aptitude = [0, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
                            const yValues_aptitude = [1, 2, 2, 1, 5, 1, 3, 3, 5, 4, 0];

                            new Chart("aptitude_dayz", {
                                type: "line",
                                data: {
                                    labels: xValues_aptitude,
                                    datasets: [{
                                        fill: false,
                                        lineTension: 0,
                                        backgroundColor: "#FFDE21",
                                        borderColor: "#FFDE21",
                                        data: yValues_aptitude
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                min: 0,
                                                max: 10
                                            }
                                        }],
                                    }
                                }
                            });

                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- </body> -->
<!-- </html> -->
