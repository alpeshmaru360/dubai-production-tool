<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('created_at', 'desc')->get();
        return view('Admin.countries', compact('countries'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'country_name' => 'required|string',
            'country_code' => 'required|string|max:5',
        ]);

        // Check if the country already exists
        $existingCountry = Country::where('country_name', $validatedData['country_name'])
            ->orWhere('country_code', $validatedData['country_code'])
            ->first();

        if ($existingCountry) {
            return back()->with('error', 'Country not saved because it already exists.');
        }

        Country::create([
            'country_name' => $validatedData['country_name'],
            'country_code' => $validatedData['country_code'],
        ]);

        return back()->with('success', 'Country saved successfully.');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country deleted successfully.');
    }
}
