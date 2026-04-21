@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/tabs/general_documents.css') }}" rel="stylesheet" />
<style>
    .d-flex.justify-content-center.gap-3 {
        gap: 10px;
    }

    .preview-not {
        width: 100%;
        height: 200px;
    }

    .img-preview {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 4px;
        transition: transform 0.3s ease;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #169e88;
        border-color: #169e88;
    }

    .page-link {
        color: #169e88;
    }

    .search-btn {
        height: 38px !important;
        padding-top: 8px !important;
        border-radius: 20px !important;
    }

    .search-btn:active {
        height: 38px !important;
        padding-top: 8px !important;
        border-radius: 8px !important;
        text-transform: none !important;
        background-color: #169e88 !important;
    }

    .download-btn:active {
        background-color: #169e88 !important;
        color: #fff !important;
    }

    @media only screen and (min-width: 350px) and (max-width: 992px) {
        .custom-back {
            margin-bottom: 10px;
        }
    }
</style>

<div class="dubai_production_section bg-white">
    <div class="row g-4 d-flex justify-content-between">
        <div class="col-md-3">
            <a href="javascript:void(0);" onclick="goBack()" class="btn btn-primary custom-back">
                <svg xmlns="http://www.w3.org/2000/svg" class="back-svg me-2" viewBox="0 0 448 512">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                Back
            </a>
        </div>

        <div class="col-md-5 float-right">
            <div class="search-container mb-5">
                <form action="{{ url('sale_manager/pump_motor_docs') }}" method="GET" class="d-flex align-items-center">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search documents..." value="{{ old('search', $search ?? '') }}" style="height: 38px; margin-right:10px;">
                    <button type="submit" class="btn btn-primary search-btn br_8 fs-14">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="">
        <div class="row g-4">
            @forelse($documents as $document)
            <div class="col-md-5 col-lg-3">
                <div class="card document-card shadow-sm border-0 text-center p-3">
                    <!-- Icon -->
                    <div class="icon-container mb-3 mx-auto">
                        @php
                        $fileExtension = pathinfo($document->name, PATHINFO_EXTENSION);
                        @endphp

                        {{-- Preview PDF file --}}
                        @if(in_array(strtolower($fileExtension), ['pdf']))
                        <iframe src="{{ asset('sales_manager/document_portal/product_types/pump_motor_docs/' . $document->name) }}" width="100%" height="200px"></iframe>

                        {{-- Preview Image file --}}
                        @elseif(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'tiff', 'webp']))
                        <img src="{{ asset('sales_manager/document_portal/product_types/pump_motor_docs/' . $document->name) }}" alt="{{ $document->name }}" class="img-preview">

                        {{-- Preview Video file --}}
                        @elseif(in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg', 'avi', 'mov', 'mkv', 'flv', 'wmv', '3gp']))
                        <video autoplay muted loop src="{{ asset('sales_manager/document_portal/product_types/pump_motor_docs/' . $document->name) }}" alt="{{ $document->name }}" class="img-preview">


                            @elseif(in_array(strtolower($fileExtension), ['txt', 'csv', 'log', 'xml', 'json', 'md']))
                            <pre style="width: 100%; height: 185px; overflow: auto; border: 1px solid #ccc;">
                            {{ file_get_contents(public_path('sales_manager/document_portal/product_types/pump_motor_docs/'. $document->name)) }}
                            </pre>
                            {{-- Preview Office files (Word, Excel) --}}
                            @elseif(in_array(strtolower($fileExtension), ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/document_portal/product_types/pump_motor_docs/' . $document->name)) }}" width="100%" height="200px"></iframe>

                            {{-- For other file types, show an icon or message --}}
                            @else
                            <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                            @endif
                    </div>
                    <!-- Name -->
                    <h5 class="card-title text-dark fw-bold mb-3">
                        {{ \Illuminate\Support\Str::limit(pathinfo($document->name, PATHINFO_FILENAME), 20, '...') }}
                        .{{ pathinfo($document->name, PATHINFO_EXTENSION) }}
                    </h5>
                    <!-- Buttons -->
                    <div class="d-flex justify-content-center gap-3">
                        {{-- Show View button only for non-image files --}}
                        @if(!in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'tiff', 'webp', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv', 'log', 'xml', 'json', 'md']))
                        <a href="{{ asset('sales_manager/document_portal/product_types/pump_motor_docs/' . $document->name) }}" class="btn btn-secondary btn-sm w-50" target="_blank">
                            <i class="bi bi-eye"></i> View
                        </a>
                        @endif

                        {{-- Download button always available --}}
                        <a href="{{ asset('sales_manager/document_portal/product_types/pump_motor_docs/' . $document->name) }}" class="btn btn-primary btn-sm w-50" download>
                            <i class="bi bi-download"></i> Download
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    No Documents found.
                </div>
            </div>
            @endforelse
        </div>
        <div class="pagination float-right">
            {{ $documents->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection