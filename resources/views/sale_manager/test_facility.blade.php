@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/tabs/test_facility.css') }}">
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

    <div class="banner-container">
        <h1 class="banner-title">{{ $page_title }}</h1>
        <img src="{{ asset('sales_manager/banner/' . $banner_image) }}" alt="Banner" class="responsive-banner">
    </div>

    <div class="row">
        <p class="pt-3 px-4 text-dark text-justify-mobile">
            {{ $paragraph_content }}
        </p>
    </div>

    <div class="row w-100">
        <p class="px-4 text-dark font-weight-bold fs-18">
            {{ $sub_heading_1 }}
        </p>
        <p class="px-4 text-dark text-justify-mobile">
            {{ $sub_para_1 }}
        </p>
        <a href="{{ $location_link }}" class="w-50 mx-auto fac_img" target="_blank">
            <img src="{{ asset('sales_manager/images/'. $location_image) }}" alt="">
        </a>
    </div>

    <div class="row mt-3">
        <p class="px-4 text-dark font-weight-bold fs-18">
            {{ $sub_heading_2 }}
        </p>
        <p class="px-4 text-dark text-justify-mobile">
            {{ $sub_para_2 }}
        </p>
    </div>

    <div class="row justify-content-center facility_images">
        <div class="col-xl-4 col-lg-4 col-sm-12 col-md-12">
            <div class="img_container px-4 text-center">
                <img class="w-100" src="{{ asset('sales_manager/images/'. $pump_test_1) }}" />
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-sm-12 col-md-12 pump_test_section_2">
            <div class="img_container px-4 text-center">
                <img class="w-100" src="{{ asset('sales_manager/images/'. $pump_test_2) }}" />
            </div>
        </div>
    </div>

    
    <script src="{{ asset('js/sales_manager/dubai_production.js') }}"></script>

    <!-- Add More Parallax Sections Here -->
    @endsection