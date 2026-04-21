<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleManagerDashboard;

class OrderTrackController extends Controller{
    public function index()
    {
        $page_title = "Pricing Tool";
        $sidebar_active = "dashboard";
        // Retrieve the Pricing Tool and Order Track links
        $orderTrackLink = SaleManagerDashboard::where('section', 'OrderTrackLink')->value('value');

        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/order_tarck'],
        ];

        return view('Admin.order_track', compact(
            'page_title',
            'sidebar_active',
            'bread_crumbs',
            'orderTrackLink',
        ));
    }

    public function updateOrderTrack(Request $request)
    {
        $request->validate([
            'order_track_link' => 'required|url', // Ensure it's a valid URL
        ]);

        // Update or create the 'Order Track' link in the database
        SaleManagerDashboard::updateOrCreate(
            ['section' => 'OrderTrackLink'], // Use a unique section identifier
            ['value' => $request->order_track_link]
        );

        return redirect()->route('OrderTrack')->with('success', 'Order Track link updated successfully.');
    }
}