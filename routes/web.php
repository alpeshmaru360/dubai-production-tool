<?php

use App\Http\Controllers\Admin\VirtualTourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleManager\RequestTrainingController;
use App\Http\Controllers\SaleManager\WitnessFormController;
use App\Http\Controllers\SaleManager\TestFacilityController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\SaleManager\FeedbackFormController;
use App\Http\Controllers\SaleManager\SaleManagerController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\SaleManagerDashboardController;
use App\Http\Controllers\Admin\PricingToolController;
use App\Http\Controllers\Admin\AboutDubaiProductionController;
use App\Http\Controllers\Admin\TestFacilityAdminController;
use App\Http\Controllers\Admin\OrderTrackController;
use App\Http\Controllers\Admin\GeneralDocumentController;
use App\Http\Controllers\SaleManager\ProductTypeDocumentUserController;
use App\Http\Controllers\SaleManager\GeneralDocumentUserController;
use App\Http\Controllers\SaleManager\MediaImgUserController;
use App\Http\Controllers\SaleManager\MediaVideoUserController;
use App\Http\Controllers\SaleManager\MediaDocsUserController;


use App\Http\Controllers\Admin\TeamAboutDubaiController;
use App\Http\Controllers\Admin\RefTableController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRoleMiddleware;

// Route for the home page
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login_form'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('AuthLogin');
});

// Redirect authenticated users trying to access /login
Route::get('/login', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'Admin') {
            return redirect()->route('AdminDashboard');
        } elseif ($user->role === 'Sales Manager') {
            return redirect()->route('SaleManagerDashboard');
        } else {
            // For any other role, you can decide where to redirect
            return redirect()->route('SaleManagerDashboard');
        }
    }
    return app()->call('App\Http\Controllers\Auth\AuthController@login_form');
})->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('Logout');

