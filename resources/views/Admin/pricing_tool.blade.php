@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<link href="{{ asset('css/Admin/pricing_tool.css') }}" rel="stylesheet" />
<section class="p-4">
    <div class="heading">Manage Pricing Tool</div>
    <!-- Flash Message Section -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible mt-2 noti_alert" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('UpdatePricingTool') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <div class="form-group">
                <label for="pricing_tool_link">Update Pricing Tool Link:</label><span class="text-danger">*</span>
                <input type="url" id="pricing_tool_link" name="pricing_tool_link" class="form-control"
                    value="{{ $pricingToolLink ?? '' }}" placeholder="Enter new link for Pricing Tool" required>
            </div>
            <div class="form-group">
                <button type="submit" class="save_btn">Save</button>
            </div>
        </div>
    </form>
</section>

@endsection