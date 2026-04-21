<?php

namespace App\Http\Controllers\SaleManager;

use App\Models\AdminSetting;
use Illuminate\Support\Facades\Mail;
use App\Models\Team;
use App\Models\SaleManagerDashboard;
use App\Models\User;
use App\Models\CustomerService;
use App\Mail\ContactUsMail;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use App\Models\TestFacilitySetting;
use Illuminate\Support\Facades\Log;
use App\Models\ProductButton;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamAboutDubai;
use App\Models\TeamTestFacility;
use App\Models\RefTable;
use App\Models\ProductType;
use App\Models\ProductButtonTestFacility;

class SaleManagerController extends Controller
{
    public function dashboard()
    {
        $page_title = "";
        $video = SaleManagerDashboard::where('section', 'Video')->value('value');
        $pricingToolLink = SaleManagerDashboard::where('section', 'PricingToolLink')->value('value');
        $orderTrackLink = SaleManagerDashboard::where('section', 'OrderTrackLink')->value('value');
        $RefenceTablelink = SaleManagerDashboard::where('section', 'ReferenceTableLink')->value('value');
        $menuimage1 = SaleManagerDashboard::where('section', 'menuimg1')->value('value');
        $menuimage2 = SaleManagerDashboard::where('section', 'menuimg2')->value('value');
        $menuimage3 = SaleManagerDashboard::where('section', 'menuimg3')->value('value');
        $menuimage4 = SaleManagerDashboard::where('section', 'menuimg4')->value('value');
        $menuimage5 = SaleManagerDashboard::where('section', 'menuimg5')->value('value');
        $menuimage6 = SaleManagerDashboard::where('section', 'menuimg6')->value('value');
        $menuimage7 = SaleManagerDashboard::where('section', 'menuimg7')->value('value');
        $menuimage8 = SaleManagerDashboard::where('section', 'menuimg8')->value('value');
        $menuimage9 = SaleManagerDashboard::where('section', 'menuimg9')->value('value');
        $menuimage10 = SaleManagerDashboard::where('section', 'menuimg10')->value('value');
        $menuimage11 = SaleManagerDashboard::where('section', 'menuimg11')->value('value');
        $menuimage12 = SaleManagerDashboard::where('section', 'menuimg12')->value('value');
        $menulable1 = SaleManagerDashboard::where('section', 'menulable1')->value('value');
        $menulable2 = SaleManagerDashboard::where('section', 'menulable2')->value('value');
        $menulable3 = SaleManagerDashboard::where('section', 'menulable3')->value('value');
        $menulable4 = SaleManagerDashboard::where('section', 'menulable4')->value('value');
        $menulable5 = SaleManagerDashboard::where('section', 'menulable5')->value('value');
        $menulable6 = SaleManagerDashboard::where('section', 'menulable6')->value('value');
        $menulable7 = SaleManagerDashboard::where('section', 'menulable7')->value('value');
        $menulable8 = SaleManagerDashboard::where('section', 'menulable8')->value('value');
        $menulable9 = SaleManagerDashboard::where('section', 'menulable9')->value('value');
        $menulable10 = SaleManagerDashboard::where('section', 'menulable10')->value('value');
        $menulable11 = SaleManagerDashboard::where('section', 'menulable11')->value('value');
        $menulable12 = SaleManagerDashboard::where('section', 'menulable12')->value('value');



        return view('sale_manager.dashboard', compact('page_title', 'video', 'pricingToolLink', 'orderTrackLink', 'RefenceTablelink', 'menuimage1', 'menuimage2', 'menuimage3', 'menuimage4', 'menuimage5', 'menuimage6', 'menuimage7', 'menuimage8', 'menuimage9', 'menuimage10', 'menuimage11', 'menuimage12', 'menulable1',  'menulable2', 'menulable3', 'menulable4', 'menulable5', 'menulable6', 'menulable7', 'menulable8', 'menulable9', 'menulable10', 'menulable11', 'menulable12'));
    }