// Apply CheckRoleMiddleware to all routes that require authentication
Route::middleware(['auth', CheckRoleMiddleware::class])->group(function () {
    // Admin routes
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', CheckRoleMiddleware::class . ':Admin']], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('AdminDashboard');
        Route::post('save-emails', [AdminController::class, 'saveEmails'])->name('saveEmails1');
        Route::get('request_training', [AdminController::class, 'request_training'])->name('AdminRequestTraining');
        Route::get('witness_test', [AdminController::class, 'witness_test'])->name('AdminWitnessTest');
        Route::get('feedback', [AdminController::class, 'feedback'])->name('AdminFeedback');
        Route::get('setting', [AdminController::class, 'setting'])->name('AdminSettings');
        Route::get('salemanager_dashboard', [SaleManagerDashboardController::class, 'index'])->name('SalemanagerDashboard');
        Route::get('pricing_tool', [PricingToolController::class, 'index'])->name('PricingTool');
        Route::get('order_track', [OrderTrackController::class, 'index'])->name('OrderTrack');
        Route::get('virtual_tour', [VirtualTourController::class, 'index'])->name('VirtualTour');
        Route::post('salemanager_dashboard/upload-video', [SaleManagerDashboardController::class, 'uploadVideo'])->name('uploadVideo');
        Route::post('salemanager_dashboard/update-menu', [SaleManagerDashboardController::class, 'updateMenu'])->name('updateMenu');
        Route::post('salemanager_dashboard/upload', [SaleManagerDashboardController::class, 'uploadVideo'])->name('salemanagerdashboard.upload');
        Route::post('save-preferred-dates', [AdminController::class, 'SavePreferredDates'])->name('AdminPrefferdDates');

        // Remove this duplicate line to avoid conflicts:
        Route::get('get-preferred-date-details', [AdminController::class, 'getPreferredDateDetails'])->name('getPreferredDateDetails');
        Route::get('/get-dates-by-product-type', [AdminController::class, 'getDatesByProductType'])->name('getDatesByProductType');
        Route::resource('users', UsersController::class)->only(['index', 'store', 'destroy', 'update'])->names([
            'index' => 'admin.users.index',
            'store' => 'admin.users.store',
            'destroy' => 'admin.users.destroy',
        ]);
        ;
        Route::post('/users', [UsersController::class, 'store'])->name('admin.users.store');
        Route::resource('countries', CountryController::class)
            ->only(['index', 'store', 'destroy'])
            ->names([
                    'index' => 'admin.countries.index',
                    'store' => 'admin.countries.store',
                    'destroy' => 'admin.countries.destroy',
                ]);
        Route::get('about_dubai_production_tool', [AboutDubaiProductionController::class, 'index'])->name('AboutDubaiProductionTool');
        Route::post('update-banner-image', [AboutDubaiProductionController::class, 'updateBannerImage'])->name('admin.updateBannerImage');
        Route::post('/updateLocation', [AboutDubaiProductionController::class, 'updateLocation'])->name('admin.updateLocation');
        Route::post('/updateQuality', [AboutDubaiProductionController::class, 'updateQuality'])->name('admin.updateQuality');
        Route::post('/updateSustainability', [AboutDubaiProductionController::class, 'updateSustainability'])->name('admin.updateSustainability');
        Route::post('/updateTeam', [AboutDubaiProductionController::class, 'updateTeam'])->name('admin.updateTeam');
        Route::post('/updateInnovation', [AboutDubaiProductionController::class, 'updateInnovation'])->name('admin.updateInnovation');
        Route::post('/update-pump-testing-facility', [AboutDubaiProductionController::class, 'updatePumpTestingFacility'])->name('admin.updatePumpTestingFacility');
        Route::post('/update-product-range', [AboutDubaiProductionController::class, 'updateProductRange'])->name('admin.updateProductRange');
        Route::get('/product-range', [AboutDubaiProductionController::class, 'showProductRangeForm'])->name('admin.productRangeForm');
        Route::get('/about-dubai', [AboutDubaiProductionController::class, 'create'])->name('about-dubai.create');
        Route::post('/about-dubai', [AboutDubaiProductionController::class, 'store'])->name('about-dubai.store');
        Route::get('/about-dubai/{id}/edit', [AboutDubaiProductionController::class, 'edit'])->name('about-dubai.edit');
        Route::post('/about-dubai/{id}', [AboutDubaiProductionController::class, 'update'])->name('about-dubai.update');
        Route::delete('/about-dubai/{id}', [AboutDubaiProductionController::class, 'destroy'])->name('about-dubai.destroy');

        Route::post('/setDubaiTeamOrder', [AboutDubaiProductionController::class, 'setDubaiTeamOrder'])->name('about-dubai.setDubaiTeamOrder');

        Route::get('test_facility', [TestFacilityAdminController::class, 'index'])->name('TestFacility');
        Route::post('update-banner-image1', [TestFacilityAdminController::class, 'updateBannerImage1'])->name('admin.updateBannerImage1');
        Route::post('/updateLocation1', [TestFacilityAdminController::class, 'updateLocation1'])->name('admin.updateLocation1');
        Route::post('/updateQuality1', [TestFacilityAdminController::class, 'updateQuality1'])->name('admin.updateQuality1');
        Route::post('/updateSustainability1', [TestFacilityAdminController::class, 'updateSustainability1'])->name('admin.updateSustainability1');
        Route::post('/updateTeam1', [TestFacilityAdminController::class, 'updateTeam1'])->name('admin.updateTeam1');
        Route::post('/updateInnovation1', [TestFacilityAdminController::class, 'updateInnovation1'])->name('admin.updateInnovation1');
        Route::post('/update-pump-testing-facility1', [TestFacilityAdminController::class, 'updatePumpTestingFacility1'])->name('admin.updatePumpTestingFacility1');
        Route::post('/update-product-range1', [TestFacilityAdminController::class, 'updateProductRange1'])->name('admin.updateProductRange1');
        Route::get('/product-range1', [TestFacilityAdminController::class, 'showProductRangeForm1'])->name('admin.productRangeForm1');
        Route::get('/about-dubai1', [TestFacilityAdminController::class, 'create1'])->name('about-dubai.create1');
        Route::post('/about-dubai1', [TestFacilityAdminController::class, 'store1'])->name('about-dubai.store1');
        Route::get('/about-dubai1/{id}/edit1', [TestFacilityAdminController::class, 'edit1'])->name('about-dubai.edit1');
        Route::post('/about-dubai1/{id}', [TestFacilityAdminController::class, 'update1'])->name('about-dubai.update1');
        Route::delete('/about-dubai1/{id}', [TestFacilityAdminController::class, 'destroy1'])->name('about-dubai.destroy1');
        Route::post('/setTestFacilityOrder', [TestFacilityAdminController::class, 'setTestFacilityOrder'])->name('test-facility.setTestFacilityOrder');

        Route::post('update-banner-image-for-virtual-tour', [VirtualTourController::class, 'updateBannerImageForVT'])->name('admin.updateBannerImageForVT');

        Route::get('/dashboard/data/{year}', [AdminController::class, 'getDataForYear']);
        Route::post('/update-pricing-tool', [PricingToolController::class, 'updatePricingTool'])->name('UpdatePricingTool');
        Route::post(
            '/admin/witness-test/save-emails',
            [AdminController::class, 'saveWitnessTestEmails']
        )->name('admin.saveWitnessEmails');
        Route::post('/update-reference-table', [RefTableController::class, 'updateReferenceTable'])->name('UpdateReferenceTable');
        Route::post('/update-order-track', [OrderTrackController::class, 'updateOrderTrack'])->name('updateOrderTrack');
        Route::post('salemanager_dashboard/save-all', [SaleManagerDashboardController::class, 'saveAll'])->name('salemanagerdashboard.saveAll');
        Route::get('document_protal', [DocumentController::class, 'index'])->name('DocumentPortal');
        Route::get('media_database', [App\Http\Controllers\Admin\MediaDbController::class, 'index'])->name('MediaDB');
        Route::get('media_images', [App\Http\Controllers\Admin\MediaImgController::class, 'index'])->name('MediaImages');
        Route::post('media_images', [App\Http\Controllers\Admin\MediaImgController::class, 'store'])->name('MediaImages.store');
        Route::delete('media_images/{id}', [App\Http\Controllers\Admin\MediaImgController::class, 'destroy'])->name('MediaImages.destroy');
        Route::get('media_videos', [App\Http\Controllers\Admin\MediaVideoController::class, 'index'])->name('MediaVideos');
        Route::post('media_videos', [App\Http\Controllers\Admin\MediaVideoController::class, 'store'])->name('MediaVideos.store');
        Route::delete('media_videos/{id}', [App\Http\Controllers\Admin\MediaVideoController::class, 'destroy'])->name('MediaVideos.destroy');
        Route::get('media_docs', [App\Http\Controllers\Admin\MediaDocsController::class, 'index'])->name('MediaDocs');
        Route::post('media_docs', [App\Http\Controllers\Admin\MediaDocsController::class, 'store'])->name('MediaDocs.store');
        Route::delete('media_docs/{id}', [App\Http\Controllers\Admin\MediaDocsController::class, 'destroy'])->name('MediaDocs.destroy');
        Route::get('reference_table', [RefTableController::class, 'index'])->name('RefTable');
        Route::post('reference_table', [RefTableController::class, 'store'])->name('RefTable.store');
        Route::get('reference_table/{id}/edit', [RefTableController::class, 'edit'])->name('RefTable.edit');
        Route::put('reference_table/{id}', [RefTableController::class, 'update'])->name('RefTable.update');
        Route::delete('reference_table/{id}', [RefTableController::class, 'destroy'])->name('RefTable.destroy');
        Route::get('general_documents', [GeneralDocumentController::class, 'index'])->name('GenralDocument');
        Route::post('general_documents', [GeneralDocumentController::class, 'store'])->name('GenralDocument.store');
        Route::delete('general_documents/{id}', [GeneralDocumentController::class, 'destroy'])->name('GeneralDocument.destroy');
        Route::get('product_documents', [App\Http\Controllers\Admin\ProductDocumentController::class, 'index'])->name('ProductDocument');
        Route::get('cutomer_service', [App\Http\Controllers\Admin\CustomerServiceController::class, 'index'])->name('cutomer_service');
        Route::post('customer_service', [App\Http\Controllers\Admin\CustomerServiceController::class, 'update'])->name('customer_service.update');
        Route::namespace('App\Http\Controllers\Admin\ProductTypeDocs')->group(function () {
            Route::get('booster_system_docs', 'BoosterdocsController@index')->name('BoosterDoc');
            Route::post('booster_system_docs', 'BoosterdocsController@store')->name('BoosterDoc.store');
            Route::delete('booster_system_docs/{id}', 'BoosterdocsController@destroy')->name('BoosterDoc.destroy');

            Route::get('control_panel_docs', 'ControlDocsController@index')->name('ControlDoc');
            Route::post('control_panel_docs', 'ControlDocsController@store')->name('ControlDoc.store');
            Route::delete('control_panel_docs/{id}', 'ControlDocsController@destroy')->name('ControlDoc.destroy');

            Route::get('norm_pump_docs', 'NormDocsController@index')->name('NormDoc');
            Route::post('norm_pump_docs', 'NormDocsController@store')->name('NormDoc.store');
            Route::delete('norm_pump_docs/{id}', 'NormDocsController@destroy')->name('NormDoc.destroy');

            Route::get('split_case_docs', 'SplitCaseDocsController@index')->name('SplitCaseDoc');
            Route::post('split_case_docs', 'SplitCaseDocsController@store')->name('SplitCaseDoc.store');
            Route::delete('split_case_docs/{id}', 'SplitCaseDocsController@destroy')->name('SplitCaseDoc.destroy');

            Route::get('helix_pump_docs', 'HelixDocsController@index')->name('HelixDoc');
            Route::post('helix_pump_docs', 'HelixDocsController@store')->name('HelixDoc.store');
            Route::delete('helix_pump_docs/{id}', 'HelixDocsController@destroy')->name('HelixDoc.destroy');

            Route::get('pump_motor_docs', 'PumpMotorDocsController@index')->name('PumpMotorDoc');
            Route::post('pump_motor_docs', 'PumpMotorDocsController@store')->name('PumpMotorDoc.store');
            Route::delete('pump_motor_docs/{id}', 'PumpMotorDocsController@destroy')->name('PumpMotorDoc.destroy');

            Route::get('borehole_docs', 'BoreoleDocsController@index')->name('BoreholeDoc');
            Route::post('borehole_docs', 'BoreoleDocsController@store')->name('BoreholeDoc.store');
            Route::delete('borehole_docs/{id}', 'BoreoleDocsController@destroy')->name('BoreholeDoc.destroy');

            Route::get('fire_docs', 'FireDocsController@index')->name('FireDoc');
            Route::post('fire_docs', 'FireDocsController@store')->name('FireDoc.store');
            Route::delete('fire_docs/{id}', 'FireDocsController@destroy')->name('FireDoc.destroy');
        });
    });

    // Sales Manager routes
    Route::group(['prefix' => 'sale_manager', 'middleware' => ['auth', CheckRoleMiddleware::class . ':Sales Manager']], function () {
        Route::get('dashboard', [SaleManagerController::class, 'dashboard'])->name('SaleManagerDashboard');
        Route::get('dubai_production', [SaleManagerController::class, 'dubai_production'])->name('SaleManagerDubaiProduction');
        Route::get('virtual_tour', [SaleManagerController::class, 'virtual_tour'])->name('SaleManagerVirtualTour');
        Route::get('request_training', [SaleManagerController::class, 'request_training'])->name('SaleManagerRequestTraining');
        Route::get('test_facility', [SaleManagerController::class, 'test_facility'])->name('SaleManagerTestFacility');
        Route::get('pricing_tool', [SaleManagerController::class, 'pricing_tool'])->name('SaleManagerPricingTool');
        Route::get('document_portal', [SaleManagerController::class, 'document_portal'])->name('SaleManagerDocumentPrortal');
        Route::get('certificate', [SaleManagerController::class, 'certificate'])->name('SaleManagerCertificate');
        Route::get('referance', [SaleManagerController::class, 'referance'])->name('SaleManagerReferance');
        Route::get('pre_qualification', [SaleManagerController::class, 'pre_qualification'])->name('SaleManagerPreQualification');
        Route::get('req_customer_service', [SaleManagerController::class, 'req_customer_service'])->name('SaleManagerReqCustomerService');
        Route::post('req_customer_service', [SaleManagerController::class, 'storeCustomerService'])->name('SaleManagerStoreCustomerService');
        Route::get('media_database', [SaleManagerController::class, 'media_database'])->name('SaleManagerMediaDatabase');
        Route::get('virtual_tour', [SaleManagerController::class, 'virtual_tour'])->name('SaleManagerVirtualTour');
        Route::get('orders_track', [SaleManagerController::class, 'orders_track'])->name('SaleManagerOrdersTrack');
        Route::get('booster_system/', [SaleManagerController::class, 'booster_system'])->name('SaleManagerBoosterSystem');
        Route::get('control_panel/', [SaleManagerController::class, 'control_panel'])->name('SaleManagerControlPanel');
        Route::get('norm_pump/', [SaleManagerController::class, 'norm_pump'])->name('SaleManagerNormPump');
        Route::get('split_case_pump/', [SaleManagerController::class, 'split_case_pump'])->name('SaleManagerSplitCasePump');
        Route::get('helix_pump/', [SaleManagerController::class, 'helix_pump'])->name('SaleManagerHelixPump');
        Route::get('pump_motor_alignment/', [SaleManagerController::class, 'pump_motor_alignment'])->name('SaleManagerPumpMotorAlignment');
        Route::get('borehole_pump/', [SaleManagerController::class, 'borehole_pump'])->name('SaleManagerBoreholePump');
        Route::get('fire_fighting/', [SaleManagerController::class, 'fire_fighting'])->name('SaleManagerFireFighting');
        Route::get('feedback_form/', [SaleManagerController::class, 'feedback_form'])->name('SaleManagerFeedbackForm');
        Route::get('general_documents', [GeneralDocumentUserController::class, 'index'])->name('GenralDocumentUser');
        Route::get('product_type_documents', [ProductTypeDocumentUserController::class, 'index'])->name('ProductTypeDocumentUser');
        Route::get('booster_docs', [ProductTypeDocumentUserController::class, 'booster_docs'])->name('booster_docs');
        Route::get('control_docs', [ProductTypeDocumentUserController::class, 'control_docs'])->name('control_docs');
        Route::get('norm_docs', [ProductTypeDocumentUserController::class, 'norm_docs'])->name('norm_docs');
        Route::get('split_case_docs', [ProductTypeDocumentUserController::class, 'split_case_docs'])->name('split_case_docs');
        Route::get('helix_docs', [ProductTypeDocumentUserController::class, 'helix_docs'])->name('helix_docs');
        Route::get('pump_motor_docs', [ProductTypeDocumentUserController::class, 'pump_motor_docs'])->name('pump_motor_docs');
        Route::get('borehole_docs', [ProductTypeDocumentUserController::class, 'borehole_docs'])->name('borehole_docs');
        Route::get('fire_docs', [ProductTypeDocumentUserController::class, 'fire_docs'])->name('fire_docs');
        Route::get('media_images', [MediaImgUserController::class, 'index'])->name('MediaImagesUser');
        Route::get('media_videos', [MediaVideoUserController::class, 'index'])->name('MediaVideosUser');
        Route::get('media_documents', [MediaDocsUserController::class, 'index'])->name('MediaDocsUser');
        Route::post('/training/store', [RequestTrainingController::class, 'store'])->name('training.store');
        Route::post('/validate-training', [RequestTrainingController::class, 'validateField'])->name('training.validate');
        Route::post('/witness/store', [WitnessFormController::class, 'store'])->name('witness.store');
        Route::post('/validate-witness', [WitnessFormController::class, 'validateField'])->name('witness.validate');
        Route::post('/test-facility/store', [TestFacilityController::class, 'store'])->name('testFacility.store');
        Route::get('/witness_test', [WitnessFormController::class, 'create'])->name('witness.create');
        Route::post('/feedback/validate', [FeedbackFormController::class, 'validateField'])->name('feedback.validate');
        Route::post('/feedback/store', [FeedbackFormController::class, 'store'])->name('feedback.store');
        Route::post('/witness/get-preferred-date', [WitnessFormController::class, 'getPreferredDate'])->name('witness.getPreferredDate');
        Route::post('/witness/check-duplicate', [WitnessFormController::class, 'checkDuplicate'])->name('witness.checkDuplicate');
        Route::post('/witness/check-capacity', [WitnessFormController::class, 'checkCapacity'])->name('witness.checkCapacity');
        Route::post('/witness/store-waiting-list', [WitnessFormController::class, 'storeWaitingList'])->name('witness.storeWaitingList');
        Route::post('/witness/check-waiting-list', [WitnessFormController::class, 'checkWaitingListDuplicate'])->name('witness.checkWaitingList');
    });

    // Common authenticated routes
    // Route::post('/training/store', [RequestTrainingController::class, 'store'])->name('training.store');
    // Route::post('/validate-training', [RequestTrainingController::class, 'validateField'])->name('training.validate');
    // Route::post('/witness/store', [WitnessFormController::class, 'store'])->name('witness.store');
    // Route::post('/validate-witness', [WitnessFormController::class, 'validateField'])->name('witness.validate');
    // Route::post('/test-facility/store', [TestFacilityController::class, 'store'])->name('testFacility.store');
    // Route::get('sale_manager/witness_test', [WitnessFormController::class, 'create'])->name('witness.create');
    // Route::post('/feedback/validate', [FeedbackFormController::class, 'validateField'])->name('feedback.validate');
    // Route::post('/feedback/store', [FeedbackFormController::class, 'store'])->name('feedback.store');


    // Route::namespace('App\Http\Controllers\Admin\ProductTypeDocs')->group(function () {
    //     Route::get('admin/booster_system_docs', 'BoosterdocsController@index')->name('BoosterDoc');
    //     Route::post('admin/booster_system_docs', 'BoosterdocsController@store')->name('BoosterDoc.store');
    //     Route::delete('admin/booster_system_docs/{id}', 'BoosterdocsController@destroy')->name('BoosterDoc.destroy');

    //     Route::get('admin/control_panel_docs', 'ControlDocsController@index')->name('ControlDoc');
    //     Route::post('admin/control_panel_docs', 'ControlDocsController@store')->name('ControlDoc.store');
    //     Route::delete('admin/control_panel_docs/{id}', 'ControlDocsController@destroy')->name('ControlDoc.destroy');

    //     Route::get('admin/norm_pump_docs', 'NormDocsController@index')->name('NormDoc');
    //     Route::post('admin/norm_pump_docs', 'NormDocsController@store')->name('NormDoc.store');
    //     Route::delete('admin/norm_pump_docs/{id}', 'NormDocsController@destroy')->name('NormDoc.destroy');

    //     Route::get('admin/split_case_docs', 'SplitCaseDocsController@index')->name('SplitCaseDoc');
    //     Route::post('admin/split_case_docs', 'SplitCaseDocsController@store')->name('SplitCaseDoc.store');
    //     Route::delete('admin/split_case_docs/{id}', 'SplitCaseDocsController@destroy')->name('SplitCaseDoc.destroy');

    //     Route::get('admin/helix_pump_docs', 'HelixDocsController@index')->name('HelixDoc');
    //     Route::post('admin/helix_pump_docs', 'HelixDocsController@store')->name('HelixDoc.store');
    //     Route::delete('admin/helix_pump_docs/{id}', 'HelixDocsController@destroy')->name('HelixDoc.destroy');

    //     Route::get('admin/pump_motor_docs', 'PumpMotorDocsController@index')->name('PumpMotorDoc');
    //     Route::post('admin/pump_motor_docs', 'PumpMotorDocsController@store')->name('PumpMotorDoc.store');
    //     Route::delete('admin/pump_motor_docs/{id}', 'PumpMotorDocsController@destroy')->name('PumpMotorDoc.destroy');

    //     Route::get('admin/borehole_docs', 'BoreoleDocsController@index')->name('BoreholeDoc');
    //     Route::post('admin/borehole_docs', 'BoreoleDocsController@store')->name('BoreholeDoc.store');
    //     Route::delete('admin/borehole_docs/{id}', 'BoreoleDocsController@destroy')->name('BoreholeDoc.destroy');

    //     Route::get('admin/fire_docs', 'FireDocsController@index')->name('FireDoc');
    //     Route::post('admin/fire_docs', 'FireDocsController@store')->name('FireDoc.store');
    //     Route::delete('admin/fire_docs/{id}', 'FireDocsController@destroy')->name('FireDoc.destroy');
    // });
});

// Keep the optimize route outside of the auth middleware if it's meant to be publicly accessible
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>Reoptimized class loader</h1>';
});
Route::get('/test-route', function () {
    return response()->json(['message' => 'Test route is working']);
});
