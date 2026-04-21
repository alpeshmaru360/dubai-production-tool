@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/document.css') }}" rel="stylesheet" />
<link href="{{ asset('css/sales_manager/product_type_docs.css') }}" rel="stylesheet" />
<!-- First Parallax Section -->
<div class="dubai_production_section bg-white">
    <a href="{{route('SaleManagerDocumentPrortal')}}" class="btn btn-primary custom-back c-back">
        <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>Back
    </a>
</div>
<section class="px-4">
    <div class="heading pb-4">
        Product Types Documents
    </div>
    <div class="folder-container">
        <!-- General Documents Folder -->
        <div class="folder">
            <a href="{{route ('booster_docs')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #169e88;">
                    <path d="M3 7h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                    <path d="M3 7V5a2 2 0 0 1 2-2h6l2 2h7a2 2 0 0 1 2 2v2"></path>
                </svg>
                <p>Booster System</p>
            </a>
        </div>
        <div class="folder">
            <a href="{{route ('control_docs')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #169e88;">
                    <path d="M3 7h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                    <path d="M3 7V5a2 2 0 0 1 2-2h6l2 2h7a2 2 0 0 1 2 2v2"></path>
                </svg>
                <p>Control Panel</p>
            </a>
        </div>
        <div class="folder">
            <a href="{{route ('norm_docs')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #169e88;">
                    <path d="M3 7h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                    <path d="M3 7V5a2 2 0 0 1 2-2h6l2 2h7a2 2 0 0 1 2 2v2"></path>
                </svg>
                <p>Norm Pump</p>
            </a>
        </div>
        <div class="folder">
            <a href="{{route ('split_case_docs')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #169e88;">
                    <path d="M3 7h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                    <path d="M3 7V5a2 2 0 0 1 2-2h6l2 2h7a2 2 0 0 1 2 2v2"></path>
                </svg>
                <p>Split-Case Pump</p>
            </a>
        </div>
        <div class="folder">
            <a href="{{route ('helix_docs')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #169e88;">
                    <path d="M3 7h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                    <path d="M3 7V5a2 2 0 0 1 2-2h6l2 2h7a2 2 0 0 1 2 2v2"></path>
                </svg>
                <p>Helix Pump</p>
            </a>
        </div>
        <div class="folder">
            <a href="{{route ('pump_motor_docs')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #169e88;">
                    <path d="M3 7h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                    <path d="M3 7V5a2 2 0 0 1 2-2h6l2 2h7a2 2 0 0 1 2 2v2"></path>
                </svg>
                <p>Pump-Motor Alignment</p>
            </a>
        </div>
        <div class="folder">
            <a href="{{route ('borehole_docs')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #169e88;">
                    <path d="M3 7h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                    <path d="M3 7V5a2 2 0 0 1 2-2h6l2 2h7a2 2 0 0 1 2 2v2"></path>
                </svg>
                <p>Borehole Pump</p>
            </a>
        </div>
        <div class="folder">
            <a href="{{route ('fire_docs')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #169e88;">
                    <path d="M3 7h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                    <path d="M3 7V5a2 2 0 0 1 2-2h6l2 2h7a2 2 0 0 1 2 2v2"></path>
                </svg>
                <p>Fire Fighting</p>
            </a>
        </div>
        
    </div>
</section>
@endsection