@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/tabs/general_documents.css') }}" rel="stylesheet" />
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<div class="dubai_production_section bg-white">
    <div class="row g-4 d-flex justify-content-between">
        <div class="col-md-3">
            <a href="{{route('SaleManagerDocumentPrortal')}}" class="btn btn-primary custom-back">
                <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                Back
            </a>
        </div>

        <div class="col-md-5 float-right">
            <div class="search-container mb-5">
                <form action="{{ url('sale_manager/general_documents') }}" method="GET" class="d-flex align-items-center">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search documents..." value="{{ old('search', $search ?? '') }}" style="height: 38px; margin-right:10px;">
                    <button type="submit" class="btn btn-primary search-btn">Search</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <div class="">
        <div class="row g-4">
            @forelse($documents as $document)
            <div class="col-md-5 col-lg-4">
                <div class="card document-card shadow-sm border-0 text-center p-3">
                    <!-- Icon -->
                    <div class="icon-container mb-3 mx-auto">
                        @php
                        $fileExtension = pathinfo($document->name, PATHINFO_EXTENSION);
                        $documentPath = asset('sales_manager/document_portal/general_documents/' . $document->name);
                        @endphp

                        {{-- Preview PDF file --}}
                        @if(in_array(strtolower($fileExtension), ['pdf']))

                        <iframe src="{{ $documentPath }}" width="100%" height="200px"></iframe>

                        {{-- Preview Image file --}}
                        @elseif(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'tiff', 'webp']))
                        <!-- <img src="{{ asset('sales_manager/document_portal/general_documents/' . $document->name) }}" alt="{{ $document->name }}" class="img-preview"> -->

                        <!-- <iframe src="https://docs.google.com/gview?url={{ urlencode($documentPath) }}&embedded=true" width="100%" height="200px"></iframe> -->

                        <iframe src="https://docs.google.com/gview?url={{ urlencode($documentPath) }}&embedded=true" width="100%" height="600px" style="pointer-events: none; border: none;"></iframe>

                        {{-- Preview Video file --}}
                        @elseif(in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg', 'avi', 'mov', 'mkv', 'flv', 'wmv', '3gp']))
                        <video autoplay muted loop src="{{ $documentPath }}" alt="{{ $document->name }}" class="img-preview">

                            {{-- Preview Office files (Word, Excel) --}}
                            @elseif(in_array(strtolower($fileExtension), ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                            <!-- <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/document_portal/general_documents/' . $document->name)) }}" width="100%" height="200px"></iframe> -->

                            <iframe src="https://docs.google.com/gview?url={{ urlencode($documentPath) }}&embedded=true" width="100%" height="200px"></iframe>

                            @elseif(in_array(strtolower($fileExtension), ['txt', 'csv', 'log', 'xml', 'json', 'md']))
                            <pre style="width: 100%; height: 185px; overflow: auto; border: 1px solid #ccc;">
                            {{ file_get_contents(public_path('sales_manager/document_portal/general_documents/'. $document->name)) }}
                            </pre>
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
                        <a href="{{ $documentPath }}" class="btn btn-secondary btn-sm w-50" target="_blank">
                            <i class="bi bi-eye"></i> View
                        </a>
                        @endif

                        {{-- Download button always available --}}
                        <a href="{{ $documentPath }}" class="btn btn-primary btn-sm w-50 download-btn" download>
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
@endsection