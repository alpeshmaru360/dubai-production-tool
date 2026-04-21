@extends('layouts.main')
<style>
    .success-image {
        width: 400px;
        /* Set a desired width */
        height: 160px;
        /* Set a desired height */
        object-fit: cover;
        /* Ensures the image scales proportionally and fills the space */
        border-radius: 10px;
        /* Optional: Add rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Optional: Add a shadow for better visuals */
    }

    .success_box {
        margin: 0 10px;
        /* Add some spacing between boxes */
    }

    .ISO-modal {
        position: relative !important;
        top: 50% !important;
    }
    .page_title{
        color: #169e88 !important; 
    }

/** dubai production banner - start **/
/*.paral h1{
    color: #37a091 !important;
}
@media only screen and (max-width: 992px) {    
    .mobile_banner{
        margin-top: 120px !important;
        margin-bottom: 90px !important;
    }
}
@media only screen and (max-width: 576px) {
    .desktop_banner{
        display: none !important;
    }
    .mobile_banner{
        margin-top: 45% !important;
        margin-bottom: 35% !important;
    }
    .mobile_banner h1{
        display: block !important;
        position: absolute;
        line-height: normal !important;
        font-size: 16px;
        padding: 0 0 0 10px;
    }
}
@media only screen and (max-width: 450px) {
    .mobile_banner{
        margin-top: 42% !important;
        margin-bottom: 35% !important;
    }
}
@media only screen and (min-width: 577px) {
    .mobile_banner{
        display: none !important;
    }
    .mobile_banner h1{
        display: none !important;
    }
}*/


.banner-container {
    position: relative;
    width: 100%;
    margin: 20px auto 0 auto;
}
.responsive-banner {
    width: 100%;
    display: block;
    border-radius: 10px;
    height: 400px;
    object-fit: cover;
}
.banner-title {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    color: white;
    font-size: clamp(16px, 4vw, 36px);
    font-weight: bold;
    background: rgba(0, 0, 0, 0.5);
    padding: 10px 15px;
    border-radius: 5px;
    max-width: 80%;
}
@media (max-width: 768px) {
    .banner-container {
        margin: 15px auto 0 auto;
    }    
    .banner-title {
        font-size: 20px;
        left: 10px;
        padding: 8px 12px;
    }
    .responsive-banner {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
}
@media (max-width: 480px) {
    .banner-container {
        margin: 10px auto 0 auto;
    }
    .banner-title {
        font-size: 18px;
        padding: 6px 10px;
    }
    .responsive-banner {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
}
</style>
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />

<div class="dubai_production_section bg-white">
    <a href="{{route('SaleManagerDashboard')}}" class="btn btn-primary custom-back c-back">
        <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>Back
    </a>
    <div class="banner-container">
        <h1 class="banner-title">{{ $currentBannerLabel }}</h1>
        <img src="{{ asset('sales_manager/banner/' . $currentBannerImage) }}" alt="Banner" class="responsive-banner">
    </div>
</div>
@endsection



