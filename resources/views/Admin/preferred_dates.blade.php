@extends('layouts.admin')

@section('content')
    <h1>Select Preferred Dates</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="preferredDatesForm" action="{{ route('AdminPrefferdDates') }}" method="POST">
        @csrf
        <div>
            <label for="dates">Select Dates</label>
            <input type="date" name="dates[]" multiple required>
            <span class="text-danger" id="dateError"></span> <!-- Error message -->
        </div>

        <button type="submit">Save Preferred Dates</button>
    </form>

    <script>
        document.getElementById('preferredDatesForm').onsubmit = function() {
            const dates = document.querySelectorAll('input[name="dates[]"]');
            const selectedDates = [...dates].filter(date => date.value).map(date => date.value);

            if (selectedDates.length === 0) {
                document.getElementById('dateError').textContent = 'Please select at least one date.';
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        };
    </script>
@endsection
