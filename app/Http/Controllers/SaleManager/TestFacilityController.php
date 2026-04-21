<?php
namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\TestFacilityForm; // Import your TestFacilityForm model

class TestFacilityController extends Controller
{
    public function store(Request $request)
    {
        // Your validation and saving logic here...

        try {
            TestFacilityForm::create([
                'username' => $request->username,
                'f_name' => $request->first_name,
                'l_name' => $request->last_name,
                'ph_number' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);

            // Flash success message to session
            session()->flash('success', 'Test Facility form submitted successfully');

            return response()->json(['success' => true, 'message' => 'Test Facility form submitted successfully']);
        } catch (\Exception $e) {
            // Error handling
            Log::error('Database Insertion Error:', [$e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Could not save data, please try again later.'], 500);
        }
    }
}
