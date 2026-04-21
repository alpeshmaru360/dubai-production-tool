@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/feedback.css') }}" rel="stylesheet" />

<!-- Add Your Page Content Here -->
<section class="p-4">
    <div class="heading">
        Feedback
    </div>

    <!-- Feedback Table -->
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered text-center" id="feedback_form">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Suggestions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $request)
                <tr>
                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                    <td>{{ $request->username }}</td>
                    <td>{{ $request->phone }}</td>
                    <td>{{ $request->email }}</td>
                    <td>
                        {{ Str::limit($request->suggestions, 20) }}
                        @if(strlen($request->suggestions) > 20)
                        <a href="#" class="read-more" data-suggestion="{{ $request->suggestions }}">
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

<!-- Modal for Full Suggestion -->
<div class="modal fade" id="suggestionModal" tabindex="-1" aria-labelledby="suggestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-custom text-white">
                <h5 class="modal-title" id="suggestionModalLabel">Full Suggestion</h5>
                <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body" id="fullSuggestionContent">
                <!-- Full suggestion will be injected here -->
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/Admin/feedback.js') }}"></script>
@endsection