    public function dubai_production()
    {
        $productButtons = ProductButton::all();
        $page_title = AdminSetting::where('section_name', 'banner')->value('lable');
        $paragraph_content = AdminSetting::where('sub_title', 'paragraph')->value('value');
        $banner_image = AdminSetting::where('section_name', 'banner')->value('value');
        $sub_heading_1 = AdminSetting::where('sub_title', 'sub_heading_1')->value('value');
        $sub_para_1 = AdminSetting::where('sub_title', 'sub_para_1')->value('value');
        $location_image = AdminSetting::where('sub_title', 'image_1')->value('value');
        $sub_heading_2 = AdminSetting::where('sub_title', 'sub_heading_2')->value('value');
        $sub_para_2 = AdminSetting::where('sub_title', 'sub_para_2')->value('value');
        $pump_test_1 = AdminSetting::where('sub_title', 'pump_test_1')->value('value');
        $pump_test_2 = AdminSetting::where('sub_title', 'pump_test_2')->value('value');
        $sub_heading_3 = AdminSetting::where('sub_title', 'sub_heading_3')->value('value');
        $sub_para_3 = AdminSetting::where('sub_title', 'sub_para_3')->value('value');
        $location_link = AdminSetting::where('sub_title', 'location_link')->value('value');

        $commitment_img = AdminSetting::where('sub_title', 'commitment_img')->value('value');
        $sub_heading_4 = AdminSetting::where('sub_title', 'sub_heading_4')->value('value');
        $sub_para_4 = AdminSetting::where('sub_title', 'sub_para_4')->value('value');
        $commitment_button_1 = AdminSetting::where('sub_title', 'commitment_button_1')->value('value');
        $commitment_button_2 = AdminSetting::where('sub_title', 'commitment_button_2')->value('value');
        $sub_heading_5 = AdminSetting::where('sub_title', 'sub_heading_5')->value('value');
        $sub_para_5 = AdminSetting::where('sub_title', 'sub_para_5')->value('value');
        $button_1 = AdminSetting::where('sub_title', 'sustainability_button_1')->value('value');
        $button_2 = AdminSetting::where('sub_title', 'sustainability_button_2')->value('value');
        $button_3 = AdminSetting::where('sub_title', 'sustainability_button_3')->value('value');
        $button_4 = AdminSetting::where('sub_title', 'sustainability_button_4')->value('value');
        $button_5 = AdminSetting::where('sub_title', 'sustainability_button_5')->value('value');
        $button_6 = AdminSetting::where('sub_title', 'sustainability_button_6')->value('value');
        $sub_heading_6 = AdminSetting::where('sub_title', 'sub_heading_6')->value('value');
        $sub_para_6 = AdminSetting::where('sub_title', 'sub_para_6')->value('value');
        $sub_heading_7 = AdminSetting::where('sub_title', 'sub_heading_7')->value('value');
        $sub_para_7 = AdminSetting::where('sub_title', 'sub_para_7')->value('value');
        $success_stories_1_heading = AdminSetting::where('sub_title', 'success_stories_1_heading')->value('value');
        $success_stories_2_heading = AdminSetting::where('sub_title', 'success_stories_2_heading')->value('value');
        $success_stories_3_heading = AdminSetting::where('sub_title', 'success_stories_3_heading')->value('value');

        $success_stories_image_1 = AdminSetting::where('sub_title', 'success_stories_image_1')->value('value');
        $success_stories_image_2 = AdminSetting::where('sub_title', 'success_stories_image_2')->value('value');
        $success_stories_image_3 = AdminSetting::where('sub_title', 'success_stories_image_3')->value('value');

        $currentISO45001Document = AdminSetting::where('sub_title', 'ISO_45001_document')->value('value');
        $currentISO9001Document = AdminSetting::where('sub_title', 'ISO_9001_document')->value('value');
        $currentsustainability_document_1 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_1')->value('value');
        $currentsustainability_document_2 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_2')->value('value');
        $currentsustainability_document_3 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_3')->value('value');
        $currentsustainability_document_4 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_4')->value('value');
        $currentsustainability_document_5 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_5')->value('value');
        $currentsustainability_document_6 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_6')->value('value');

        // $members = TeamAboutDubai::orderBy('id', 'desc')->get();
        $members = TeamAboutDubai::orderBy('sort_order', 'asc')->get();

        return view('sale_manager.dubai_production', compact('page_title', 'paragraph_content', 'banner_image', 'sub_heading_1', 'sub_para_1', 'location_image', 'sub_heading_2', 'sub_para_2', 'pump_test_1', 'pump_test_2', 'sub_heading_3', 'sub_para_3', 'commitment_img', 'sub_heading_4', 'sub_para_4', 'sub_heading_5', 'sub_para_5', 'button_1', 'button_2', 'button_3', 'button_4', 'button_5', 'button_6', 'sub_heading_6', 'sub_para_6', 'sub_heading_7', 'sub_para_7', 'members', 'success_stories_1_heading', 'success_stories_2_heading', 'success_stories_3_heading', 'success_stories_image_1', 'success_stories_image_2', 'success_stories_image_3', 'commitment_button_1', 'commitment_button_2', 'productButtons', 'currentISO45001Document', 'currentISO9001Document', 'currentsustainability_document_1', 'currentsustainability_document_2', 'currentsustainability_document_3', 'currentsustainability_document_4', 'currentsustainability_document_5', 'currentsustainability_document_6', 'location_link'));
    }
    public function virtual_tour()
    {
        $page_title = "";
        $currentBannerImage = AdminSetting::where('section_name', 'banner')->where('lable', 'Virtual Tour')->value('value');
        $currentBannerLabel = AdminSetting::where('section_name', 'banner')->where('lable', 'Virtual Tour')->value('sub_title');
        return view('sale_manager.virtual_tour', compact('page_title', 'currentBannerImage', 'currentBannerLabel'));
    }
    public function request_training()
    {
        $page_title = "";
        return view('sale_manager.request_training', compact('page_title'));
    }
    public function witness_test()
    {
        $page_title = "";
        return view('sale_manager.witness_test', compact('page_title'));
    }
    public function test_facility()
    {
        $page_title = TestFacilitySetting::where('section_name', 'banner')->value('lable');
        $paragraph_content = TestFacilitySetting::where('sub_title', 'paragraph')->value('value');
        $banner_image = TestFacilitySetting::where('section_name', 'banner')->value('value');
        $sub_heading_1 = TestFacilitySetting::where('sub_title', 'sub_heading_1')->value('value');
        $sub_para_1 = TestFacilitySetting::where('sub_title', 'sub_para_1')->value('value');
        $location_image = TestFacilitySetting::where('sub_title', 'image_1')->value('value');
        $sub_heading_2 = TestFacilitySetting::where('sub_title', 'sub_heading_2')->value('value');
        $sub_para_2 = TestFacilitySetting::where('sub_title', 'sub_para_2')->value('value');
        $pump_test_1 = TestFacilitySetting::where('sub_title', 'pump_test_1')->value('value');
        $pump_test_2 = TestFacilitySetting::where('sub_title', 'pump_test_2')->value('value');
        $sub_heading_3 = TestFacilitySetting::where('sub_title', 'sub_heading_3')->value('value');
        $sub_para_3 = TestFacilitySetting::where('sub_title', 'sub_para_3')->value('value');
        $tab_1 = TestFacilitySetting::where('sub_title', 'tab_1')->value('value');
        $tab_2 = TestFacilitySetting::where('sub_title', 'tab_2')->value('value');
        $tab_3 = TestFacilitySetting::where('sub_title', 'tab_3')->value('value');
        $tab_4 = TestFacilitySetting::where('sub_title', 'tab_4')->value('value');
        $tab_5 = TestFacilitySetting::where('sub_title', 'tab_5')->value('value');
        $tab_6 = TestFacilitySetting::where('sub_title', 'tab_6')->value('value');
        $tab_7 = TestFacilitySetting::where('sub_title', 'tab_7')->value('value');
        $tab_8 = TestFacilitySetting::where('sub_title', 'tab_8')->value('value');
        $commitment_img = TestFacilitySetting::where('sub_title', 'commitment_img')->value('value');
        $sub_heading_4 = TestFacilitySetting::where('sub_title', 'sub_heading_4')->value('value');
        $sub_para_4 = TestFacilitySetting::where('sub_title', 'sub_para_4')->value('value');
        $commitment_button_1 = TestFacilitySetting::where('sub_title', 'commitment_button_1')->value('value');
        $commitment_button_2 = TestFacilitySetting::where('sub_title', 'commitment_button_2')->value('value');
        $sub_heading_5 = TestFacilitySetting::where('sub_title', 'sub_heading_5')->value('value');
        $sub_para_5 = TestFacilitySetting::where('sub_title', 'sub_para_5')->value('value');
        $button_1 = TestFacilitySetting::where('sub_title', 'sustainability_button_1')->value('value');
        $button_2 = TestFacilitySetting::where('sub_title', 'sustainability_button_2')->value('value');
        $button_3 = TestFacilitySetting::where('sub_title', 'sustainability_button_3')->value('value');
        $button_4 = TestFacilitySetting::where('sub_title', 'sustainability_button_4')->value('value');
        $button_5 = TestFacilitySetting::where('sub_title', 'sustainability_button_5')->value('value');
        $button_6 = TestFacilitySetting::where('sub_title', 'sustainability_button_6')->value('value');
        $sub_heading_6 = TestFacilitySetting::where('sub_title', 'sub_heading_6')->value('value');
        $sub_para_6 = TestFacilitySetting::where('sub_title', 'sub_para_6')->value('value');
        $sub_heading_7 = TestFacilitySetting::where('sub_title', 'sub_heading_7')->value('value');
        $sub_para_7 = TestFacilitySetting::where('sub_title', 'sub_para_7')->value('value');
        $success_stories_1_heading = TestFacilitySetting::where('sub_title', 'success_stories_1_heading')->value('value');
        $success_stories_2_heading = TestFacilitySetting::where('sub_title', 'success_stories_2_heading')->value('value');
        $success_stories_3_heading = TestFacilitySetting::where('sub_title', 'success_stories_3_heading')->value('value');

        $success_stories_image_1 = TestFacilitySetting::where('sub_title', 'success_stories_image_1')->value('value');
        $success_stories_image_2 = TestFacilitySetting::where('sub_title', 'success_stories_image_2')->value('value');
        $success_stories_image_3 = TestFacilitySetting::where('sub_title', 'success_stories_image_3')->value('value');
        // Fetch all the necessary data
        $currentBannerImage = TestFacilitySetting::where('section_name', 'banner')->value('value');
        $currentBannerLabel = TestFacilitySetting::where('section_name', 'banner')->value('lable');
        $currentInitialParagraph = TestFacilitySetting::where('section_name', 'initial_paragraph')->value('value');
        $currentLocationHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_1')->value('value');
        $currentLocationParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_1')->value('value');
        $currentLocationImage = TestFacilitySetting::where('section_name', 'image')->where('sub_title', 'image_1')->value('value');
        $currentPumpFacilityHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_2')->value('value');
        $currentPumpFacilityParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_2')->value('value');
        $currentTestingFacilityImage1 = TestFacilitySetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_1')->value('value');
        $currentTestingFacilityImage2 = TestFacilitySetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_2')->value('value');
        $currentProductRangeHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_3')->value('value');
        $currentProductRangeParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_3')->value('value');
        $productButtons = ProductButtonTestFacility::all();
        $currentQualityHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_4')->value('value');
        $currentQualityParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_4')->value('value');
        $currentQualityImage = TestFacilitySetting::where('section_name', 'Commitment')->where('sub_title', 'commitment_img')->value('value');
        $currentISO9001Document = TestFacilitySetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_9001_document')->value('value');
        $currentISO45001Document = TestFacilitySetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_45001_document')->value('value');
        $currentSustainabilityHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_5')->value('value');
        $currentSustainabilityParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_5')->value('value');
        $currentsustainability_button_1 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_1')->value('value');
        $currentsustainability_button_2 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_2')->value('value');
        $currentsustainability_button_3 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_3')->value('value');
        $currentsustainability_button_4 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_4')->value('value');
        $currentsustainability_button_5 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_5')->value('value');
        $currentsustainability_button_6 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_6')->value('value');
        $currentsustainability_document_1 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_1')->value('value');
        $currentsustainability_document_2 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_2')->value('value');
        $currentsustainability_document_3 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_3')->value('value');
        $currentsustainability_document_4 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_4')->value('value');
        $currentsustainability_document_5 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_5')->value('value');
        $currentsustainability_document_6 = TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_6')->value('value');
        $currentTeamHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_6')->value('value');
        $currentTeamParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_6')->value('value');
        
        $countries = country::all();
        $currentInnovaionHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_7')->value('value');
        $currentInnovaionParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_7')->value('value');
        $currentSuccessStory_image_1 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_1')->value('value');
        $currentSuccessStory_image_2 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_2')->value('value');
        $currentSuccessStory_image_3 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_3')->value('value');
        $location_link = TestFacilitySetting::where('sub_title', 'location_link')->value('value');

        // $members = TeamTestFacility::orderBy('id', 'desc')->get();
        $members = TeamTestFacility::orderBy('sort_order', 'asc')->get();


        return view('sale_manager.test_facility', compact(
            'page_title',
            'paragraph_content',
            'banner_image',
            'sub_heading_1',
            'sub_para_1',
            'location_image',
            'sub_heading_2',
            'sub_para_2',
            'pump_test_1',
            'pump_test_2',
            'sub_heading_3',
            'sub_para_3',
            'tab_1',
            'tab_2',
            'tab_3',
            'tab_4',
            'tab_5',
            'tab_6',
            'tab_7',
            'tab_8',
            'commitment_img',
            'sub_heading_4',
            'sub_para_4',
            'sub_heading_5',
            'sub_para_5',
            'button_1',
            'button_2',
            'button_3',
            'button_4',
            'button_5',
            'button_6',
            'sub_heading_6',
            'sub_para_6',
            'sub_heading_7',
            'sub_para_7',
            'members',
            'success_stories_1_heading',
            'success_stories_2_heading',
            'success_stories_3_heading',
            'success_stories_image_1',
            'success_stories_image_2',
            'success_stories_image_3',
            'commitment_button_1',
            'commitment_button_2',
            'currentBannerImage',
            'currentBannerLabel',
            'currentInitialParagraph',
            'currentLocationHeading',
            'currentLocationParagraph',
            'currentLocationImage',
            'currentPumpFacilityHeading',
            'currentPumpFacilityParagraph',
            'currentTestingFacilityImage1',
            'currentTestingFacilityImage2',
            'currentProductRangeHeading',
            'currentProductRangeParagraph',
            'productButtons',
            'currentQualityHeading',
            'currentQualityParagraph',
            'currentQualityImage',
            'currentISO9001Document',
            'currentISO45001Document',
            'currentSustainabilityHeading',
            'currentSustainabilityParagraph',
            'currentsustainability_button_1',
            'currentsustainability_button_2',
            'currentsustainability_button_3',
            'currentsustainability_button_4',
            'currentsustainability_button_5',
            'currentsustainability_button_6',
            'currentsustainability_document_1',
            'currentsustainability_document_2',
            'currentsustainability_document_3',
            'currentsustainability_document_4',
            'currentsustainability_document_5',
            'currentsustainability_document_6',
            'currentTeamHeading',
            'currentTeamParagraph',
            
            'countries',
            'currentInnovaionHeading',
            'currentInnovaionParagraph',
            'currentSuccessStory_image_1',
            'currentSuccessStory_image_2',
            'currentSuccessStory_image_3',
            'location_link'
        ));
    }
    public function pricing_tool()
    {
        $page_title = "";
        return view('sale_manager.pricing_tool', compact('page_title'));
    }
    public function document_portal()
    {
        $page_title = "";
        return view('sale_manager.document_portal', compact('page_title'));
    }
    public function certificate()
    {
        $page_title = "";
        return view('sale_manager.certificate', compact('page_title'));
    }
    public function referance()
    {
        $page_title = "";
        $countries = Country::orderBy('country_name', 'asc')->get(); // Fetch all countries in alphabetical order
        $Products = ProductType::all();
        $projects = RefTable::orderBy('created_at', 'desc')->get(); // Fetch all saved projects in descending order
        return view('sale_manager.referance', compact('page_title', 'Products', 'projects'));
    }
    public function pre_qualification()
    {
        $page_title = "";
        return view('sale_manager.pre_qualification', compact('page_title'));
    }
    public function req_customer_service()
    {
        $email = ContactUs::where('section', 'email')->value('value');
        $phone = ContactUs::where('section', 'contact_number')->value('value');
        $page_title = "";
        return view('sale_manager.req_customer_service', compact('page_title', 'email', 'phone'));
    }
    public function storeCustomerService(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Prepare email data
        $emailData = [
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];

        // Retrieve the recipient email from the ContactUs table
        $recipientEmail = ContactUs::where('section', 'email')->value('value');

        if ($recipientEmail) {
            // Send email
            Mail::to($recipientEmail)->send(new ContactUsMail($emailData));
        }

        // Create a new customer service record
        CustomerService::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Redirect back with a success message
        return redirect()->route('SaleManagerReqCustomerService')->with('success', 'We’ve received your message and will reach out to you soon.');
    }
    public function media_database()
    {
        $page_title = "";

        return view('sale_manager.media_database', compact('page_title'));
    }
    public function orders_track()
    {
        $page_title = "";
        return view('sale_manager.orders_track', compact('page_title'));
    }
    public function booster_system()
    {
        $page_title = AdminSetting::where('section_name', 'banner')->where('lable', 'Booster System')->value('lable');
        $banner_image = AdminSetting::where('section_name', 'banner')->where('lable', 'Booster System')->value('value');

        return view('sale_manager.dubai_production.booster_system', compact('page_title', 'banner_image'));
    }
    public function control_panel()
    {
        $page_title = AdminSetting::where('section_name', 'banner')->where('lable', 'Control Planel')->value('lable');
        $banner_image = AdminSetting::where('section_name', 'banner')->where('lable', 'Control Planel')->value('value');

        return view('sale_manager.dubai_production.booster_system', compact('page_title', 'banner_image'));
    }
    public function norm_pump()
    {
        $page_title = AdminSetting::where('section_name', 'banner')->where('lable', 'Norm Pump')->value('lable');
        $banner_image = AdminSetting::where('section_name', 'banner')->where('lable', 'Norm Pump')->value('value');

        return view('sale_manager.dubai_production.norm_pump', compact('page_title', 'banner_image'));
    }
    public function split_case_pump()
    {
        $page_title = AdminSetting::where('section_name', 'banner')->where('lable', 'Split-Case Pump')->value('lable');
        $banner_image = AdminSetting::where('section_name', 'banner')->where('lable', 'Split-Case Pump')->value('value');

        return view('sale_manager.dubai_production.split_case_pump', compact('page_title', 'banner_image'));
    }
    public function helix_pump()
    {
        $page_title = AdminSetting::where('section_name', 'banner')->where('lable', 'Helix Pump')->value('lable');
        $banner_image = AdminSetting::where('section_name', 'banner')->where('lable', 'Helix Pump')->value('value');

        return view('sale_manager.dubai_production.helix_pump', compact('page_title', 'banner_image'));
    }
    public function pump_motor_alignment()
    {
        $page_title = AdminSetting::where('section_name', 'banner')->where('lable', 'Pump-Motor Alignment')->value('lable');
        $banner_image = AdminSetting::where('section_name', 'banner')->where('lable', 'Pump-Motor Alignment')->value('value');

        return view('sale_manager.dubai_production.pump_motor_alignment', compact('page_title', 'banner_image'));
    }
    public function borehole_pump()
    {
        $page_title = AdminSetting::where('section_name', 'banner')->where('lable', 'Borehole Pump')->value('lable');
        $banner_image = AdminSetting::where('section_name', 'banner')->where('lable', 'Borehole Pump')->value('value');

        return view('sale_manager.dubai_production.borehole_pump', compact('page_title', 'banner_image'));
    }
    public function fire_fighting()
    {
        $page_title = AdminSetting::where('section_name', 'banner')->where('lable', 'Fire Fighting')->value('lable');
        $banner_image = AdminSetting::where('section_name', 'banner')->where('lable', 'Fire Fighting')->value('value');

        return view('sale_manager.dubai_production.fire_fighting', compact('page_title', 'banner_image'));
    }
    public function feedback_form()
    {
        $page_title = "";
        return view('sale_manager.feedback_form', compact('page_title'));
    }
}
