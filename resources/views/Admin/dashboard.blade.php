@extends('layouts.main')
@section('content')
    <link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />

    <section class="p-4">
        <div class="heading">
            Dashboard
        </div>
        <div class="dashboard-container mt-4">
            <div class="stats-boxes">
                <a href="{{route('AdminRequestTraining')}}">
                    <div class="stat-box">
                        <h3>Total Request Training</h3>
                        <p id="totalRequestTraining" class="hidden"></p>
                        <p class="count">{{$totalRequestTraining}}</p>
                    </div>
                </a>
                <a href="{{route('AdminWitnessTest')}}">
                    <div class="stat-box">
                        <h3>Total Witness Test</h3>
                        <p id="totalWitnessTest" class="hidden"></p>
                        <p class="count">{{$totalWitnessTest}}</p>
                    </div>
                </a>
                <a href="{{route('AdminFeedback')}}">
                    <div class="stat-box">
                        <h3>Total Feedback</h3>
                        <p id="totalFeedback" class="hidden"></p>
                        <p class="count">{{$totalFeedback}}</p>
                    </div>
                </a>
            </div>

            <div class="chart-container">
                <canvas 
                    id="compactChart" 
                    data-request-training="{{ json_encode($requestTrainingCounts) }}" 
                    data-witness-test="{{ json_encode($witnessTestCounts) }}" 
                    data-feedback="{{ json_encode($feedbackCounts) }}"
                ></canvas>
            </div>
        </div>

        <style>
            .stat-box {
                transition: transform 0.3s ease-in-out;
            }
            .stat-box:hover {
                transform: scale(1.05);
            }
            .count {
                color: #007bff;
            }
        </style>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/Admin/dashboard.js') }}"></script>
@endsection
