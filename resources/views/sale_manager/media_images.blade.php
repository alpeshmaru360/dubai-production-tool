@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/tabs/general_documents.css') }}" rel="stylesheet" />
<link href="{{ asset('css/sales_manager/media_images.css') }}" rel="stylesheet" />

<div class="dubai_production_section bg-white">
    <div class="row g-4 d-flex justify-content-between">
        <div class="col-md-3">
            <a href="{{route('SaleManagerMediaDatabase')}}" class="btn btn-primary custom-back">
                <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                Back
            </a>
        </div>

        <div class="col-md-5 float-right mt-2 mt-md-0">
            <div class="search-container mb-5">
                <form action="{{ url('sale_manager/media_images') }}" method="GET" class="d-flex align-items-center">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search documents..." value="{{ old('search', $search ?? '') }}" style="height: 38px; margin-right:10px;">
                    <button type="submit" class="btn btn-primary search-btn">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="">
        <div class="row g-4">
            @forelse($Images as $Image)
            <div class="col-md-5 col-lg-3">
                <div class="card document-card shadow-sm border-0 text-center p-3">
                    <!-- Icon -->
                    <div class="icon-container mb-3 mx-auto">
                        <img src="{{ asset('sales_manager/media_database/images/' . $Image->name) }}" alt="{{ $Image->name }}" class="img-preview">
                    </div>
                    <!-- Name -->
                    <h5 class="card-title text-dark fw-bold mb-3">
                        {{ \Illuminate\Support\Str::limit(pathinfo($Image->name, PATHINFO_FILENAME), 20, '...') }}
                        .{{ pathinfo($Image->name, PATHINFO_EXTENSION) }}
                    </h5>
                    <!-- Buttons -->
                    <div class="d-flex justify-content-center gap-3">
                        <!-- <a href="{{ asset('sales_manager/media_database/images/' . $Image->name) }}" class="btn btn-secondary btn-sm w-50" target="_blank">
                            <i class="bi bi-eye"></i> View
                        </a> -->
                        <a href="{{ asset('sales_manager/media_database/images/' . $Image->name) }}" class="btn btn-primary btn-sm w-100" download>
                            <i class="bi bi-download"></i> Download
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    No Images found.
                </div>
            </div>
            @endforelse
        </div>
        <div class="pagination float-right">
            {{ $Images->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection