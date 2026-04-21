<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleManagerDashboard;

class RefTableController extends Controller
{
    public function index()
    {
        $page_title = "Reference Table";
        $sidebar_active = "dashboard";
        // Retrieve the Pricing Tool and Order Track links
        $referenceTableLink = SaleManagerDashboard::where('section', 'ReferenceTableLink')->value('value');

        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/reference_table'],
        ];

        return view('Admin.ref_table', compact(
            'page_title',
            'sidebar_active',
            'bread_crumbs',
            'referenceTableLink',
        ));
    }

    public function updateReferenceTable(Request $request)
    {
        $request->validate([
            'reference_table_link' => 'required|url', // Ensure it's a valid URL
        ]);

        // Update or create the 'Reference Table' link in the database
        SaleManagerDashboard::updateOrCreate(
            ['section' => 'ReferenceTableLink'], // Use a unique section identifier
            ['value' => $request->reference_table_link]
        );

        // Set a flash message for success
        return redirect()->route('RefTable')->with('success', 'Reference Table link updated successfully.');
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'country' => 'required|string|max:255',
    //         'project_name' => 'required|string|max:255',
    //         'about_project' => 'required|string',
    //         'product_type' => 'required|string|max:255',
    //         'project_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($request->hasFile('project_pic')) {
    //         $image = $request->file('project_pic');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('sales_manager/reference_table'), $imageName);
    //     }

    //     RefTable::create([
    //         'country' => $validatedData['country'],
    //         'project_name' => $validatedData['project_name'],
    //         'discretion' => $validatedData['about_project'],
    //         'product_type' => $validatedData['product_type'],
    //         'project_pic' => $imageName ?? null,
    //     ]);

    //     return redirect()->route('RefTable')->with('success', 'Project added successfully.');
    // }

    // public function edit($id)
    // {
    //     $project = RefTable::findOrFail($id);
    //     $countries = Country::orderBy('country_name', 'asc')->get();
    //     $Products = ProductType::all();
    //     return view('Admin.edit_ref_table', compact('project', 'countries', 'Products'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'country' => 'required|string|max:255',
    //         'project_name' => 'required|string|max:255',
    //         'about_project' => 'required|string',
    //         'product_type' => 'required|string|max:255',
    //         'project_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $project = RefTable::findOrFail($id);

    //     if ($request->hasFile('project_pic')) {
    //         // Delete old image
    //         if ($project->project_pic) {
    //             Storage::delete('public/sales_manager/reference_table/' . $project->project_pic);
    //         }

    //         $image = $request->file('project_pic');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('sales_manager/reference_table'), $imageName);
    //         $project->project_pic = $imageName;
    //     }

    //     $project->update([
    //         'country' => $validatedData['country'],
    //         'project_name' => $validatedData['project_name'],
    //         'discretion' => $validatedData['about_project'],
    //         'product_type' => $validatedData['product_type'],
    //     ]);

    //     return redirect()->route('RefTable')->with('success', 'Project updated successfully.');
    // }

    // public function destroy($id)
    // {
    //     $project = RefTable::findOrFail($id);

    //     // Delete associated image
    //     if ($project->project_pic) {
    //         Storage::delete('public/sales_manager/reference_table/' . $project->project_pic);
    //     }

    //     $project->delete();

    //     return redirect()->route('RefTable')->with('success', 'Project deleted successfully.');
    // }
}
