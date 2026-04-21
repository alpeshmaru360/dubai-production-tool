<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleManagerDashboard;

class SaleManagerDashboardController extends Controller
{
    public function index()
    {
        $page_title = "Sale Manager Dashboard";
        $sidebar_active = "dashboard";


        // Retrieve the video path from the database
        $video = SaleManagerDashboard::where('section', 'Video')->value('value');
        $currentMenuLabel1 = SaleManagerDashboard::where('section', 'menulable1')->value('value');
        $currentMenuLabel2 = SaleManagerDashboard::where('section', 'menulable2')->value('value');
        $currentMenuLabel3 = SaleManagerDashboard::where('section', 'menulable3')->value('value');
        $currentMenuLabel4 = SaleManagerDashboard::where('section', 'menulable4')->value('value');
        $currentMenuLabel5 = SaleManagerDashboard::where('section', 'menulable5')->value('value');
        $currentMenuLabel6 = SaleManagerDashboard::where('section', 'menulable6')->value('value');
        $currentMenuLabel7 = SaleManagerDashboard::where('section', 'menulable7')->value('value');
        $currentMenuLabel8 = SaleManagerDashboard::where('section', 'menulable8')->value('value');
        $currentMenuLabel9 = SaleManagerDashboard::where('section', 'menulable9')->value('value');
        $currentMenuLabel10 = SaleManagerDashboard::where('section', 'menulable10')->value('value');
        $currentMenuLabel11 = SaleManagerDashboard::where('section', 'menulable11')->value('value');
        $currentMenuLabel12 = SaleManagerDashboard::where('section', 'menulable12')->value('value');
        $currentMenuImg1 = SaleManagerDashboard::where('section', 'menuimg1')->value('value');
        $currentMenuImg2 = SaleManagerDashboard::where('section', 'menuimg2')->value('value');
        $currentMenuImg3 = SaleManagerDashboard::where('section', 'menuimg3')->value('value');
        $currentMenuImg4 = SaleManagerDashboard::where('section', 'menuimg4')->value('value');
        $currentMenuImg5 = SaleManagerDashboard::where('section', 'menuimg5')->value('value');
        $currentMenuImg6 = SaleManagerDashboard::where('section', 'menuimg6')->value('value');
        $currentMenuImg7 = SaleManagerDashboard::where('section', 'menuimg7')->value('value');
        $currentMenuImg8 = SaleManagerDashboard::where('section', 'menuimg8')->value('value');
        $currentMenuImg9 = SaleManagerDashboard::where('section', 'menuimg9')->value('value');
        $currentMenuImg10 = SaleManagerDashboard::where('section', 'menuimg10')->value('value');
        $currentMenuImg11 = SaleManagerDashboard::where('section', 'menuimg11')->value('value');
        $currentMenuImg12 = SaleManagerDashboard::where('section', 'menuimg12')->value('value');

        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/salemanager_dashboard'],
        ];

        return view('Admin.salemanagerdashboard', compact(
            'page_title',
            'sidebar_active',
            'bread_crumbs',
            'video',
            'currentMenuLabel1',
            'currentMenuLabel2',
            'currentMenuLabel3',
            'currentMenuLabel4',
            'currentMenuLabel5',
            'currentMenuLabel6',
            'currentMenuLabel7',
            'currentMenuLabel8',
            'currentMenuLabel9',
            'currentMenuLabel10',
            'currentMenuLabel11',
            'currentMenuLabel12',
            'currentMenuImg1',
            'currentMenuImg2',
            'currentMenuImg3',
            'currentMenuImg4',
            'currentMenuImg5',
            'currentMenuImg6',
            'currentMenuImg7',
            'currentMenuImg8',
            'currentMenuImg9',
            'currentMenuImg10',
            'currentMenuImg11',
            'currentMenuImg12'
        ));
    }

    public function uploadVideo(Request $request)
    {
        try {
            $request->validate([
                'video' => 'required|mimes:mp4,avi,mov,wmv', // Limit to 10 MB
            ]);

            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('sales_manager/video');

                // Move the file to the public/sales_manager/video directory
                $file->move($destinationPath, $fileName);

                // Check if storage path is working as expected
                SaleManagerDashboard::updateOrCreate(
                    ['section' => 'Video'],
                    ['value' => $fileName]
                );
                return redirect()->route('SalemanagerDashboard')->with('success', 'Video uploaded and saved successfully.');
            }

            //return back()->with('error', 'Failed to upload video.');
            return back()->with('error', 'No video file found to upload.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Video Upload Error: ' . $e->getMessage());

            return back()->with('error', $e->getMessage());
        }
    }

    public function updateMenu(Request $request)
    {
        $request->validate([
            'menulable1' => 'nullable|string|max:255',
            'menulable2' => 'nullable|string|max:255',
            'menulable3' => 'nullable|string|max:255',
            'menulable4' => 'nullable|string|max:255',
            'menulable5' => 'nullable|string|max:255',
            'menulable6' => 'nullable|string|max:255',
            'menulable7' => 'nullable|string|max:255',
            'menulable8' => 'nullable|string|max:255',
            'menulable9' => 'nullable|string|max:255',
            'menulable10' => 'nullable|string|max:255',
            'menulable11' => 'nullable|string|max:255',
            'menulable12' => 'nullable|string|max:255',
            'menuimg1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg4' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg5' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg6' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg7' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg8' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg9' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg10' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg11' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'menuimg12' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $destinationPath = public_path('sales_manager/dashboard-img');

        for ($i = 1; $i <= 12; $i++) {
            $labelKey = "menulable{$i}";
            $imageKey = "menuimg{$i}";

            // Update label
            SaleManagerDashboard::updateOrCreate(
                ['section' => $labelKey],
                ['value' => $request->input($labelKey)]
            );

            // Process image if uploaded
            if ($request->hasFile($imageKey)) {
                $image = $request->file($imageKey);
                $imageName = 'menu_' . $i . '_' . time() . '.' . $image->getClientOriginalExtension();

                if ($image->move($destinationPath, $imageName)) {
                    SaleManagerDashboard::updateOrCreate(
                        ['section' => $imageKey],
                        ['value' => $imageName]
                    );
                } else {
                    return redirect()->back()->with('error', "Failed to upload image for menu item {$i}.");
                }
            }
        }

        return redirect()->back()->with('success', 'Menu updated successfully.');
    }
}
