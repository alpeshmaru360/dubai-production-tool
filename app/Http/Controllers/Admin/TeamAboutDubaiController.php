<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeamAboutDubai;
use Illuminate\Http\Request;

class TeamAboutDubaiController extends Controller
{
    /**
     * Show the form for creating a new team member.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Admin/about_dubai_production_tool', [
            'members' => TeamAboutDubai::all() // Fetch all team members from the database
        ]);
    }

    /**
     * Store a newly created team member in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    // Validate request data
    $request->validate([
        'profile_pic' => 'nullable|image|mimes:jpeg,png,webp,jpg', // Optional image validation
        'name' => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'email' => 'required|email',
    ]);

    // Handle file upload if provided
    $profilePicPath = null;
    if ($request->hasFile('profile_pic')) {
        $profilePicPath = public_path('sales_manager/team_about_dubai');
    }

    // Create new team member
    TeamAboutDubai::create([
        'profile_pic' => $profilePicPath, // Store the file path if uploaded
        'name' => $request->input('name'),
        'designation' => $request->input('designation'),
        'email' => $request->input('email'),
    ]);

    // Redirect back to form with success message
    return redirect()->route('about-dubai.create')->with('success', 'New member added successfully.');
}
}