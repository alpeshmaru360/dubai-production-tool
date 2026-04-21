@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/request_training.css') }}" rel="stylesheet" />

<!-- Page Content -->
<section class="p-4">
    <div class="heading">
        Request Training
    </div>

    <!-- Training Requests Table -->
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered text-center" id="request_training">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Training Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainingRequests as $request)
                <tr>
                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                    <td>{{ $request->username }}</td>
                    <td>{{ $request->phone }}</td>
                    <td>{{ $request->email }}</td>
                    <td>{{ $request->training_type }}</td>
                    <td>
                        {{ Str::limit($request->description, 20) }}
                        @if(strlen($request->description) > 20)
                            <a href="#" class="read-more" data-description="{{ $request->description }}">
                                Read more
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Modal for Full Description -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-custom text-white">
                <h5 class="modal-title" id="descriptionModalLabel">Full Description</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body" id="fullDescriptionContent">
                <!-- Full description will be injected here -->
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/Admin/request_training.js') }}"></script>
@endsection
