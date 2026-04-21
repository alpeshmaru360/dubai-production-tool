<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\WitnessForm;
use App\Models\ProductType;
use App\Models\Email;
use App\Models\PreferredDate;
use App\Mail\WitnessTestMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\WitnessTestUserMail;
use App\Models\WitnessWaitingList;
use App\Mail\WitnessWaitingListMail;
use Carbon\Carbon;

class WitnessFormController extends Controller
{
    public function create()
    {
        $productTypes = ProductType::all();
        $page_title = "";
        return view('sale_manager.witness_test', compact('productTypes', 'page_title'));
    }

    // NEW METHOD: Fetch available date for selected product type
    public function getPreferredDate(Request $request)
    {
        $productTypeId = $request->product_type_id;

        if (!$productTypeId) {
            return response()->json([
                'success' => false,
                'message' => 'Product type is required'
            ]);
        }

        // Get product type name
        $productType = ProductType::find($productTypeId);

        if (!$productType) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid product type'
            ]);
        }

        $productTypeName = $productType->product_type_name;
        $today = Carbon::now()->startOfDay();

        // Find all records matching this product type
        $dateRecords = PreferredDate::where('product_type', $productTypeName)
            ->orderBy('dates', 'asc')
            ->get();

        if ($dateRecords->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'There is no meeting scheduled for this Product type. Check later.'
            ]);
        }

        // Find the first future or current date
        $availableDate = null;
        $meetingLink = null;
        $recordId = null;

        foreach ($dateRecords as $record) {
            $dateString = $record->dates;

            try {
                $dateObj = Carbon::parse($dateString)->startOfDay();

                // Check if date is today or in the future
                if ($dateObj->greaterThanOrEqualTo($today)) {
                    $availableDate = $dateObj->format('Y-m-d');
                    $meetingLink = $record->meeting_link;
                    $recordId = $record->id;
                    break;
                }
            } catch (\Exception $e) {
                Log::error('Date parsing error: ' . $e->getMessage());
                continue;
            }
        }

        if (!$availableDate) {
            return response()->json([
                'success' => false,
                'message' => 'There is no meeting scheduled for this Product type. Check later.'
            ]);
        }

        return response()->json([
            'success' => true,
            'preferred_date' => $availableDate,
            'formatted_date' => Carbon::parse($availableDate)->format('d-M-Y'),
            'meeting_link' => $meetingLink,
            'record_id' => $recordId
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'product_type' => 'required|exists:product_types,id',
            'preferred_date' => 'required|string|max:50',
            'additional_notes' => 'nullable|string',
        ]);

        try {
            // Fetch the full product type name based on the ID selected
            $productType = ProductType::findOrFail($request->product_type)->product_type_name;
            $PreferredDate = $request->preferred_date;

            // Parse the preferred date to ensure consistent format
            try {
                $formattedDate = Carbon::parse($PreferredDate)->format('Y-m-d');
            } catch (\Exception $e) {
                $formattedDate = $PreferredDate;
            }

            // Convert to DD-MM-YYYY for DB query (to match preferred_dates table format)
            $dbFormattedDate = Carbon::parse($formattedDate)->format('d-m-Y');

            // Fetch the PreferredDate record for this product type and date
            $preferredDateRecord = PreferredDate::where('product_type', $productType)
                ->where('dates', $dbFormattedDate)
                ->first();

            if (!$preferredDateRecord) {
                Log::warning('No PreferredDate record found for capacity check', [
                    'product_type' => $productType,
                    'preferred_date' => $formattedDate,
                    'dbFormattedDate' => $dbFormattedDate
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'No scheduled date found for this product type. Please try again.'
                ], 422);
            }

            $capacity = $preferredDateRecord->capacity ?? 10; // Default to 10 if null
            $meetingLink = $preferredDateRecord->meeting_link;

            // Check capacity before allowing submission
            $submissionCount = WitnessForm::where('product_type', $productType)
                ->where('preferred_date', $formattedDate)
                ->count();

            if ($submissionCount >= $capacity) {
                // Capacity is full, return error
                Log::warning('Capacity full - User attempted submission:', [
                    'email' => $request->email,
                    'product_type' => $productType,
                    'preferred_date' => $formattedDate,
                    'current_count' => $submissionCount,
                    'capacity' => $capacity
                ]);

                return response()->json([
                    'success' => false,
                    'capacity_full' => true,
                    'message' => 'Registration slots are full for this date and product type.'
                ], 422);
            }

            // Create and save the witness form entry
            $witnessForm = WitnessForm::create([
                'username' => $request->username,
                'phone' => $request->phone,
                'email' => $request->email,
                'product_type' => $productType,
                'preferred_date' => $formattedDate,
                'additional_notes' => $request->additional_notes,
            ]);

            // Prepare email data - includes meeting_link
            $emailData = [
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'product_type' => $productType,
                'preferred_date' => $PreferredDate,
                'additional_notes' => $request->additional_notes,
                'meeting_link' => $meetingLink ?? 'Not provided',
            ];

            // Log for debugging
            Log::info('Meeting Link Data:', [
                'product_type' => $productType,
                'preferred_date' => $PreferredDate,
                'meeting_link' => $meetingLink,
                'capacity' => $capacity
            ]);

            // Send email to admin recipients
            $witnessEmails = Email::where('lable', 'witness_test')->value('value') ?? [];
            $recipients = is_array($witnessEmails) ? $witnessEmails : [];

            if (!empty($recipients)) {
                Mail::to($recipients)->send(new WitnessTestMail($emailData));
            }

            // Send confirmation email to the user
            try {
                Mail::to($request->email)->send(new WitnessTestUserMail($emailData));
                Log::info('User confirmation email sent to: ' . $request->email);
            } catch (\Exception $e) {
                // Log error but don't fail the entire operation
                Log::error('Failed to send user confirmation email: ' . $e->getMessage());
            }

            return response()->json(['success' => true, 'message' => 'Witness form submitted successfully']);
        } catch (\Exception $e) {
            Log::error('Database Insertion Error:', [$e->getMessage()]);
            return response()->json(['fail' => false, 'message' => 'Could not save data, please try again later.'], 500);
        }
    }

    public function validateField(Request $request)
    {
        $rules = [];

        if ($request->has('username')) {
            $rules['username'] = 'required|string|max:50';
        }
        if ($request->has('phone')) {
            $rules['phone'] = 'required|string|max:15';
        }
        if ($request->has('email')) {
            $rules['email'] = 'required|email';
        }
        if ($request->has('product_type')) {
            $rules['product_type'] = 'required|exists:product_types,id';
        }
        if ($request->has('preferred_date')) {
            $rules['preferred_date'] = 'required|string|max:50';
        }
        if ($request->has('additional_notes')) {
            $rules['additional_notes'] = 'nullable|string';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        return response()->json(['success' => true]);
    }
    public function checkDuplicate(Request $request)
    {
        $email = $request->email;
        $productTypeId = $request->product_type;
        $preferredDate = $request->preferred_date;

        if (!$email || !$productTypeId || !$preferredDate) {
            return response()->json([
                'success' => true,
                'is_duplicate' => false
            ]);
        }

        // Get product type name
        $productType = ProductType::find($productTypeId);

        if (!$productType) {
            return response()->json([
                'success' => true,
                'is_duplicate' => false
            ]);
        }

        $productTypeName = $productType->product_type_name;

        // Parse the preferred date to ensure consistent format
        try {
            $formattedDate = Carbon::parse($preferredDate)->format('Y-m-d');
        } catch (\Exception $e) {
            $formattedDate = $preferredDate;
        }

        // Check if user already submitted for this product type and date
        $existingSubmission = WitnessForm::where('email', $email)
            ->where('product_type', $productTypeName)
            ->where('preferred_date', $formattedDate)
            ->first();

        if ($existingSubmission) {
            return response()->json([
                'success' => true,
                'is_duplicate' => true,
                'message' => 'You have already submitted this form for this product type and date.'
            ]);
        }

        return response()->json([
            'success' => true,
            'is_duplicate' => false
        ]);
    }
    public function checkWaitingList(Request $request)
    {
        $email = $request->email;
        $productTypeId = $request->product_type;
        $preferredDate = $request->preferred_date;

        if (!$email || !$productTypeId || !$preferredDate) {
            return response()->json([
                'success' => true,
                'is_in_waiting_list' => false
            ]);
        }

        // Get product type name
        $productType = ProductType::find($productTypeId);

        if (!$productType) {
            return response()->json([
                'success' => true,
                'is_in_waiting_list' => false
            ]);
        }

        $productTypeName = $productType->product_type_name;

        // Parse the preferred date to ensure consistent format
        try {
            $formattedDate = Carbon::parse($preferredDate)->format('Y-m-d');
        } catch (\Exception $e) {
            $formattedDate = $preferredDate;
        }

        // Check if user already in waiting list for this product type and date
        $existingWaitingList = WitnessWaitingList::where('email', $email)
            ->where('product_type', $productTypeName)
            ->where('preferred_date', $formattedDate)
            ->first();

        if ($existingWaitingList) {
            return response()->json([
                'success' => true,
                'is_in_waiting_list' => true,
                'message' => 'You are already in the waiting list for this product type and date.'
            ]);
        }

        return response()->json([
            'success' => true,
            'is_in_waiting_list' => false
        ]);
    }
    public function checkCapacity(Request $request)
    {
        $productTypeId = $request->product_type;
        $preferredDate = $request->preferred_date;

        if (!$productTypeId || !$preferredDate) {
            return response()->json([
                'success' => true,
                'is_full' => false
            ]);
        }

        // Get product type name
        $productType = ProductType::find($productTypeId);

        if (!$productType) {
            return response()->json([
                'success' => true,
                'is_full' => false
            ]);
        }

        $productTypeName = $productType->product_type_name;

        // Parse the preferred date to ensure consistent format
        try {
            $formattedDate = Carbon::parse($preferredDate)->format('Y-m-d');
        } catch (\Exception $e) {
            $formattedDate = $preferredDate;
        }

        // Convert to DD-MM-YYYY for DB query (to match preferred_dates table format)
        $dbFormattedDate = Carbon::parse($formattedDate)->format('d-m-Y');

        // Fetch the PreferredDate record for capacity
        $preferredDateRecord = PreferredDate::where('product_type', $productTypeName)
            ->where('dates', $dbFormattedDate)
            ->first();

        if (!$preferredDateRecord) {
            return response()->json([
                'success' => true,
                'is_full' => false  // No record means no capacity defined, so not full
            ]);
        }

        $capacity = $preferredDateRecord->capacity ?? 10;

        // Count existing submissions for this product type and date
        $submissionCount = WitnessForm::where('product_type', $productTypeName)
            ->where('preferred_date', $formattedDate)
            ->count();

        // Check if capacity is full
        if ($submissionCount >= $capacity) {
            return response()->json([
                'success' => true,
                'is_full' => true,
                'current_count' => $submissionCount,
                'capacity' => $capacity,
                'message' => 'Submissions for this date and product type are full.'
            ]);
        }

        return response()->json([
            'success' => true,
            'is_full' => false,
            'current_count' => $submissionCount,
            'capacity' => $capacity
        ]);
    }

    public function storeWaitingList(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'product_type' => 'required|exists:product_types,id',
            'preferred_date' => 'required|string|max:50',
            'additional_notes' => 'nullable|string',
        ]);

        try {
            // Fetch the full product type name based on the ID selected
            $productType = ProductType::findOrFail($request->product_type)->product_type_name;
            $PreferredDate = $request->preferred_date;

            // Parse the preferred date
            try {
                $formattedDate = Carbon::parse($PreferredDate)->format('Y-m-d');
            } catch (\Exception $e) {
                $formattedDate = $PreferredDate;
            }

            // Fetch the PreferredDate record for capacity
            $preferredDateRecord = PreferredDate::where('product_type', $productType)
                ->where('dates', $formattedDate)
                ->first();

            $capacity = $preferredDateRecord ? ($preferredDateRecord->capacity ?? 10) : 10;

            // Get current registration count
            $currentCount = WitnessForm::where('product_type', $productType)
                ->where('preferred_date', $formattedDate)
                ->count();

            // Create and save the waiting list entry
            $waitingListEntry = WitnessWaitingList::create([
                'username' => $request->username,
                'phone' => $request->phone,
                'email' => $request->email,
                'product_type' => $productType,
                'preferred_date' => $PreferredDate,
                'additional_notes' => $request->additional_notes,
            ]);

            // Prepare email data for admin notification
            $emailData = [
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'product_type' => $productType,
                'preferred_date' => $PreferredDate,
                'additional_notes' => $request->additional_notes,
                'current_registrations' => $currentCount . ' / ' . $capacity . ' (FULL)',
            ];

            // Log for debugging
            Log::info('Waiting List Entry Created:', [
                'email' => $request->email,
                'product_type' => $productType,
                'preferred_date' => $PreferredDate,
                'current_count' => $currentCount,
                'capacity' => $capacity
            ]);

            // Send email to admin recipients about waiting list entry
            $witnessEmails = Email::where('lable', 'witness_test')->value('value') ?? [];
            $recipients = is_array($witnessEmails) ? $witnessEmails : [];

            if (!empty($recipients)) {
                Mail::to($recipients)->send(new WitnessWaitingListMail($emailData));
                Log::info('Waiting list notification sent to admins');
            }

            return response()->json([
                'success' => true,
                'message' => 'You have been added to the waiting list. We will contact you soon.'
            ]);
        } catch (\Exception $e) {
            Log::error('Waiting List Error:', [$e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Could not add to waiting list. Please try again later.'
            ], 500);
        }
    }
}