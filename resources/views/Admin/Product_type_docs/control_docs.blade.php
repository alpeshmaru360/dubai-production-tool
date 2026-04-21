@extends('layouts.main')

@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/general_docments.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="{{ asset('css/Admin/product_type_docs/control_docs.css') }}" rel="stylesheet" />

<section class="p-3 d-flex justify-content-between">
    <div>
        <a href="{{ route('ProductDocument') }}" class="btn btn-primary custom-add">
            <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>Back
        </a>
    </div>

    <!-- + Add Button -->
    <div>
        <button type="button" class="btn btn-primary custom-add" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
            + Add
        </button>
    </div>
</section>

<!-- Documents Table Section -->
<section class="container">


    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="document-table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Document Preview</th>
                    <th scope="col">Document Name</th>
                    <th scope="col" class="text-center">Uploaded On</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $index => $document)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="document_preview">
                        @php
                        $fileExtension = strtolower(pathinfo($document->name, PATHINFO_EXTENSION));
                        @endphp

                        {{-- Preview PDF file --}}
                        @if(in_array($fileExtension, ['pdf']))
                        <iframe src="{{ asset('sales_manager/document_portal/product_types/control_docs/' . $document->name) }}" width="100%" height="150px"></iframe>

                        {{-- Preview Office files (Word, Excel, PowerPoint) --}}
                        @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'ods', 'odt', 'odp']))
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/document_portal/product_types/control_docs/' . $document->name)) }}" width="100%" height="150px"></iframe>

                        {{-- Preview Image files --}}
                        @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'tiff', 'webp']))
                        <img src="{{ asset('sales_manager/document_portal/product_types/control_docs/' . $document->name) }}" alt="{{ $document->name }}" class="img-preview">

                        {{-- Preview Video files --}}
                        @elseif(in_array($fileExtension, ['mp4', 'webm', 'ogg', 'avi', 'mov', 'mkv', 'flv', 'wmv', '3gp']))
                        <video autoplay muted loop src="{{ asset('sales_manager/document_portal/product_types/control_docs/' . $document->name) }}" alt="{{ $document->name }}" class="img-preview">
                            Your browser does not support the video tag.
                        </video>

                        {{-- Preview Text files --}}
                        @elseif(in_array($fileExtension, ['txt', 'csv', 'log', 'xml', 'json', 'md']))
                        <pre style="width: 100%; height: 150px; overflow: auto; border: 1px solid #ccc;">
                        {{ file_get_contents(public_path('sales_manager/document_portal/product_types/booster_docs/'. $document->name)) }}
                        </pre>

                        {{-- For other file types, show an icon or message --}}
                        @else
                        <span>Preview Not Available for this file type ({{ strtoupper($fileExtension) }}).</span>
                        @endif
                    </td>
                    <td>
                        @php
                        $nameWithoutExtension = pathinfo($document->name, PATHINFO_FILENAME); // Get name without extension
                        $extension = pathinfo($document->name, PATHINFO_EXTENSION); // Get extension
                        $shortName = strlen($nameWithoutExtension) > 25
                        ? substr($nameWithoutExtension, 0, 25) . '...'
                        : $nameWithoutExtension;
                        @endphp
                        {{ $shortName }}.{{ $extension }}
                    </td>

                    <td class="text-center">{{ $document->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            @php
                            $fileExtension = strtolower(pathinfo($document->name, PATHINFO_EXTENSION));
                            $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'tiff', 'webp']);
                            $isText = in_array($fileExtension, ['txt', 'csv', 'log', 'xml', 'json', 'md']);
                            $isMsOffice = in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'ods', 'odt', 'odp']);
                            @endphp

                            @if(!$isImage && !$isText && !$isMsOffice)
                            <a href="{{ asset('sales_manager/document_portal/product_types/control_docs/' . $document->name) }}" target="_blank" class="action-button" title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20">
                                    <path fill="#169e88" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                </svg>
                            </a>
                            @endif
                            <a href="{{ asset('sales_manager/document_portal/product_types/control_docs/' . $document->name) }}" class="action-button" download title="Download">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                                    <path fill="#169e88" d="M256 464a208 208 0 1 1 0-416 208 208 0 1 1 0 416zM256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM376.9 294.6c4.5-4.2 7.1-10.1 7.1-16.3c0-12.3-10-22.3-22.3-22.3L304 256l0-96c0-17.7-14.3-32-32-32l-32 0c-17.7 0-32 14.3-32 32l0 96-57.7 0C138 256 128 266 128 278.3c0 6.2 2.6 12.1 7.1 16.3l107.1 99.9c3.8 3.5 8.7 5.5 13.8 5.5s10.1-2 13.8-5.5l107.1-99.9z" />
                                </svg>
                            </a>
                            <form action="{{ route('ControlDoc.destroy', $document->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-button delete-btn" title="Delete" data-document-id="{{ $document->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
                                        <path fill="#169e88" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- File Upload Modal -->
<div class="modal fade" id="fileUploadModal" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
    <form action="{{ route('ControlDoc.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog custom-modal">
            <div class="modal-content fileUploadModal">
                <div class="modal-header">
                    <h5 class="modal-title" id="fileUploadModalLabel">Upload Files</h5>
                </div>
                <div class="modal-body">
                    <!-- Error Messages -->
                    <div id="modalErrorMessages" class="alert alert-danger d-none p-2">
                        <ul id="modalErrorList" class="mb-0" style="font-size: 0.875rem;"></ul>
                    </div>

                    <!-- Choose Files Button -->
                    <div class="text-center">
                        <button type="button" class="btn btn-primary br_8" id="chooseFilesButton">Choose Files</button>
                        <input type="file" name="document[]" id="fileInput" class="d-none" multiple />
                    </div>

                    <!-- Preview Area -->
                    <div id="previewArea" class="mt-4">
                        <p id="fileCount" class="text-muted"></p>
                    </div>

                    <!-- File Size Limit Note -->
                    <p class="text-custom mt-2" style="font-size: 0.9rem;">
                        Note: You can upload files up to 15 MB each.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary bg_black br_8" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="uploadButton" class="text-white btn btn-primary br_8 bg_theme" disabled style="background:#169e88!important; color:white !important;">Upload</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this document?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark cancel_button" data-dismiss="modal">Cancel</button>
                <form id="deleteDocumentForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger br_8">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/Admin/general_documents.js') }}"></script>

<script src="{{ asset('js/Admin/Product_type_docs/control_docs.js') }}"></script>
@endsection