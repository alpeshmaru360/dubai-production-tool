@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<div class="page_content_wrap p-0">
    <div class="content_wrap">
        <a id="content_skip_link_anchor" class="alliance_skip_link_anchor" href="#"></a>
        <div class="post_content entry-content">
            <div data-elementor-type="wp-page" data-elementor-id="8649" class="elementor elementor-8649">
                <div class="video_section mb-4 w-85 mx-auto text-center">
                    <!-- <video id="customVideo" autoplay loop muted class="mt-4 w-75 text-center h-auto video_rounded"> -->
                    {{-- 
                        <video id="customVideo" loop autoplay allowfullscreen allow="accelerometer; autoplay" class="mt-4 w-75 text-center h-auto video_rounded">
                            <source src="{{ asset('sales_manager/video/' . $video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            <video id="customVideo" loop muted autoplay class="mt-4 w-75 text-center h-auto video_rounded">
                                <source src="{{ asset('sales_manager/video/' . $video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </video>
                     --}}
                    <video id="customVideo" loop autoplay controls class="mt-4 w-75 text-center h-auto video_rounded">
                        <source src="{{ asset('sales_manager/video/' . $video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                    </video>
                </div>



                <section class="elementor-section salehiya_homepage_icon_section p-0" data-id="be12328"
                    data-element_type="section">
                    <div class="row dashboard-tabs">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{route('SaleManagerDubaiProduction')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage1) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable1 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{ $pricingToolLink }}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage2) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable2 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{ $orderTrackLink }}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage3) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable3 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                            <!-- <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="box ">
                                    <a class="d-block" href="{{route('SaleManagerVirtualTour')}}" data-lable="">
                                        <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage4) }}" alt="">
                                        <div class="bg-tab-heading">
                                            <h5>{{ $menulable4 }}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box position-relative">
                                <a class="d-block" href="{{route('SaleManagerVirtualTour')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage4) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable4 }}</h5>  
                                    </div>
                                </a>
                            </div>
                            <!-- Coming Soon Overlay -->
                            <div class="coming-soon-overlay">
                                <img src="{{ asset('sales_manager/dashboard-img/coming_soon.png') }}" alt="Coming Soon" class="coming-soon-img">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{route('SaleManagerMediaDatabase')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage5) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable5 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                       {{--  <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{route('SaleManagerReferance')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage6) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable6 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div> --}}
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{ $RefenceTablelink }}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage6) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable6 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{route('SaleManagerTestFacility')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage7) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable7 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{route('SaleManagerDocumentPrortal')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage8) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable8 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">

                                <a class="d-block" href="{{route('witness.create')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage9) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable9 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{route('SaleManagerReqCustomerService')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage10) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable10 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{route('SaleManagerRequestTraining')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage11) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable11 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="box ">
                                <a class="d-block" href="{{route('SaleManagerFeedbackForm')}}" data-lable="">
                                    <img class="dashboard_imgs" src="{{ asset('sales_manager/dashboard-img/' . $menuimage12) }}" alt="">
                                    <div class="bg-tab-heading">
                                        <h5>{{ $menulable12 }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/sales_manager/dashboard.js') }}"></script>
@endsection