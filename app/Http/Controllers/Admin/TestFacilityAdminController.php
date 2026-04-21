<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use App\Models\TeamTestFacility;
use App\Models\TestFacilitySetting;
use Illuminate\Support\Facades\Log;
use App\Models\ProductButtonTestFacility;


class TestFacilityAdminController extends Controller
{
    public function index()
    {
        $page_title = "Test Facility";
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/test_facility'],
        ];
        // Retrieve current settings from the database
        $currentBannerImage = TestFacilitySetting::where('section_name', 'banner')->value('value');
        $currentBannerLabel = TestFacilitySetting::where('section_name', 'banner')->value('lable');
        $currentInitialParagraph = TestFacilitySetting::where('section_name', 'initial_paragraph')->value('value');
        // Retrieve location settings
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
        //
        // $members = TeamTestFacility::orderBy('id', 'desc')->get();
        $members = TeamTestFacility::orderBy('sort_order', 'asc')->get();
        //
        $currentInnovaionHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_7')->value('value');
        $currentInnovaionParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_7')->value('value');
        $currentSuccessStory_image_1 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_1')->value('value');
        $currentSuccessStory_image_2 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_2')->value('value');
        $currentSuccessStory_image_3 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_3')->value('value');
        $currentLocationLink = TestFacilitySetting::where('sub_title', 'location_link')->value('value');

