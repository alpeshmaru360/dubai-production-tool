<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\UserRole;
use App\Models\TeamAboutDubai;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Log;
use App\Models\ProductButton;


class AboutDubaiProductionController extends Controller
{
    public function index()
    {
        $page_title = "About Dubai Production Tool";
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/about_dubai_production_tool'],
        ];
        // Retrieve current settings from the database
        $currentBannerImage = AdminSetting::where('section_name', 'banner')->value('value');
        $currentBannerLabel = AdminSetting::where('section_name', 'banner')->value('lable');
        $currentInitialParagraph = AdminSetting::where('section_name', 'initial_paragraph')->value('value');
        // Retrieve location settings
        $currentLocationHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_1')->value('value');
        $currentLocationParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_1')->value('value');
        $currentLocationImage = AdminSetting::where('section_name', 'image')->where('sub_title', 'image_1')->value('value');
        $currentPumpFacilityHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_2')->value('value');
        $currentPumpFacilityParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_2')->value('value');
        $currentTestingFacilityImage1 = AdminSetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_1')->value('value');
        $currentTestingFacilityImage2 = AdminSetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_2')->value('value');
        $currentProductRangeHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_3')->value('value');
        $currentProductRangeParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_3')->value('value');
        $productButtons = ProductButton::all();
        // 
        $members = TeamAboutDubai::orderBy('sort_order', 'asc')->get();
        // 
        $currentQualityHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_4')->value('value');
        $currentQualityParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_4')->value('value');
        $currentQualityImage = AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'commitment_img')->value('value');
        $currentISO9001Document = AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_9001_document')->value('value');
        $currentISO45001Document = AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_45001_document')->value('value');
        $currentSustainabilityHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_5')->value('value');
        $currentSustainabilityParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_5')->value('value');
        $currentsustainability_button_1 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_1')->value('value');
        $currentsustainability_button_2 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_2')->value('value');
        $currentsustainability_button_3 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_3')->value('value');
        $currentsustainability_button_4 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_4')->value('value');
        $currentsustainability_button_5 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_5')->value('value');
        $currentsustainability_button_6 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_6')->value('value');
        $currentsustainability_document_1 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_1')->value('value');
        $currentsustainability_document_2 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_2')->value('value');
        $currentsustainability_document_3 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_3')->value('value');
        $currentsustainability_document_4 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_4')->value('value');
        $currentsustainability_document_5 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_5')->value('value');
        $currentsustainability_document_6 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_6')->value('value');
        $currentTeamHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_6')->value('value');
        $currentTeamParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_6')->value('value');
        $currentInnovaionHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_7')->value('value');
        $currentInnovaionParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_7')->value('value');
        $currentSuccessStory_image_1 = AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_1')->value('value');
        $currentSuccessStory_image_2 = AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_2')->value('value');
        $currentSuccessStory_image_3 = AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_3')->value('value');
        $currentLocationLink = AdminSetting::where('sub_title', 'location_link')->value('value');

        return view('Admin.about_dubai_production_tool', compact(
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
            'currentInnovaionHeading',
            'currentInnovaionParagraph',
            'currentSuccessStory_image_1',
            'currentSuccessStory_image_2',
            'members',
            'currentSuccessStory_image_3',
            'currentLocationLink'
        ));
    }
    public function updateBannerImage(Request $request)
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
        AdminSetting::where('section_name', 'banner')->update([
            'value' => $imageName ?: AdminSetting::where('section_name', 'banner')->value('value'),
            'lable' => $request->input('banner_label'),
        ]);

        // Update the initial paragraph section value
        AdminSetting::updateOrCreate(
            ['section_name' => 'initial_paragraph'],
            ['value' => $request->input('initial_paragraph')]
        );

        return redirect()->back()->with('success', 'Settings changed successfully.');
    }
    public function updateLocation(Request $request)
    {
        $request->validate([
            'location_heading' => 'nullable|string',
            'location_paragraph' => 'nullable|string',
            'location_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'location_link' => 'nullable|url',
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
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_1'],
            ['value' => $request->input('location_heading')]
        );

        // Update the location paragraph
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_1'],
            ['value' => $request->input('location_paragraph')]
        );

        // Update the location Link
        AdminSetting::updateOrCreate(
            ['section_name' => 'location', 'sub_title' => 'location_link'],
            ['value' => $request->input('location_link')]
        );

        // Update the location image
        AdminSetting::updateOrCreate(
            ['section_name' => 'image', 'sub_title' => 'image_1'],
            ['value' => $imageName ?: AdminSetting::where('section_name', 'image')->where('sub_title', 'image_1')->value('value')]
        );

        return redirect()->back()->with('success', 'Location section updated successfully.');
    }
    public function updatePumpTestingFacility(Request $request)
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
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_2'],
            ['value' => $request->input('pump_facility_heading')]
        );

        // Update the paragraph
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_2'],
            ['value' => $request->input('pump_facility_paragraph')]
        );

        // Update the first image
        AdminSetting::updateOrCreate(
            ['section_name' => 'pump_test', 'sub_title' => 'pump_test_1'],
            ['value' => $imageName1 ?: AdminSetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_1')->value('value')]
        );

        // Update the second image
        AdminSetting::updateOrCreate(
            ['section_name' => 'pump_test', 'sub_title' => 'pump_test_2'],
            ['value' => $imageName2 ?: AdminSetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_2')->value('value')]
        );

        return redirect()->back()->with('success', 'Pump Testing Facility section updated successfully.');
    }
    public function updateProductRange(Request $request)
    {
        $request->validate([
            'Product_range_heading' => 'nullable|string',
            'Product_range_paragraph' => 'nullable|string',
            'button_text.*' => 'nullable|string',
            'button_link.*' => 'nullable|url',
        ]);

        // Update the heading and paragraph
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_3'],
            ['value' => $request->input('Product_range_heading')]
        );

        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_3'],
            ['value' => $request->input('Product_range_paragraph')]
        );

        // Clear existing product buttons to avoid duplication
        ProductButton::truncate();

        // Save the button labels and links
        if ($request->filled('button_text') && $request->filled('button_link')) {
            foreach ($request->input('button_text') as $index => $text) {
                if (!empty($text) && !empty($request->input('button_link')[$index])) {
                    ProductButton::create([
                        'button_text' => $text,
                        'button_link' => $request->input('button_link')[$index],
                    ]);
                }
            }
        }

        // After saving, redirect back with success message and with the updated buttons
        return redirect()->action([self::class, 'showProductRangeForm'])->with('success', 'Product Range section updated successfully.');
    }
    public function showProductRangeForm()
    {
        $page_title = "About Dubai Production Tool";
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/about_dubai_production_tool'],
        ];

        // Fetch all the necessary data
        $currentBannerImage = AdminSetting::where('section_name', 'banner')->value('value');
        $currentBannerLabel = AdminSetting::where('section_name', 'banner')->value('lable');
        $currentInitialParagraph = AdminSetting::where('section_name', 'initial_paragraph')->value('value');
        $currentLocationHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_1')->value('value');
        $currentLocationParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_1')->value('value');
        $currentLocationImage = AdminSetting::where('section_name', 'image')->where('sub_title', 'image_1')->value('value');
        $currentPumpFacilityHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_2')->value('value');
        $currentPumpFacilityParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_2')->value('value');
        $currentTestingFacilityImage1 = AdminSetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_1')->value('value');
        $currentTestingFacilityImage2 = AdminSetting::where('section_name', 'pump_test')->where('sub_title', 'pump_test_2')->value('value');
        $currentProductRangeHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_3')->value('value');
        $currentProductRangeParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_3')->value('value');
        $productButtons = ProductButton::all();
        // 
        $members = TeamAboutDubai::orderBy('id', 'desc')->get();
        // 
        $currentQualityHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_4')->value('value');
        $currentQualityParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_4')->value('value');
        $currentQualityImage = AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'commitment_img')->value('value');
        $currentISO9001Document = AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_9001_document')->value('value');
        $currentISO45001Document = AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_45001_document')->value('value');
        $currentSustainabilityHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_5')->value('value');
        $currentSustainabilityParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_5')->value('value');
        $currentsustainability_button_1 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_1')->value('value');
        $currentsustainability_button_2 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_2')->value('value');
        $currentsustainability_button_3 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_3')->value('value');
        $currentsustainability_button_4 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_4')->value('value');
        $currentsustainability_button_5 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_5')->value('value');
        $currentsustainability_button_6 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_button_6')->value('value');
        $currentsustainability_document_1 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_1')->value('value');
        $currentsustainability_document_2 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_2')->value('value');
        $currentsustainability_document_3 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_3')->value('value');
        $currentsustainability_document_4 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_4')->value('value');
        $currentsustainability_document_5 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_5')->value('value');
        $currentsustainability_document_6 = AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', 'sustainability_document_6')->value('value');
        $currentTeamHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_6')->value('value');
        $currentTeamParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_6')->value('value');
        $currentInnovaionHeading = AdminSetting::where('section_name', 'sub_heading')->where('sub_title', 'sub_heading_7')->value('value');
        $currentInnovaionParagraph = AdminSetting::where('section_name', 'sub_para')->where('sub_title', 'sub_para_7')->value('value');
        $currentSuccessStory_image_1 = AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_1')->value('value');
        $currentSuccessStory_image_2 = AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_2')->value('value');
        $currentSuccessStory_image_3 = AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_3')->value('value');
        $currentLocationLink = AdminSetting::where('sub_title', 'location_link')->value('value');

        return redirect()->route('AboutDubaiProductionTool')->with('success', 'Product Type section updated successfully');
    }
    public function updateQuality(Request $request)
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
        AdminSetting::updateOrCreate(
            ['section_name' => 'Commitment', 'sub_title' => 'ISO_9001_document'],
            ['value' => $ISO9001DocumentName ?: AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_9001_document')->value('value')]
        );

        if ($request->hasFile('quality_image')) {
            $image = $request->file('quality_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
        }

        // Update the Quality image
        AdminSetting::updateOrCreate(
            ['section_name' => 'Commitment', 'sub_title' => 'commitment_img'],
            ['value' => $imageName ?: AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'commitment_img')->value('value')]
        );

        // Update the Quality heading
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_4'],
            ['value' => $request->input('quality_heading')]
        );

        // Update the Quality paragraph
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_4'],
            ['value' => $request->input('quality_paragraph')]
        );

        // Update the ISO 45001 document
        AdminSetting::updateOrCreate(
            ['section_name' => 'Commitment', 'sub_title' => 'ISO_45001_document'],
            ['value' => $ISO45001DocumentName ?: AdminSetting::where('section_name', 'Commitment')->where('sub_title', 'ISO_45001_document')->value('value')]
        );

        return redirect()->route('AboutDubaiProductionTool')->with('success', 'Quality section updated successfully.');
    }

    public function updateSustainability(Request $request)
    {
        $request->validate([
            'sustainability_document_1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_3' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_4' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_5' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_document_6' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt',
            'sustainability_heading' => 'required|string',
            'sustainability_paragraph' => 'required|string',
            'sustainability_button_1_lable' => 'required|string',
            'sustainability_button_2_lable' => 'required|string',
            'sustainability_button_3_lable' => 'required|string',
            'sustainability_button_4_lable' => 'required|string',
            'sustainability_button_5_lable' => 'required|string',
            'sustainability_button_6_lable' => 'required|string',
        ]);

        $destinationPathImage = public_path('sales_manager/documents');

        $imageNames = [];

        for ($i = 1; $i <= 6; $i++) {
            $fieldName = "sustainability_document_$i";
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $fileName = date('d-m-y_H:i') . '_' . $i . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPathImage, $fileName);
                $imageNames[$fieldName] = $fileName;
            }
        }

        $updateData = [
            ['lable' => 'Sustainability Heading', 'section_name' => 'sustainability', 'sub_title' => 'heading', 'value' => $request->sustainability_heading],
            ['lable' => 'Sustainability Paragraph', 'section_name' => 'sustainability', 'sub_title' => 'paragraph', 'value' => $request->sustainability_paragraph],
        ];

        // Update the Quality heading
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_5'],
            ['value' => $request->input('sustainability_heading')]
        );

        // Update the Quality paragraph
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_5'],
            ['value' => $request->input('sustainability_paragraph')]
        );

        AdminSetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_1'],
            ['value' => $request->input('sustainability_button_1_lable')]
        );
        AdminSetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_2'],
            ['value' => $request->input('sustainability_button_2_lable')]
        );
        AdminSetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_3'],
            ['value' => $request->input('sustainability_button_3_lable')]
        );
        AdminSetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_4'],
            ['value' => $request->input('sustainability_button_4_lable')]
        );
        AdminSetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_5'],
            ['value' => $request->input('sustainability_button_5_lable')]
        );
        AdminSetting::updateOrCreate(
            ['section_name' => 'sustainability_button', 'sub_title' => 'sustainability_button_6'],
            ['value' => $request->input('sustainability_button_6_lable')]
        );

        for ($i = 1; $i <= 6; $i++) {
            $buttonFieldName = "sustainability_button_{$i}_lable";
            $imageFieldName = "sustainability_document_$i";

            $updateData[] = [
                'section_name' => 'sustainability_button',
                'sub_title' => $buttonFieldName,
                'value' => $request->$buttonFieldName
            ];

            $updateData[] = [
                'section_name' => 'sustainability_button',
                'sub_title' => $imageFieldName,
                'value' => $imageNames[$imageFieldName] ?? AdminSetting::where('section_name', 'sustainability_button')->where('sub_title', $imageFieldName)->value('value')
            ];
        }

        foreach ($updateData as $data) {
            AdminSetting::updateOrCreate(
                ['section_name' => $data['section_name'], 'sub_title' => $data['sub_title']],
                ['value' => $data['value']]
            );
        }

        return redirect()->route('AboutDubaiProductionTool')->with('success', 'Sustainability section updated successfully');
    }
    public function updateTeam(Request $request)
    {
        // dd($request->input('_token'));
        $request->validate([
            'team_heading' => 'nullable|string',
            'team_paragraph' => 'nullable|string',
        ]);

        // Update the Quality heading
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_6'],
            ['value' => $request->input('team_heading')]
        );

        // Update the Quality paragraph
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_6'],
            ['value' => $request->input('team_paragraph')]
        );

        return redirect()->route('AboutDubaiProductionTool')->with('success', 'Team section updated successfully..');
    }

    public function updateInnovation(Request $request)
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
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_heading', 'sub_title' => 'sub_heading_7'],
            ['value' => $request->input('innovation_heading')]
        );

        // Update the paragraph
        AdminSetting::updateOrCreate(
            ['section_name' => 'sub_para', 'sub_title' => 'sub_para_7'],
            ['value' => $request->input('innovation_paragraph')]
        );

        // Update the first image
        AdminSetting::updateOrCreate(
            ['section_name' => 'success_stories_image', 'sub_title' => 'success_stories_image_1'],
            ['value' => $imageName1 ?: AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_1')->value('value')]
        );

        // Update the second image
        AdminSetting::updateOrCreate(
            ['section_name' => 'success_stories_image', 'sub_title' => 'success_stories_image_2'],
            ['value' => $imageName2 ?: AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_2')->value('value')]
        );

        // Update the third image
        AdminSetting::updateOrCreate(
            ['section_name' => 'success_stories_image', 'sub_title' => 'success_stories_image_3'],
            ['value' => $imageName3 ?: AdminSetting::where('section_name', 'success_stories_image')->where('sub_title', 'success_stories_image_3')->value('value')]
        );

        return redirect()->route('AboutDubaiProductionTool')->with('success', 'Innovation section updated successfully..');
    }

    public function create()
    {
        $members = TeamAboutDubai::orderBy('id', 'desc')->get();
        // Fetch all team members from the database
        return view('Admin/about_dubai_production_tool', compact('members'));
    }
    public function store(Request $request)
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
            $destinationPath = public_path('sales_manager/team_about_dubai'); // Absolute path
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate unique file name
            $file->move($destinationPath, $filename); // Move the file to the specified directory
            $profilePicPath = $filename; // Store only the filename
        }

        // Create new team member
        TeamAboutDubai::create([
            'profile_pic' => $profilePicPath, // Store the full path if uploaded
            'name' => $request->input('name'),
            'designation' => $request->input('designation'),
            'email' => $request->input('email'),
        ]);

        // Redirect back to form with success message
        return redirect()->route('AboutDubaiProductionTool')->with('success', 'Member added successfully.');
    }
    public function edit($id)
    {
        \Log::info("Edit method called for member ID: " . $id);
        try {
            $member = TeamAboutDubai::findOrFail($id);
            \Log::info("Member found: " . json_encode($member));
            return response()->json($member);
        } catch (\Exception $e) {
            \Log::error('Error fetching member data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch member data: ' . $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'profile_pic' => 'nullable|image|mimes:jpeg,png,webp,jpg',
                'name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'email' => 'required|email',
            ]);

            $member = TeamAboutDubai::findOrFail($id);

            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $destinationPath = public_path('sales_manager/team_about_dubai');
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
            return response()->json(['success' => true, 'message' => 'Member updated successfully']);
        } catch (\Exception $e) {
            \Log::error('Error updating member: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating member: ' . $e->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $member = TeamAboutDubai::findOrFail($id);

            if ($member->profile_pic && file_exists(public_path('sales_manager/team_about_dubai/' . $member->profile_pic))) {
                unlink(public_path('sales_manager/team_about_dubai/' . $member->profile_pic));
            }

            $member->delete();
            session()->flash('success', 'Member deleted successfully.');
            return response()->json(['success' => true]);
            return response()->json(['success' => true, 'message' => 'Member deleted successfully.']);
        } catch (\Exception $e) {
            \Log::error('Error deleting member: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error deleting member: ' . $e->getMessage()], 500);
        }
    }

    public function setDubaiTeamOrder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $index => $id) {
            TeamAboutDubai::where('id', $id)->update(['sort_order' => $index + 1]); // Assuming you have an 'order' column
        }

        return response()->json(['success' => true]);
    }
}
