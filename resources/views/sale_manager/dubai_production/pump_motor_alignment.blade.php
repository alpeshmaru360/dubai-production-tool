@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />

<div class="dubai_production_section bg-white">
<a href="{{route('SaleManagerDubaiProduction')}}" class="back-btn"><svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>Back</a>
    <div class="jumbotron paral paralsec d-flex align-items-center mt-4"  style="background-image: url('{{ asset($banner_image) }}'); background-size: cover; background-position: center;">
    <h1 class="display-3 font-weight-bold text-uppercase pt-2 production_lable d-flex items-center">{{ $page_title }}</h1>
    </div>
</div class="text-center font-sz-18 my-5">
    <h1 class="text-center font-weight-bold">No Document Found</h1>
<div>

</div>
<!-- Add More Parallax Sections Here -->
@endsection