        return view('Admin.test_facility', compact(
            'page_title',
            'sidebar_active',
            'bread_crumbs',
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
            'members',
            'currentInnovaionHeading',
            'currentInnovaionParagraph',
            'currentSuccessStory_image_1',
            'currentSuccessStory_image_2',
            'currentSuccessStory_image_3',
            'currentLocationLink'
        ));
    }
    public function updateBannerImage1(Request $request)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'banner_label' => 'nullable|string',
            'initial_paragraph' => 'nullable|string',  // Adjust max length as needed
        ]);

        // Process the banner image upload
        $destinationPath = public_path('sales_manager/banner');
        $imageName = null;

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
        }

        // Update the banner image and label
        TestFacilitySetting::where('section_name', 'banner')->update([
            'value' => $imageName ?: TestFacilitySetting::where('section_name', 'banner')->value('value'),
            'lable' => $request->input('banner_label'),
        ]);

        // Update the initial paragraph section value
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'initial_paragraph'],
            ['value' => $request->input('initial_paragraph')]
        );

        return redirect()->back()->with('success', 'Settings changed successfully.');
    }
    public function updateLocation1(Request $request)
    {
        $request->validate([
            'location_heading' => 'nullable|string',
            'location_paragraph' => 'nullable|string',
            'location_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Process the location image upload
        $destinationPathImage = public_path('sales_manager/images');
        $imageName = null;



        if ($request->hasFile('location_image')) {
            $image = $request->file('location_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPathImage, $imageName);
        }

        // Update the location heading
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_1'],
            ['value' => $request->input('location_heading')]
        );

        // Update the location paragraph
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_1'],
            ['value' => $request->input('location_paragraph')]
        );

        // Update the location Link
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'location', 'sub_title' => 'location_link'],
            ['value' => $request->input('location_link')]
        );

        // Update the location image
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'image', 'sub_title' => 'image_1'],
            ['value' => $imageName ?: TestFacilitySetting::where('section_name', 'image')->where('sub_title', 'image_1')->value('value')]
        );

        return redirect()->back()->with('success', 'Location section updated successfully.');
    }
    public function updatePumpTestingFacility1(Request $request)
    {
        $request->validate([
            'pump_facility_heading' => 'nullable|string',
            'pump_facility_paragraph' => 'nullable|string',
            'testing_facility_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'testing_facility_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Process the first image upload
        $destinationPath = public_path('sales_manager/images');
        $imageName1 = null;
        $imageName2 = null;

        if ($request->hasFile('testing_facility_image_1')) {
            $image1 = $request->file('testing_facility_image_1');
            $imageName1 = time() . '_1.' . $image1->getClientOriginalExtension();
            $image1->move($destinationPath, $imageName1);
        }

        if ($request->hasFile('testing_facility_image_2')) {
            $image2 = $request->file('testing_facility_image_2');
            $imageName2 = time() . '_2.' . $image2->getClientOriginalExtension();
            $image2->move($destinationPath, $imageName2);
        }

        // Update the heading
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_2'],
            ['value' => $request->input('pump_facility_heading')]
        );

        // Update the paragraph
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_2'],
            ['value' => $request->input('pump_facility_paragraph')]
        );

        // Update the first image
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'pump_test', 'sub_title' => 'pump_test_1'],
            ['value' => $imageName1 ?: TestFacilitySetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_1')->value('value')]
        );

        // Update the second image
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'pump_test', 'sub_title' => 'pump_test_2'],
            ['value' => $imageName2 ?: TestFacilitySetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_2')->value('value')]
        );

        return redirect()->back()->with('success', 'Pump Testing Facility section updated successfully.');
    }
    public function updateProductRange1(Request $request)
    {
        $request->validate([
            'Product_range_heading' => 'nullable|string',
            'Product_range_paragraph' => 'nullable|string',
            'button_text.*' => 'nullable|string',
            'button_link.*' => 'nullable|url',
        ]);

        // Update the heading and paragraph
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_3'],
            ['value' => $request->input('Product_range_heading')]
        );

        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_3'],
            ['value' => $request->input('Product_range_paragraph')]
        );

        // Clear existing product buttons to avoid duplication
        ProductButtonTestFacility::truncate();

        // Save the button labels and links
        if ($request->filled('button_text') && $request->filled('button_link')) {
            foreach ($request->input('button_text') as $index => $text) {
                if (!empty($text) && !empty($request->input('button_link')[$index])) {
                    ProductButtonTestFacility::create([
                        'button_text' => $text,
                        'button_link' => $request->input('button_link')[$index],
                    ]);
                }
            }
        }

        // After saving, redirect back with success message and with the updated buttons
        return redirect()->action([self::class, 'showProductRangeForm1'])->with('success', 'Product Range section updated successfully.');
    }
    public function showProductRangeForm1()
    {
        $page_title = "Test Facility";
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/test_facility'],
        ];

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
        $members = TeamTestFacility::orderBy('id', 'desc')->get();
        $currentInnovaionHeading = TestFacilitySetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_7')->value('value');
        $currentInnovaionParagraph = TestFacilitySetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_7')->value('value');
        $currentSuccessStory_image_1 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_1')->value('value');
        $currentSuccessStory_image_2 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_2')->value('value');
        $currentSuccessStory_image_3 = TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_3')->value('value');
        $currentLocationLink = TestFacilitySetting::where('sub_title', 'location_link')->value('value');

        return redirect()->route('TestFacility')->with('success', 'Product range section updated successfully');
    }
    public function updateQuality1(Request $request)
    {
        $request->validate([
            'quality_heading' => 'nullable|string',
            'quality_paragraph' => 'nullable|string',
            'quality_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'ISO_45001_document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'ISO_9001_document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt'
        ]);

        // Process the Quality image upload
        $destinationPath = public_path('sales_manager/images');
        $destinationPathDocument = public_path('sales_manager/documents');
        $imageName = null;
        $ISO9001DocumentName = null;
        $ISO45001DocumentName = null;

        if ($request->hasFile('ISO_45001_document')) {
            $ISO45001Document = $request->file('ISO_45001_document');
            $ISO45001DocumentName = date('d-m-y_H:i') . '.' . $ISO45001Document->getClientOriginalExtension();
            $ISO45001Document->move($destinationPathDocument, $ISO45001DocumentName);
        }

        if ($request->hasFile('ISO_9001_document')) {
            $ISO9001Document = $request->file('ISO_9001_document');
            $ISO9001DocumentName = date('d-m-y_H:i') . '.' . $ISO9001Document->getClientOriginalExtension();
            $ISO9001Document->move($destinationPathDocument, $ISO9001DocumentName);
        }

        // Update the ISO 9001 document
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'Commitment', 'sub_title' => 'ISO_9001_document'],
            ['value' => $ISO9001DocumentName ?: TestFacilitySetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_9001_document')->value('value')]
        );

        if ($request->hasFile('quality_image')) {
            $image = $request->file('quality_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
        }

        // Update the Quality image
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'Commitment', 'sub_title' => 'commitment_img'],
            ['value' => $imageName ?: TestFacilitySetting::where('section_name', 'Commitment')->where('sub_title', 'commitment_img')->value('value')]
        );

        // Update the Quality heading
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_4'],
            ['value' => $request->input('quality_heading')]
        );

        // Update the Quality paragraph
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_4'],
            ['value' => $request->input('quality_paragraph')]
        );

        // Update the ISO 45001 document
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'Commitment', 'sub_title' => 'ISO_45001_document'],
            ['value' => $ISO45001DocumentName ?: TestFacilitySetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_45001_document')->value('value')]
        );

        return redirect()->back()->with('success', 'Quality section updated successfully.');
    }

    public function updateSustainability1(Request $request)
    {
        $request->validate([
            'sustainability_heading' => 'nullable|string',
            'sustainability_paragraph' => 'nullable|string',
            'sustainability_button_1_lable' => 'nullable|string',
            'sustainability_button_2_lable' => 'nullable|string',
            'sustainability_button_3_lable' => 'nullable|string',
            'sustainability_button_4_lable' => 'nullable|string',
            'sustainability_button_5_lable' => 'nullable|string',
            'sustainability_button_6_lable' => 'nullable|string',
            'sustainability_document_1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_3' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_4' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_5' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_6' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt'
        ]);

        $destinationPathDocument = public_path('sales_manager/documents');
        $sustainability_document_1_Name = null;
        $sustainability_document_2_Name = null;
        $sustainability_document_3_Name = null;
        $sustainability_document_4_Name = null;
        $sustainability_document_5_Name = null;
        $sustainability_document_6_Name = null;


        if ($request->hasFile('sustainability_document_1')) {
            $sustainability_document_1 = $request->file('sustainability_document_1');
            $sustainability_document_1_Name = date('d-m-y_H:i') . '.' . $sustainability_document_1->getClientOriginalExtension();
            $sustainability_document_1->move($destinationPathDocument, $sustainability_document_1_Name);
        }
        if ($request->hasFile('sustainability_document_2')) {
            $sustainability_document_2 = $request->file('sustainability_document_2');
            $sustainability_document_2_Name = date('d-m-y_H:i') . '.' . $sustainability_document_2->getClientOriginalExtension();
            $sustainability_document_2->move($destinationPathDocument, $sustainability_document_2_Name);
        }
        if ($request->hasFile('sustainability_document_3')) {
            $sustainability_document_3 = $request->file('sustainability_document_3');
            $sustainability_document_3_Name = date('d-m-y_H:i') . '.' . $sustainability_document_3->getClientOriginalExtension();
            $sustainability_document_3->move($destinationPathDocument, $sustainability_document_3_Name);
        }
        if ($request->hasFile('sustainability_document_4')) {
            $sustainability_document_4 = $request->file('sustainability_document_4');
            $sustainability_document_4_Name = date('d-m-y_H:i') . '.' . $sustainability_document_4->getClientOriginalExtension();
            $sustainability_document_4->move($destinationPathDocument, $sustainability_document_4_Name);
        }
        if ($request->hasFile('sustainability_document_5')) {
            $sustainability_document_5 = $request->file('sustainability_document_5');
            $sustainability_document_5_Name = date('d-m-y_H:i') . '.' . $sustainability_document_5->getClientOriginalExtension();
            $sustainability_document_5->move($destinationPathDocument, $sustainability_document_5_Name);
        }
        if ($request->hasFile('sustainability_document_6')) {
            $sustainability_document_6 = $request->file('sustainability_document_6');
            $sustainability_document_6_Name = date('d-m-y_H:i') . '.' . $sustainability_document_6->getClientOriginalExtension();
            $sustainability_document_6->move($destinationPathDocument, $sustainability_document_6_Name);
        }

        // Update the Quality heading
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_5'],
            ['value' => $request->input('sustainability_heading')]
        );

        // Update the Quality paragraph
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_5'],
            ['value' => $request->input('sustainability_paragraph')]
        );

        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_1'],
            ['value' => $request->input('sustainability_button_1_lable')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_2'],
            ['value' => $request->input('sustainability_button_2_lable')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_3'],
            ['value' => $request->input('sustainability_button_3_lable')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_4'],
            ['value' => $request->input('sustainability_button_4_lable')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_5'],
            ['value' => $request->input('sustainability_button_5_lable')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_6'],
            ['value' => $request->input('sustainability_button_6_lable')]
        );

        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_document_1'],
            ['value' => $sustainability_document_1_Name ?: TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_1')->value('value')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_document_2'],
            ['value' => $sustainability_document_2_Name ?: TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_2')->value('value')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_document_3'],
            ['value' => $sustainability_document_3_Name ?: TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_3')->value('value')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_document_4'],
            ['value' => $sustainability_document_4_Name ?: TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_4')->value('value')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_document_5'],
            ['value' => $sustainability_document_5_Name ?: TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_5')->value('value')]
        );
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_document_6'],
            ['value' => $sustainability_document_6_Name ?: TestFacilitySetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_6')->value('value')]
        );


        return redirect()->back()->with('success', 'Sustainability section updated successfully.');
    }
    public function updateTeam1(Request $request)
    {
        $request->validate([
            'team_heading' => 'nullable|string',
            'team_paragraph' => 'nullable|string',
        ]);

        // Update the Quality heading
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_6'],
            ['value' => $request->input('team_heading')]
        );

        // Update the Quality paragraph
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_6'],
            ['value' => $request->input('team_paragraph')]
        );

        return redirect()->back()->with('success', 'Team section updated successfully.');
    }

    public function updateInnovation1(Request $request)
    {
        $request->validate([
            'innovation_heading' => 'nullable|string',
            'innovation_paragraph' => 'nullable|string',
            'success_image_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'success_image_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'success_image_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Process the first image upload
        $destinationPath = public_path('sales_manager/images');
        $imageName1 = null;
        $imageName2 = null;
        $imageName3 = null;

        if ($request->hasFile('success_image_image_1')) {
            $image1 = $request->file('success_image_image_1');
            $imageName1 = time() . '_1.' . $image1->getClientOriginalExtension();
            $image1->move($destinationPath, $imageName1);
        }

        if ($request->hasFile('success_image_image_2')) {
            $image2 = $request->file('success_image_image_2');
            $imageName2 = time() . '_2.' . $image2->getClientOriginalExtension();
            $image2->move($destinationPath, $imageName2);
        }

        if ($request->hasFile('success_image_image_3')) {
            $image3 = $request->file('success_image_image_3');
            $imageName3 = time() . '_3.' . $image3->getClientOriginalExtension();
            $image3->move($destinationPath, $imageName3);
        }

        // Update the heading
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_7'],
            ['value' => $request->input('innovation_heading')]
        );

        // Update the paragraph
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_7'],
            ['value' => $request->input('innovation_paragraph')]
        );

        // Update the first image
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'success_stories_image', 'sub_title' => 'success_stories_image_1'],
            ['value' => $imageName1 ?: TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_1')->value('value')]
        );

        // Update the second image
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'success_stories_image', 'sub_title' => 'success_stories_image_2'],
            ['value' => $imageName2 ?: TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_2')->value('value')]
        );

        // Update the third image
        TestFacilitySetting::updateOrCreate(
            ['section_name' => 'success_stories_image', 'sub_title' => 'success_stories_image_3'],
            ['value' => $imageName3 ?: TestFacilitySetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_3')->value('value')]
        );

        return redirect()->back()->with('success', 'Innovation Section Updated succesfully.');
    }

    public function create1()
    {
        $members = TeamTestFacility::orderBy('id', 'desc')->get();
        // Fetch all team members from the database
        return view('Admin/test_facility', compact('members'));
    }
    public function store1(Request $request)
    {
        // Validate request data
        $request->validate([
            'profile_pic' => 'nullable|image|mimes:jpeg,png,webp,jpg', // Optional image validation with max size
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Handle file upload if provided
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $destinationPath = public_path('sales_manager/team_test_facility'); // Absolute path
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate unique file name
            $file->move($destinationPath, $filename); // Move the file to the specified directory
            $profilePicPath = $filename; // Store only the filename
        }

        // Create new team member
        TeamTestFacility::create([
            'profile_pic' => $profilePicPath, // Store the full path if uploaded
            'name' => $request->input('name'),
            'designation' => $request->input('designation'),
            'email' => $request->input('email'),
        ]);

        // Redirect back to form with success message
        return redirect()->back()->with('success', 'Member added successfully.');
    }
    public function edit1($id)
    {
        \Log::info("Edit method called for member ID: " . $id);
        try {
            $member = TeamTestFacility::findOrFail($id);
            \Log::info("Member found: " . json_encode($member));

            // Ensure the profile_pic field contains only the filename
            $member->profile_pic = $member->profile_pic ? basename($member->profile_pic) : null;

            return response()->json($member);
        } catch (\Exception $e) {
            \Log::error('Error fetching member data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch member data: ' . $e->getMessage()], 500);
        }
    }
    public function update1(Request $request, $id)
    {
        try {
            $request->validate([
                'profile_pic' => 'nullable|image|mimes:jpeg,png,webp,jpg',
                'name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'email' => 'required|email',
            ]);

            $member = TeamTestFacility::findOrFail($id);

            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $destinationPath = public_path('sales_manager/team_test_facility');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $filename);

                if ($member->profile_pic && file_exists($destinationPath . '/' . $member->profile_pic)) {
                    unlink($destinationPath . '/' . $member->profile_pic);
                }

                $member->profile_pic = $filename;
            }

            $member->update([
                'name' => $request->input('name'),
                'designation' => $request->input('designation'),
                'email' => $request->input('email'),
            ]);

            session()->flash('success', 'Member updated successfully.');
            return response()->json(['success' => true]);
            // return response()->json(['success' => true, 'message' => 'Member updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function destroy1($id)
    {
        try {
            $member = TeamTestFacility::findOrFail($id);

            if ($member->profile_pic && file_exists(public_path('sales_manager/team_test_facility/' . $member->profile_pic))) {
                unlink(public_path('sales_manager/team_test_facility/' . $member->profile_pic));
            }

            $member->delete();
            session()->flash('success', 'Member deleted successfully.');
            return response()->json(['success' => true]);
            // return response()->json(['success' => true, 'message' => 'Member deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting member: ' . $e->getMessage()], 500);
        }
    }

    public function setTestFacilityOrder(Request $request)
    {
        $order = $request->input('order');
        foreach ($order as $index => $id) {
            TeamTestFacility::where('id', $id)->update(['sort_order' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}
