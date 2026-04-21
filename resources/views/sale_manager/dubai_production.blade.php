@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/sales_manager/dubai_production.css') }}" rel="stylesheet" />
<!-- First Parallax Section -->
<div class="dubai_production_section bg-white">
    <a href="{{route('SaleManagerDashboard')}}" class="btn btn-primary custom-back c-back">
        <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>Back
    </a>
    <!-- <div class="jumbotron paral paralsec d-flex align-items-center mt-3 desktop_banner"
        style="background-image: url('{{ asset('sales_manager/banner/' . $banner_image) }}'); background-size: cover; background-position: center;">
        <h1 class="display-3 font-weight-bold  text-uppercase pt-2 production_lable d-flex items-center w-50">
            {{ $page_title }}
        </h1>
    </div>
    <div class="paral paralsec d-flex align-items-center mt-3 mb-5 mobile_banner">
        <img src="{{ asset('sales_manager/banner/' . $banner_image) }}">
        <h1 class="display-3 font-weight-bold  text-uppercase pt-2 production_lable d-flex items-center w-50">
            {{ $page_title }}
        </h1>
    </div> -->

    <div class="banner-container mt-4">
        <h1 class="banner-title">{{ $page_title }}</h1>
        <img src="{{ asset('sales_manager/banner/' . $banner_image) }}" alt="Banner" class="responsive-banner">
    </div>

    <div class="row mt-3">
        <p class="px-4 text-dark text-justify-mobile">
            {{ $paragraph_content }}
        </p>
    </div>

    <div class="row w-100">
        <p class="px-4 text-dark font-weight-bold fs-18 sub_head_1">
            {{ $sub_heading_1 }}
        </p>
        <p class="px-4 text-dark text-justify-mobile">
            {{ $sub_para_1 }}
        </p>
        <a href="{{ $location_link }}" class="w-50 mx-auto phone_responsive_location" target="_blank">
            <img src="{{ asset('sales_manager/images/'. $location_image) }}" alt="" class="phone_responsive_location">
        </a>
    </div>

    <div class="row mt-4">
        <p class="px-4 text-dark font-weight-bold fs-18 sub_head_2">
            {{ $sub_heading_2 }}
        </p>
        <p class="px-4 text-dark text-justify-mobile">
            {{ $sub_para_2 }}
        </p>
    </div>

    <div class="row justify-content-center facility_images">
        <div class="col-xl-4 col-lg-4 col-sm-12 col-md-12">
            <div class="img_container px-4 d-flex justify-content-center align-items-center">
                <img class="w-100" src="{{ asset('sales_manager/images/'. $pump_test_1) }}" />
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-sm-12 col-md-12 pump_test_section_2">
            <div class="img_container px-4 d-flex justify-content-center align-items-center">
                <img class="w-100" src="{{ asset('sales_manager/images/'. $pump_test_2) }}" />
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <p class="px-4 text-dark font-weight-bold fs-18 sub_head_3">
            {{ $sub_heading_3 }}
        </p>
        <p class="px-4 text-dark text-justify-mobile">
            {{ $sub_para_3 }}
        </p>

        <div class="row w-100 ml-0">
            @foreach($productButtons as $button)
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="box dupro_box">
                    <a href="{{ $button->button_link }}" className="text-decoration-none">
                        {{ $button->button_text }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row w-100 mt-3">
            <p class="px-4 text-dark font-weight-bold fs-18 sub_head_4">
                {{ $sub_heading_4 }}
            </p>
            <p class="px-4 text-dark text-justify-mobile">
                {{ $sub_para_4 }}
            </p>
            <img src="{{ asset('sales_manager/images/'. $commitment_img) }}" class="w-75 mx-auto phone_responsive_location" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="box dupro_box">
                        <a class="commitment-button" id="ISO_9001" data-lable="{{ $commitment_button_1 }}" data-toggle="modal" data-target="#exampleModal1">{{ $commitment_button_1 }}</a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="box dupro_box">
                        <a class="commitment-button" id="ISO_9002" data-lable="{{ $commitment_button_2 }}" data-toggle="modal" data-target="#exampleModal2">{{ $commitment_button_2 }}</a>
                    </div>
                </div>

                <!-- Modal for ISO 9001 Document -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog ISO-modal" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">ISO 9001 Document</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                @if($currentISO9001Document)
                                @php
                                $fileExtension = strtolower(pathinfo($currentISO9001Document, PATHINFO_EXTENSION));
                                @endphp

                                {{-- Preview PDF files --}}
                                @if(in_array($fileExtension, ['pdf']))
                                <iframe src="{{ asset('sales_manager/documents/' . $currentISO9001Document) }}" width="100%" height="300px"></iframe>

                                {{-- Preview Office files --}}
                                @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/documents/' . $currentISO9001Document)) }}" width="100%" height="300px"></iframe>

                                {{-- For other file types --}}
                                @else
                                <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                                @endif

                                {{-- Download button --}}
                                <div class="mt-3 text-center">
                                    <a href="{{ asset('sales_manager/documents/' . $currentISO9001Document) }}" download class="btn btn-outline-primary">
                                        <i class="fas fa-download me-2"></i> Download Document
                                    </a>
                                </div>
                                @else
                                <p class="text-muted">No document uploaded yet.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for ISO 45001 Document -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                    <div class="modal-dialog ISO-modal" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">ISO 45001 Document</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                @if($currentISO45001Document)
                                @php
                                $fileExtension = strtolower(pathinfo($currentISO45001Document, PATHINFO_EXTENSION));
                                @endphp

                                {{-- Preview PDF files --}}
                                @if(in_array($fileExtension, ['pdf']))
                                <iframe src="{{ asset('sales_manager/documents/' . $currentISO45001Document) }}" width="100%" height="300px"></iframe>

                                {{-- Preview Office files --}}
                                @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/documents/' . $currentISO45001Document)) }}" width="100%" height="300px"></iframe>

                                {{-- For other file types --}}
                                @else
                                <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                                @endif

                                {{-- Download button --}}
                                <div class="mt-3 text-center">
                                    <a href="{{ asset('sales_manager/documents/' . $currentISO45001Document) }}" download class="btn btn-outline-primary">
                                        <i class="fas fa-download me-2"></i> Download Document
                                    </a>
                                </div>
                                @else
                                <p class="text-muted">No document uploaded yet.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row w-100 mt-2">
            <p class="px-4 text-dark font-weight-bold fs-18 sub_head_5">
                {{ $sub_heading_5 }}
            </p>
            <p class="px-4 text-dark text-justify-mobile">
                {{ $sub_para_5 }}
            </p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="box dupro_box">
                        <a class="dynamic-button" data-toggle="modal" data-target="#exampleModal3" data-lable="{{ $button_1 }}">{{ $button_1 }}</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="box dupro_box">
                        <a class="dynamic-button" data-toggle="modal" data-target="#exampleModal4" data-lable="{{ $button_2 }}">{{ $button_2 }}</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="box dupro_box">
                        <a class="dynamic-button" data-toggle="modal" data-target="#exampleModal5" data-lable="{{ $button_3 }}">{{ $button_3 }}</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="box dupro_box">
                        <a class="dynamic-button" data-toggle="modal" data-target="#exampleModal6" data-lable="{{ $button_4 }}">{{ $button_4 }}</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="box dupro_box">
                        <a class="dynamic-button" data-toggle="modal" data-target="#exampleModal7" data-lable="{{ $button_5 }}">{{ $button_5 }}</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="box dupro_box">
                        <a class="dynamic-button" data-toggle="modal" data-target="#exampleModal8" data-lable="{{ $button_6 }}">{{ $button_6 }}</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row w-100 mt-3">
            <p class="px-4 text-dark font-weight-bold fs-18 sub_head_6">
                {{ $sub_heading_6 }}
            </p>
            <p class="px-4 text-dark text-justify-mobile">
                {{ $sub_para_6 }}
            </p>
        </div>
        <div class="row w-100 mt-2">
            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive"> <!-- Scrollable wrapper -->
                    <table class="team_table">
                        <tr>
                            <th class="th-bg font-weight-bold text-center text-base text-uppercase text-light">Profile</th>
                            <th class="th-bg font-weight-bold text-center text-base text-uppercase text-light">Name</th>
                            <th class="th-bg font-weight-bold text-center text-base text-uppercase text-light">Designation</th>
                            <th class="th-bg font-weight-bold text-center text-base text-uppercase text-light">Email</th>
                        </tr>
                        @foreach($members as $member)
                        <tr class="text-center text-base text-dark">
                            <td class="w-25">
                                @if(file_exists(public_path('sales_manager/team_about_dubai/' . $member->profile_pic)) && !empty($member->profile_pic))
                                <img src="{{ asset('sales_manager/team_about_dubai/' . $member->profile_pic) }}" alt="Profile Pic" class="team_img">
                                @else
                                <img id="profilePicPreview" src="{{ asset('sales_manager/team_about_dubai/default_user.jpg') }}" alt="Profile Picture" class="team_img mb-2" height="100" width="100">
                                @endif
                            </td>
                            <td class="text-uppercase">{{ $member->name }}</td>
                            <td class="text-uppercase">{{ $member->designation }}</td>
                            <td>{{ $member->email }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="row w-100 mt-4">
            <p class="px-4 text-dark font-weight-bold fs-18 sub_head_7">
                {{ $sub_heading_7 }}
            </p>
            <p class="px-4 text-dark text-justify-mobile">
                {{ $sub_para_7 }}
            </p>
        </div>

        <div class="row w-100">
            <div class="w-100 mx-auto text-center d-flex flex-wrap justify-content-center">
                <div class="success_box">
                    <h5>{{ $success_stories_1_heading }}</h5>
                    <img src="{{ asset('sales_manager/images/' . $success_stories_image_1) }}" class="mt-2 success-image" alt="">
                </div>
                <div class="success_box">
                    <h5>{{ $success_stories_2_heading }}</h5>
                    <img src="{{ asset('sales_manager/images/' . $success_stories_image_2) }}" class="mt-2 success-image" alt="">
                </div>
                <div class="success_box">
                    <h5>{{ $success_stories_3_heading }}</h5>
                    <img src="{{ asset('sales_manager/images/' . $success_stories_image_3) }}" class="mt-2 success-image" alt="">
                </div>
            </div>
        </div>

        <!-- Fullscreen Modal -->
        <div id="imageModal" class="image-modal">
            <span class="close" id="close-img">&times;</span>
            <img class="modal-content" id="modalImage">
        </div>



        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
            <div class="modal-dialog ISO-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3"></h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        @if($currentsustainability_document_1)
                        @php
                        $fileExtension = strtolower(pathinfo($currentsustainability_document_1, PATHINFO_EXTENSION));
                        @endphp

                        {{-- Preview PDF files --}}
                        @if(in_array($fileExtension, ['pdf']))
                        <iframe src="{{ asset('sales_manager/documents/' . $currentsustainability_document_1) }}" width="100%" height="300px"></iframe>

                        {{-- Preview Office files --}}
                        @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/documents/' . $currentsustainability_document_1)) }}" width="100%" height="300px"></iframe>

                        {{-- For other file types --}}
                        @else
                        <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                        @endif

                        {{-- Download button --}}
                        <div class="mt-3 text-center">
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_1) }}" download class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i> Download Document
                            </a>
                        </div>
                        @else
                        <p class="text-muted">No document uploaded yet.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
            <div class="modal-dialog ISO-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4"></h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        @if($currentsustainability_document_2)
                        @php
                        $fileExtension = strtolower(pathinfo($currentsustainability_document_2, PATHINFO_EXTENSION));
                        @endphp

                        {{-- Preview PDF files --}}
                        @if(in_array($fileExtension, ['pdf']))
                        <iframe src="{{ asset('sales_manager/documents/' . $currentsustainability_document_2) }}" width="100%" height="300px"></iframe>

                        {{-- Preview Office files --}}
                        @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/documents/' . $currentsustainability_document_2)) }}" width="100%" height="300px"></iframe>

                        {{-- For other file types --}}
                        @else
                        <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                        @endif

                        {{-- Download button --}}
                        <div class="mt-3 text-center">
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_2) }}" download class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i> Download Document
                            </a>
                        </div>
                        @else
                        <p class="text-muted">No document uploaded yet.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
            <div class="modal-dialog ISO-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel5"></h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        @if($currentsustainability_document_3)
                        @php
                        $fileExtension = strtolower(pathinfo($currentsustainability_document_3, PATHINFO_EXTENSION));
                        @endphp

                        {{-- Preview PDF files --}}
                        @if(in_array($fileExtension, ['pdf']))
                        <iframe src="{{ asset('sales_manager/documents/' . $currentsustainability_document_3) }}" width="100%" height="300px"></iframe>

                        {{-- Preview Office files --}}
                        @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/documents/' . $currentsustainability_document_3)) }}" width="100%" height="300px"></iframe>

                        {{-- For other file types --}}
                        @else
                        <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                        @endif

                        {{-- Download button --}}
                        <div class="mt-3 text-center">
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_3) }}" download class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i> Download Document
                            </a>
                        </div>
                        @else
                        <p class="text-muted">No document uploaded yet.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
            <div class="modal-dialog ISO-modal" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel6"></h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        @if($currentsustainability_document_4)
                        @php
                        $fileExtension = strtolower(pathinfo($currentsustainability_document_4, PATHINFO_EXTENSION));
                        @endphp

                        {{-- Preview PDF files --}}
                        @if(in_array($fileExtension, ['pdf']))
                        <iframe src="{{ asset('sales_manager/documents/' . $currentsustainability_document_4) }}" width="100%" height="300px"></iframe>

                        {{-- Preview Office files --}}
                        @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/documents/' . $currentsustainability_document_4)) }}" width="100%" height="300px"></iframe>

                        {{-- For other file types --}}
                        @else
                        <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                        @endif

                        {{-- Download button --}}
                        <div class="mt-3 text-center">
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_4) }}" download class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i> Download Document
                            </a>
                        </div>
                        @else
                        <p class="text-muted">No document uploaded yet.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel7" aria-hidden="true">
            <div class="modal-dialog ISO-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel7"></h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        @if($currentsustainability_document_5)
                        @php
                        $fileExtension = strtolower(pathinfo($currentsustainability_document_5, PATHINFO_EXTENSION));
                        @endphp

                        {{-- Preview PDF files --}}
                        @if(in_array($fileExtension, ['pdf']))
                        <iframe src="{{ asset('sales_manager/documents/' . $currentsustainability_document_5) }}" width="100%" height="300px"></iframe>

                        {{-- Preview Office files --}}
                        @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/documents/' . $currentsustainability_document_5)) }}" width="100%" height="300px"></iframe>

                        {{-- For other file types --}}
                        @else
                        <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                        @endif

                        {{-- Download button --}}
                        <div class="mt-3 text-center">
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_5) }}" download class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i> Download Document
                            </a>
                        </div>
                        @else
                        <p class="text-muted">No document uploaded yet.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel8" aria-hidden="true">
            <div class="modal-dialog ISO-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel8"></h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        @if($currentsustainability_document_6)
                        @php
                        $fileExtension = strtolower(pathinfo($currentsustainability_document_6, PATHINFO_EXTENSION));
                        @endphp

                        {{-- Preview PDF files --}}
                        @if(in_array($fileExtension, ['pdf']))
                        <iframe src="{{ asset('sales_manager/documents/' . $currentsustainability_document_6) }}" width="100%" height="300px"></iframe>

                        {{-- Preview Office files --}}
                        @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('sales_manager/documents/' . $currentsustainability_document_6)) }}" width="100%" height="300px"></iframe>

                        {{-- For other file types --}}
                        @else
                        <span class="preview-not d-flex justify-content-center align-items-center">Preview Not Available</span>
                        @endif

                        {{-- Download button --}}
                        <div class="mt-3 text-center">
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_6) }}" download class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i> Download Document
                            </a>
                        </div>
                        @else
                        <p class="text-muted">No document uploaded yet.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/sales_manager/dubai_production.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#team_table').DataTable({
                paging: true,
                pageLength: 10,
                lengthMenu: [2, 5, 10, 25, 50, 100],
                ordering: false
            });
        });
    </script>
    <!-- Add More Parallax Sections Here -->
    @endsection