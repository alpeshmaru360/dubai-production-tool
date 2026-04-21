<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\CustomerService;

use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    public function index()
    {
        $customerServices = CustomerService::orderBy('created_at', 'desc')->get();
        $CurrentEmail = ContactUs::where('section', 'email')->value('value');
        $CurrentPhone = ContactUs::where('section', 'contact_number')->value('value');
        return view('Admin.customer_service', compact('CurrentEmail', 'CurrentPhone', 'customerServices'));
    }
    public function update(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        // Update email
        ContactUs::updateOrCreate(
            ['section' => 'email'], // Find the record
            ['value' => $request->email] // Update the value
        );

        // Update phone number
        ContactUs::updateOrCreate(
            ['section' => 'contact_number'], // Find the record
            ['value' => $request->phone_number] // Update the value
        );

        // Redirect back with success message
        return redirect()->back()->with('success', 'Contact details updated successfully.');
    }
}