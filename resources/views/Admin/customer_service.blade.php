@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="{{ asset('css/Admin/customer_service.css') }}" rel="stylesheet" />
<section class="p-4">
    <div class="heading">Manage Contact Us Details</div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible mt-2" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('customer_service.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-5">
            <div class="form-group">
                <label for="email">Update email:</label><span class="text-danger">*</span>
                <input type="email" id="email" name="email" class="form-control w-50"
                    value="{{ $CurrentEmail }}" placeholder="Enter new email for contact us form" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Update Phone Number:</label><span class="text-danger">*</span>
                <input type="text" id="phone_number" name="phone_number" class="form-control w-50"
                    value="{{ $CurrentPhone }}" placeholder="Enter new phone number for contact us form" required>
            </div>
            <div class="form-group">
                <button type="submit" class="save_btn">Update</button>
            </div>
        </div>
    </form>
    <div class="container my-5">
        <div class="heading text-center mb-4">
            <h2>Customer Service Submissions</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="customer-service-table">
                <thead class="thead">
                    <tr>
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customerServices as $index => $service)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $service->username }}</td>
                        <td>{{ $service->email }}</td>
                        <td>{{ $service->phone }}</td>
                        <td>
                            {{ Str::limit($service->message, 20) }}
                            @if (strlen($service->message) > 20)
                            <a href="#" class="read-more" data-bs-toggle="modal"
                                data-bs-target="#messageModal"
                                data-message="{{ $service->message }}">Read More</a>
                            @endif
                        </td>
                        <td>{{ $service->created_at->format('d-m-Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Structure -->
        <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">Full Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p id="fullMessage"></p>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="{{ asset('js/Admin/customer_service.js') }}"></script>
    @endsection