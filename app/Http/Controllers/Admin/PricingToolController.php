<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleManagerDashboard;

class PricingToolController extends Controller
{
    public function index()
    {
        $page_title = "Pricing Tool";
        $sidebar_active = "dashboard";
        // Retrieve the Pricing Tool and Order Track links
        $pricingToolLink = SaleManagerDashboard::where('section', 'PricingToolLink')->value('value');

        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/pricing_tool'],
        ];

        return view('Admin.pricing_tool', compact(
            'page_title',
            'sidebar_active',
            'bread_crumbs',
            'pricingToolLink',
        ));
    }

    public function updatePricingTool(Request $request)
    {
        $request->validate([
            'pricing_tool_link' => 'required|url', // Ensure it's a valid URL
        ]);

        // Update or create the 'Pricing Tool' link in the database
        SaleManagerDashboard::updateOrCreate(
            ['section' => 'PricingToolLink'], // Use a unique section identifier
            ['value' => $request->pricing_tool_link]
        );

        // Set a flash message for success
        return redirect()->route('PricingTool')->with('success', 'Pricing Tool link updated successfully.');
    }
}
