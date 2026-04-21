@extends('layouts.main')
@section('content')
    <link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/Admin/witness_test.css') }}" rel="stylesheet" />

    <!-- Add Your Page Content Here -->
    <section class="p-4">
        <div class="heading">Witness Test</div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mt-4" id="witnessTestTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data"
                    aria-selected="true">
                    Data
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="waiting-list-tab" data-toggle="tab" href="#waiting-list" role="tab"
                    aria-controls="waiting-list" aria-selected="false">
                    Waiting List
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="schedules-tab" data-toggle="tab" href="#schedules" role="tab"
                    aria-controls="schedules" aria-selected="false">
                    Selected Meeting Schedules
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings"
                    aria-selected="false">
                    Settings
                </a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="witnessTestTabsContent">
            <!-- Data Tab -->
            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                <!-- Training Requests Table -->
                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered text-center" id="witness_test">
                        <thead>
                            <tr>
                                <th>Preferred Date</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Product Type</th>
                                <th>Additional Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($witnessTests as $request)
                                <tr>
                                    <td>{{ $request->preferred_date }}</td>
                                    <td>{{ $request->username }}</td>
                                    <td>{{ $request->phone }}</td>
                                    <td>{{ $request->email }}</td>
                                    <td>{{ $request->product_type }}</td>
                                    <td>
                                        {{ Str::limit($request->additional_notes, 20) }}
                                        @if (strlen($request->additional_notes) > 20)
                                            <a href="#" class="read-more" data-description="{{ $request->additional_notes }}">
                                                Read more
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Waiting List Tab -->
            <div class="tab-pane fade" id="waiting-list" role="tabpanel" aria-labelledby="waiting-list-tab">
                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered text-center" id="waiting_list_table">
                        <thead>
                            <tr>
                                <th>Preferred Date</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Product Type</th>
                                <th>Additional Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($waitingList as $item)
                                <tr>
                                    <td>{{ $item->preferred_date }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->product_type }}</td>
                                    <td>
                                        {{ Str::limit($item->additional_notes, 20) }}
                                        @if (strlen($item->additional_notes) > 20)
                                            <a href="#" class="read-more" data-description="{{ $item->additional_notes }}">
                                                Read more
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                       {{-- Approve and Reject buttons --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No waiting list entries found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Schedules Tab -->
            <div class="tab-pane fade" id="schedules" role="tabpanel" aria-labelledby="schedules-tab">
                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered text-center" id="scheduled_meetings">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Product Type</th>
                                <th>Capacity</th>
                                <th>Meeting Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($scheduledMeetings as $meeting)
                                <tr>
                                    <td>{{ $meeting->display_date }}</td>
                                    <td>{{ $meeting->product_type }}</td>
                                    <td>{{ $meeting->capacity ?? 'N/A' }}</td>
                                    <td>
                                        <div class="meeting-link-container">
                                            <a href="{{ $meeting->meeting_link }}" target="_blank" class="meeting-link-text"
                                                title="{{ $meeting->meeting_link }}">
                                                {{ Str::limit($meeting->meeting_link, 40, '...') }}
                                            </a>
                                            <button class="copy-link-btn" data-link="{{ $meeting->meeting_link }}"
                                                title="Copy link">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                    <path
                                                        d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No scheduled meetings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="mt-4 p-4">
                    <div class="row">
                        <!-- Left Div: Product Type and Meeting Link Inputs -->
                        <div class="col-md-6">
                            <h5>Select Product Type and Meeting Link</h5>
                            <form id="dateSettingsForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="product_type" class="form-label">Product Type</label>
                                    <select class="form-control" id="product_type" name="product_type" required>
                                        <option value="">Select Product Type</option>
                                        @foreach ($productTypes as $type)
                                            <option value="{{ $type['id'] }}">{{ $type['product_type_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Hidden initially, shown after date selection -->
                                <div id="meeting-link-section" style="display: none;">
                                    <div class="mb-3">
                                        <label for="meeting_link" class="form-label">Meeting Link</label>
                                        <input type="url" class="form-control" id="meeting_link" name="meeting_link"
                                            placeholder="https://example.com/meeting">
                                    </div>
                                    <div class="mb-3">
                                        <label for="capacity" class="form-label">Capacity</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity"
                                            placeholder="Enter meeting capacity" min="1">
                                    </div>
                                    <div class="mb-3" id="scheduled-date-display" style="display: none;">
                                        <label class="form-label">Scheduled Date</label>
                                        <div class="scheduled-date-info">
                                            <strong>Scheduled on - <span id="formatted-date"></span></strong>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" id="save-date-btn" class="btn btn-success">Save</button>
                                        <button type="button" id="delete-date-btn" class="btn btn-danger"
                                            style="display: none;">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Right Div: Calendar -->
                        <div class="col-md-6">
                            <h5 class="calendar-heading">Select Preferred Dates</h5>
                            <div id="calendar-container">
                                <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                                    <button id="prev-month" class="btn btn-outline-primary btn-sm">&lt; Prev</button>
                                    <h6 id="calendar-title" class="mb-0">Month Year</h6>
                                    <button id="next-month" class="btn btn-outline-primary btn-sm">Next &gt;</button>
                                </div>
                                <table class="table table-bordered text-center calendar-table">
                                    <thead>
                                        <tr>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                        </tr>
                                    </thead>
                                    <tbody id="calendar-body">
                                        <!-- Calendar days will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">

                    <h5>Witness Test Email Settings</h5>

                    <form method="POST" action="{{ route('admin.saveWitnessEmails') }}" class="mt-3">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <div class="mb-3 primary-mail">
                                <label class="form-label">
                                    Primary Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="primary_email" class="form-control" required
                                    value="{{ $witnessEmails['primary'] }}" placeholder="example@domain.com">
                            </div>

                            <div class="mb-3 secodnory-mail">
                                <label class="form-label">Secondary Email (Optional)</label>
                                <input type="email" name="secondary_email" class="form-control"
                                    value="{{ $witnessEmails['secondary'] }}" placeholder="example2@domain.com">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save Emails
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </section>


    <!-- The same modal as in the Training Requests view -->
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
            </div>
        </div>
    </div>
    <div class="modal fade" id="dateActionModal" tabindex="-1" aria-labelledby="dateActionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-custom text-white">
                    <h5 class="modal-title" id="dateActionModalLabel">Manage Date</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="date-info">Selected Date: <span id="selected-date"></span></p>
                    <p id="existing-info" style="display: none;">Existing: <span id="existing-details"></span></p>
                    <div class="d-flex justify-content-between">
                        <button id="save-date-btn" class="btn btn-success">Save</button>
                        <button id="delete-date-btn" class="btn btn-danger" style="display: none;">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @section('scripts')
        <script>
            (function ($) {
                'use strict';

                $(document).ready(function () {
                    // Check if DataTables is loaded
                    if (typeof $.fn.DataTable === 'undefined') {
                        console.error('DataTables is not loaded');
                        return;
                    }

                    // Initialize DataTable for witness test data
                    try {
                        if ($.fn.DataTable.isDataTable('#witness_test')) {
                            $('#witness_test').DataTable().destroy();
                        }
                        $('#witness_test').DataTable({
                            paging: true,
                            pageLength: 10,
                            lengthMenu: [2, 5, 10, 25, 50, 100],
                            ordering: false,
                            destroy: true
                        });
                    } catch (e) {
                        console.error('Error initializing witness_test DataTable:', e);
                    }

                    // NEW: Initialize DataTable for waiting list
                    try {
                        if ($.fn.DataTable.isDataTable('#waiting_list_table')) {
                            $('#waiting_list_table').DataTable().destroy();
                        }
                        $('#waiting_list_table').DataTable({
                            paging: true,
                            pageLength: 10,
                            lengthMenu: [2, 5, 10, 25, 50, 100],
                            ordering: true,
                            order: [[0, 'asc']], // Order by preferred_date column (first column)
                            destroy: true
                        });
                    } catch (e) {
                        console.error('Error initializing waiting_list_table DataTable:', e);
                    }

                    // Initialize DataTable for scheduled meetings
                    try {
                        if ($.fn.DataTable.isDataTable('#scheduled_meetings')) {
                            $('#scheduled_meetings').DataTable().destroy();
                        }
                        $('#scheduled_meetings').DataTable({
                            paging: true,
                            pageLength: 10,
                            lengthMenu: [2, 5, 10, 25, 50, 100],
                            ordering: true,
                            order: [[0, 'asc']],
                            destroy: true
                        });
                    } catch (e) {
                        console.error('Error initializing scheduled_meetings DataTable:', e);
                    }

                    // Handle "Read more" click to show full description in modal
                    $(document).on('click', '.read-more', function (event) {
                        event.preventDefault();
                        const additionalNotes = $(this).data('description');
                        $('#fullDescriptionContent').text(additionalNotes);

                        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                            const descriptionModal = new bootstrap.Modal(document.getElementById('descriptionModal'));
                            descriptionModal.show();
                        } else {
                            $('#descriptionModal').modal('show');
                        }
                    });

                    // Calendar and date management variables
                    let currentDate = new Date();
                    let selectedProductTypeId = null;
                    let savedDates = [];
                    let selectedDate = null;

                    // Helper function to format and display scheduled date
                    function displayScheduledDate(dateString) {
                        try {
                            const date = new Date(dateString);
                            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                            const dayName = days[date.getDay()];
                            const day = date.getDate();
                            const month = months[date.getMonth()];

                            // Add ordinal suffix (st, nd, rd, th)
                            const ordinal = (day) => {
                                if (day > 3 && day < 21) return 'th';
                                switch (day % 10) {
                                    case 1: return 'st';
                                    case 2: return 'nd';
                                    case 3: return 'rd';
                                    default: return 'th';
                                }
                            };

                            const formattedDate = `${day}${ordinal(day)} ${month}, ${dayName}`;
                            $('#formatted-date').text(formattedDate);
                        } catch (e) {
                            console.error('Error formatting date:', e);
                        }
                    }

                    // Helper function to show feedback messages with auto-hide
                    function showMessage(message, type = 'success') {
                        const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
                        const alertId = 'alert-' + Date.now();
                        const alertHtml = `<div id="${alertId}" class="alert ${alertClass} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 300px;">${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
                        $('body').prepend(alertHtml);
                        setTimeout(() => {
                            $('#' + alertId).fadeOut(500, function () {
                                $(this).remove();
                            });
                        }, 5000);
                    }

                    // Function to render calendar
                    function renderCalendar(date) {
                        try {
                            const year = date.getFullYear();
                            const month = date.getMonth();
                            const firstDay = new Date(year, month, 1).getDay();
                            const lastDate = new Date(year, month + 1, 0).getDate();
                            const today = new Date();
                            today.setHours(0, 0, 0, 0);

                            let calendarBody = '';
                            let dayCount = 1;

                            $('#calendar-title').text(date.toLocaleString('default', {
                                month: 'long',
                                year: 'numeric'
                            }));

                            for (let i = 0; i < 6; i++) {
                                calendarBody += '<tr>';
                                for (let j = 0; j < 7; j++) {
                                    if (i === 0 && j < firstDay) {
                                        calendarBody += '<td class="empty-cell"></td>';
                                    } else if (dayCount > lastDate) {
                                        calendarBody += '<td class="empty-cell"></td>';
                                    } else {
                                        const fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(dayCount).padStart(2, '0')}`;
                                        const cellDate = new Date(fullDate);
                                        const isPast = cellDate < today;
                                        const isSaved = savedDates.includes(fullDate) && !isPast;
                                        const classes = `calendar-day ${isSaved ? 'saved-date' : ''} ${isPast ? 'past-date' : ''}`;
                                        calendarBody += `<td class="${classes}" data-date="${fullDate}">${dayCount}</td>`;
                                        dayCount++;
                                    }
                                }
                                calendarBody += '</tr>';
                                if (dayCount > lastDate) break;
                            }
                            $('#calendar-body').html(calendarBody);
                        } catch (e) {
                            console.error('Error rendering calendar:', e);
                        }
                    }

                    // Initial render of calendar
                    renderCalendar(currentDate);

                    // Product type change event handler
                    $('#product_type').on('change', function () {
                        selectedProductTypeId = $(this).val();

                        if (!selectedProductTypeId) {
                            savedDates = [];
                            renderCalendar(currentDate);
                            $('#meeting-link-section').hide();
                            $('#scheduled-date-display').hide();
                            return;
                        }

                        // Fetch saved dates for the selected product type
                        $.ajax({
                            url: "{{ route('getDatesByProductType') }}",
                            method: 'GET',
                            data: {
                                product_type_id: selectedProductTypeId
                            },
                            success: function (response) {
                                if (response.success) {
                                    savedDates = response.savedDates || [];
                                    renderCalendar(currentDate);

                                    // If a date is saved, show the form and prevent new selections
                                    if (savedDates.length > 0) {
                                        selectedDate = savedDates[0];
                                        $('#meeting-link-section').show();

                                        // Fetch details of the saved date
                                        $.ajax({
                                            url: "{{ route('getPreferredDateDetails') }}",
                                            method: 'GET',
                                            data: {
                                                date: selectedDate,
                                                product_type_id: selectedProductTypeId
                                            },
                                            success: function (resp) {
                                                if (resp.success) {
                                                    $('#meeting_link').val(resp.data.meeting_link);
                                                    $('#capacity').val(resp.data.capacity || '');
                                                    $('#delete-date-btn').show();
                                                    displayScheduledDate(selectedDate);
                                                    $('#scheduled-date-display').show();
                                                }
                                            },
                                            error: function (xhr) {
                                                console.error('Error fetching details:', xhr);
                                                showMessage('Error fetching details.', 'error');
                                            }
                                        });
                                    } else {
                                        $('#meeting-link-section').hide();
                                        $('#scheduled-date-display').hide();
                                    }
                                } else {
                                    showMessage('Error fetching dates.', 'error');
                                }
                            },
                            error: function (xhr) {
                                console.error('Error fetching dates:', xhr);
                                showMessage('Error fetching dates.', 'error');
                            }
                        });
                    });

                    // Previous month button
                    $('#prev-month').on('click', function () {
                        currentDate.setMonth(currentDate.getMonth() - 1);
                        renderCalendar(currentDate);
                    });

                    // Next month button
                    $('#next-month').on('click', function () {
                        currentDate.setMonth(currentDate.getMonth() + 1);
                        renderCalendar(currentDate);
                    });

                    // Date click handler (only allow if no date saved for the type)
                    $(document).on('click', '.calendar-day:not(.past-date)', function () {
                        if (!selectedProductTypeId) {
                            showMessage('Please select a product type first.', 'error');
                            return;
                        }

                        if (savedDates.length > 0) {
                            showMessage('This product type already has a date. You can only have one date per product type.', 'error');
                            return;
                        }

                        selectedDate = $(this).data('date');
                        $('#meeting_link').val('');
                        $('#capacity').val('');
                        $('#delete-date-btn').hide();
                        $('#meeting-link-section').show();
                        displayScheduledDate(selectedDate);
                        $('#scheduled-date-display').show();
                    });

                    // Save button click handler
                    $('#save-date-btn').on('click', function () {
                        if (!selectedDate) {
                            showMessage('Please select a date first.', 'error');
                            return;
                        }

                        const meetingLink = $('#meeting_link').val();
                        if (!meetingLink) {
                            showMessage('Please enter a meeting link.', 'error');
                            return;
                        }

                        const capacity = $('#capacity').val();
                        if (!capacity || capacity < 1) {
                            showMessage('Please enter a valid capacity (minimum 1).', 'error');
                            return;
                        }

                        $(this).prop('disabled', true).text('Saving...');
                        const formData = new FormData(document.getElementById('dateSettingsForm'));
                        formData.append('dates', JSON.stringify([selectedDate]));
                        formData.append('capacity', capacity);
                        formData.append('action', 'save');
                        formData.append('_token', $('input[name="_token"]').val());

                        $.ajax({
                            url: "{{ route('AdminPrefferdDates') }}",
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response.success) {
                                    showMessage(response.message);
                                    savedDates.push(selectedDate);
                                    renderCalendar(currentDate);
                                    $('#delete-date-btn').show();
                                } else {
                                    showMessage(response.message, 'error');
                                }
                            },
                            error: function (xhr) {
                                const msg = xhr.responseJSON?.message || 'Error saving date.';
                                showMessage(msg, 'error');
                            },
                            complete: function () {
                                $('#save-date-btn').prop('disabled', false).text('Save');
                            }
                        });
                    });

                    // Delete button click handler
                    $('#delete-date-btn').on('click', function () {
                        if (!confirm('Are you sure you want to delete this date?')) return;
                        if (!selectedDate) return;

                        $(this).prop('disabled', true).text('Deleting...');
                        const formData = new FormData();
                        formData.append('dates', JSON.stringify([selectedDate]));
                        formData.append('product_type', selectedProductTypeId);
                        formData.append('action', 'delete');
                        formData.append('_token', $('input[name="_token"]').val());

                        $.ajax({
                            url: "{{ route('AdminPrefferdDates') }}",
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response.success) {
                                    showMessage(response.message);
                                    savedDates = savedDates.filter(d => d !== selectedDate);
                                    renderCalendar(currentDate);
                                    $('#meeting-link-section').hide();
                                    $('#scheduled-date-display').hide();
                                    selectedDate = null;
                                } else {
                                    showMessage(response.message, 'error');
                                }
                            },
                            error: function (xhr) {
                                const msg = xhr.responseJSON?.message || 'Error deleting date.';
                                showMessage(msg, 'error');
                            },
                            complete: function () {
                                $('#delete-date-btn').prop('disabled', false).text('Delete');
                            }
                        });
                    });

                    // Copy link functionality
                    $(document).on('click', '.copy-link-btn', function (e) {
                        e.preventDefault();
                        const link = $(this).data('link');
                        const button = $(this);

                        // Create temporary input to copy text
                        const tempInput = document.createElement('input');
                        tempInput.value = link;
                        document.body.appendChild(tempInput);
                        tempInput.select();

                        try {
                            document.execCommand('copy');

                            // Visual feedback
                            const originalHTML = button.html();
                            button.html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                            </svg>`);
                            button.addClass('copied');

                            showMessage('Link copied to clipboard!', 'success');

                            // Reset icon after 2 seconds
                            setTimeout(() => {
                                button.html(originalHTML);
                                button.removeClass('copied');
                            }, 2000);
                        } catch (err) {
                            console.error('Copy failed:', err);
                            showMessage('Failed to copy link', 'error');
                        }

                        document.body.removeChild(tempInput);
                    });
                });
            })(jQuery);
        </script>
    @endsection
@endsection