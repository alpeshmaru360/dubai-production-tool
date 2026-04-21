@extends('layouts.main')
@section('content')

<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/salemanagerdashboard.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    {{ session('error') }}
</div>
@endif

<section class="p-4">
    <div class="heading">Manage Dashboard Video</div>

    <form action="{{ route('uploadVideo') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Video Upload Section -->
        <div class="video-display mt-4 d-flex align-items-center">
            <video id="customVideo" autoplay loop muted class="w-50 text-center h-auto video_rounded">
                <source src="{{ asset('sales_manager/video/' . $video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div id="uploadSection" style="" class="video-upload-box">
                <div class="drop-area" id="dropArea" onclick="document.getElementById('video').click()">
                    <p class="drop-text">Select new video to upload <br> or drag and drop files</p>
                    <input type="file" id="video" name="video" accept="video/*" style="display: none;" onchange="previewVideo(event)">
                    <div id="video-error" class="text-danger mt-2" style="display: none; font-size: 0.9rem;"></div>
                </div>
                <!-- Video Preview Section -->
                <div class="video-preview mt-4" style="display: none;">
                    <h5 class="preview-heading">Video Preview:</h5>
                    <video id="videoPreview" width="100%" height="auto" controls class="video-preview-element"></video>
                </div>
            </div>
        </div>
        <!-- Save Button -->
        <button type="submit" class="btn btn-primary mt-4" id="uploadButton" disabled>Upload Video</button>
    </form>

    <form action="{{ route('updateMenu') }}" method="POST" enctype="multipart/form-data" class="mt-5">
        @csrf

        <div class="heading">Manage Dashboard Menu</div>

        <div class="row dashboard-tabs text-center">
            <!-- Menu 1 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg1" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg1) }}" alt="">
                        <img id="previewMenuImg1" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg1').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg1" id="menuimg1" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg1', 'previewMenuImg1')">
                        </div>
                        <div id="file-name-menuimg1" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable1" id="menulable1" value="{{ $currentMenuLabel1 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 2 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg2" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg2) }}" alt="">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg2').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg2" id="menuimg2" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg2', 'previewMenuImg2')">
                        </div>
                        <div id="file-name-menuimg2" class="mt-1 text-muted"></div>
                        <img id="previewMenuImg2" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable2" id="menulable2" value="{{ $currentMenuLabel2 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 3 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg3" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg3) }}" alt="">
                        <img id="previewMenuImg3" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg3').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg3" id="menuimg3" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg3', 'previewMenuImg3')">
                        </div>
                        <div id="file-name-menuimg3" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable3" id="menulable3" value="{{ $currentMenuLabel3 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 4 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg4" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg4) }}" alt="">
                        <img id="previewMenuImg4" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg4').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg4" id="menuimg4" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg4', 'previewMenuImg4')">
                        </div>
                        <div id="file-name-menuimg4" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable4" id="menulable4" value="{{ $currentMenuLabel4 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 5 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg5" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg5) }}" alt="">
                        <img id="previewMenuImg5" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg5').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg5" id="menuimg5" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg5', 'previewMenuImg5')">
                        </div>
                        <div id="file-name-menuimg5" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable5" id="menulable5" value="{{ $currentMenuLabel5 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 6 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg6" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg6) }}" alt="">
                        <img id="previewMenuImg6" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg6').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg6" id="menuimg6" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg6', 'previewMenuImg6')">
                        </div>
                        <div id="file-name-menuimg6" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable6" id="menulable6" value="{{ $currentMenuLabel6 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 7 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg7" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg7) }}" alt="">
                        <img id="previewMenuImg7" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg7').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg7" id="menuimg7" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg7', 'previewMenuImg7')">
                        </div>
                        <div id="file-name-menuimg7" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable7" id="menulable7" value="{{ $currentMenuLabel7 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 8 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg8" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg8) }}" alt="">
                        <img id="previewMenuImg8" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg8').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg8" id="menuimg8" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg8', 'previewMenuImg8')">
                        </div>
                        <div id="file-name-menuimg8" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable8" id="menulable8" value="{{ $currentMenuLabel8 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 9 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg9" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg9) }}" alt="">
                        <img id="previewMenuImg9" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg9').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg9" id="menuimg9" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg9', 'previewMenuImg9')">
                        </div>
                        <div id="file-name-menuimg9" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable9" id="menulable9" value="{{ $currentMenuLabel9 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 10 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg10" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg10) }}" alt="">
                        <img id="previewMenuImg10" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg10').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg10" id="menuimg10" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg10', 'previewMenuImg10')">
                        </div>
                        <div id="file-name-menuimg10" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable10" id="menulable10" value="{{ $currentMenuLabel10 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 11 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg11" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg11) }}" alt="">
                        <img id="previewMenuImg11" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg11').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg11" id="menuimg11" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg11', 'previewMenuImg11')">
                        </div>
                        <div id="file-name-menuimg11" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable11" id="menulable11" value="{{ $currentMenuLabel11 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu 12 -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="box">
                    <div>
                        <img class="dashboard_imgs" id="currentMenuImg12" src="{{ asset('sales_manager/dashboard-img/' . $currentMenuImg12) }}" alt="">
                        <img id="previewMenuImg12" src="" alt="" class="dashboard_imgs" style="display: none;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('menuimg12').click();">
                                Upload a New Image
                            </button>
                            <input type="file" name="menuimg12" id="menuimg12" class="form-control d-none" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this, 'currentMenuImg12', 'previewMenuImg12')">
                        </div>
                        <div id="file-name-menuimg12" class="mt-1 text-muted"></div>
                        <div class="bg-tab-heading">
                            <input type="text" name="menulable12" id="menulable12" value="{{ $currentMenuLabel12 }}" class="form-control text-center" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Save All Menu</button>
    </form>
</section>
<script src="{{ asset('js/Admin/salemanagerdashboard.js') }}"></script>
@endsection