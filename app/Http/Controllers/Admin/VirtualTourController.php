<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use Illuminate\Http\Request;

class VirtualTourController extends Controller
{
    public function index()
    {
        $page_title = "Virtual Tour";
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/virtual_tour'],
        ];

        // Fetch both image and label correctly
        $settings = AdminSetting::where('section_name', 'banner')
            ->where('lable', 'Virtual Tour')
            ->first();

        $currentBannerImage = $settings?->value ?? null;
        $currentBannerLabel = $settings?->sub_title ?? '';  // Use sub_title for label display

        return view('Admin.virtual_tour', compact('page_title', 'sidebar_active', 'bread_crumbs', 'currentBannerImage', 'currentBannerLabel'));
    }

    public function updateBannerImageForVT(Request $request)
{
    $request->validate([
        'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'banner_label' => 'nullable|string|max:255',
    ]);

    $imageName = null;
    if ($request->hasFile('banner_image')) {
        $image = $request->file('banner_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('sales_manager/banner'), $imageName);
    }

    // Update ONLY value and sub_title - lable stays "Virtual Tour"
    AdminSetting::where('section_name', 'banner')
        ->where('lable', 'Virtual Tour')
        ->update([
            'value' => $imageName ?: AdminSetting::where('section_name', 'banner')
                ->where('lable', 'Virtual Tour')
                ->value('value'),
            'sub_title' => $request->input('banner_label') ?? AdminSetting::where('section_name', 'banner')
                ->where('lable', 'Virtual Tour')
                ->value('sub_title'),
        ]);

    return redirect()->back()->with('success', 'Banner image and label updated successfully.');
}
}