<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\RequestForm;
use App\Models\WitnessForm;
use App\Models\FeedbackForm;
use App\Models\PreferredDate;
use App\Models\Email;
use Illuminate\Http\Request;
use App\Models\ProductType;
use DateTime;

class AdminController extends Controller
{
    public function dashboard()
    {
        $page_title = "Dashboard";
        $sidebar_active = "dashboard";

        // Get the counts for the dashboard
        $totalRequestTraining = RequestForm::count(); // Count total training requests
        $totalWitnessTest = WitnessForm::count();     // Count total witness tests
        $totalFeedback = FeedbackForm::count();       // Count total feedbacks

        // Get month-wise count for Request Training
        $monthWiseRequestTraining = RequestForm::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('month')
            ->pluck('count', 'month')->toArray();

        // Get month-wise count for Witness Test
        $monthWiseWitnessTest = WitnessForm::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('month')
            ->pluck('count', 'month')->toArray();

        // Get month-wise count for Feedback
        $monthWiseFeedback = FeedbackForm::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('month')
            ->pluck('count', 'month')->toArray();

        // Prepare data for the charts
        $months = range(1, 12); // months 1 to 12
        $requestTrainingCounts = array_fill(0, 12, 0); // Initialize counts to 0
        $witnessTestCounts = array_fill(0, 12, 0); // Initialize counts to 0
        $feedbackCounts = array_fill(0, 12, 0); // Initialize counts to 0

        // Fill the counts for each month for Request Training
        foreach ($monthWiseRequestTraining as $month => $count) {
            $requestTrainingCounts[$month - 1] = $count;
        }

        // Fill the counts for each month for Witness Test
        foreach ($monthWiseWitnessTest as $month => $count) {
            $witnessTestCounts[$month - 1] = $count;
        }

        // Fill the counts for each month for Feedback
        foreach ($monthWiseFeedback as $month => $count) {
            $feedbackCounts[$month - 1] = $count;
        }

        $bread_crumbs = [
            ['title' => 'Dashboard', 'url' => 'admin/dashboard'],
        ];

        return view('Admin.dashboard', compact(
            'page_title',
            'sidebar_active',
            'bread_crumbs',
            'totalRequestTraining',
            'totalWitnessTest',
            'totalFeedback',
            'months',
            'requestTrainingCounts',
            'witnessTestCounts',
            'feedbackCounts'
        ));
    }

    public function request_training()
    {
        $page_title = "Request Training";
        $trainingRequests = RequestForm::orderBy('created_at', 'desc')->get(); // Sort by created_at in descending order
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Request Training', 'url' => 'admin/request_training'],
        ];

        return view('Admin.request_training', compact('page_title', 'sidebar_active', 'bread_crumbs', 'trainingRequests'));
    }
    public function witness_test()
    {
        $page_title = "Witness Test";
        $witnessTests = WitnessForm::orderBy('created_at', 'desc')->get();
        // Fetch waiting list data ordered by preferred_date
        $waitingList = \App\Models\WitnessWaitingList::orderBy('preferred_date', 'asc')->get();
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Witness Test', 'url' => 'admin/witness_test'],
        ];

        // NEW: Fetch product types for the dropdown
        $productTypes = ProductType::all(['id', 'product_type_name'])->toArray();

        // NEW: Fetch saved dates and convert to Y-m-d format for calendar
        $allPreferredDates = PreferredDate::all();
        $savedDates = [];
        foreach ($allPreferredDates as $record) {
            $dateString = $record->dates;
            // Convert d-m-Y to Y-m-d if needed
            if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $dateString)) {
                $dateParts = explode('-', $dateString);
                $convertedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0]; // Y-m-d
                $savedDates[] = $convertedDate;
            } else {
                $savedDates[] = $dateString;
            }
        }

        // NEW: Fetch scheduled meetings (future dates only, ordered by date)
        $scheduledMeetings = PreferredDate::where('dates', '>=', now()->format('d-m-Y'))
            ->orderBy('dates', 'asc') // Order by date ascending
            ->get()
            ->map(function ($meeting) {
                // Convert date to d-m-Y for display
                $dateParts = explode('-', $meeting->dates);
                $meeting->display_date = $dateParts[0] . '-' . $dateParts[1] . '-' . $dateParts[2]; // d-m-Y
                return $meeting;
            });
        // Fetch witness_test emails
        $witnessEmail = Email::where('lable', 'witness_test')->first();

        $witnessEmails = [
            'primary' => $witnessEmail->value[0] ?? '',
            'secondary' => $witnessEmail->value[1] ?? '',
        ];

        // Pass the new data to the view
        return view('Admin.witness_test', compact('page_title', 'sidebar_active', 'bread_crumbs', 'witnessTests', 'productTypes', 'savedDates', 'scheduledMeetings', 'witnessEmails', 'waitingList'));
    }
    public function saveWitnessTestEmails(Request $request)
    {
        $request->validate([
            'primary_email' => 'required|email',
            'secondary_email' => 'nullable|email',
        ]);

        $emails = [
            $request->primary_email,
            $request->secondary_email,
        ];

        Email::updateOrCreate(
            ['lable' => 'witness_test'],
            ['value' => $emails]
        );

        return redirect()->back()->with('success', 'Witness test emails updated successfully.');
    }
    public function feedback()
    {
        $page_title = "Feedback";
        $feedbacks = FeedbackForm::orderBy('created_at', 'desc')->get();
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Feedback', 'url' => 'admin/feedback'],
        ];
        return view('Admin.feedback', compact('page_title', 'sidebar_active', 'bread_crumbs', 'feedbacks'));
    }
    public function setting()
    {
        $page_title = "Settings";
        $sidebar_active = "dashboard";
        $bread_crumbs = [
            ['title' => 'Settings', 'url' => 'admin/setting'],
        ];

        // Email settings
        $emailGroups = ['witness_test', 'requesting_mail', 'feedback_form'];
        $emails = [];
        foreach ($emailGroups as $group) {
            $values = Email::where('lable', $group)->value('value') ?? [];
            $emails[$group] = [
                'primary' => $values[0] ?? '',
                'secondary' => $values[1] ?? '',
            ];
        }

        // Get ALL saved dates from database - convert to YYYY-MM-DD for calendar
        $allPreferredDates = PreferredDate::all();
        $savedDates = [];

        foreach ($allPreferredDates as $record) {
            // Convert d-m-Y back to Y-m-d for calendar display
            $dateString = $record->dates;

            // If format is d-m-Y, convert to Y-m-d
            if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $dateString)) {
                $dateParts = explode('-', $dateString);
                $convertedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0]; // Y-m-d
                $savedDates[] = $convertedDate;
            } else {
                // If already in Y-m-d format, use as is
                $savedDates[] = $dateString;
            }
        }

        // Get product types
        $productTypes = ProductType::all(['id', 'product_type_name'])->toArray();

        return view('Admin.setting', compact(
            'page_title',
            'sidebar_active',
            'bread_crumbs',
            'savedDates',
            'emailGroups',
            'emails',
            'productTypes'
        ));
    }

    public function saveEmails(Request $request)
    {
        $emails = $request->only([
            // 'witness_test_mail',
            // 'witness_test_mail_secondary',
            'requesting_mail',
            'requesting_mail_secondary',
            'feedback_form_mail',
            'feedback_form_mail_secondary',
        ]);

        $emailGroups = [
            // 'witness_test' => [$emails['witness_test_mail'], $emails['witness_test_mail_secondary']],
            'requesting_mail' => [$emails['requesting_mail'], $emails['requesting_mail_secondary']],
            'feedback_form' => [$emails['feedback_form_mail'], $emails['feedback_form_mail_secondary']],
        ];

        foreach ($emailGroups as $label => $values) {
            $existingEmail = Email::where('lable', $label)->first();

            if ($existingEmail) {
                // Update existing record
                $existingEmail->update([
                    'value' => $values,
                ]);
            } else {
                // Create a new record
                Email::create([
                    'lable' => $label,
                    'value' => $values,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Emails updated successfully.');
    }
    public function getPreferredDateDetails(Request $request)
    {
        try {
            $date = $request->input('date'); // Expected as Y-m-d from JS
            $productTypeId = $request->input('product_type_id'); // Add this for context

            if (!$date || !$productTypeId) {
                return response()->json(['success' => false, 'error' => 'Date and product type required.'], 400);
            }

            // Convert JS date (Y-m-d) to DB format (d-m-Y)
            $dateObj = \DateTime::createFromFormat('Y-m-d', $date);
            if (!$dateObj) {
                return response()->json(['success' => false, 'error' => 'Invalid date format.'], 400);
            }
            $dbDate = $dateObj->format('d-m-Y');

            // Get product type name
            $productTypeName = $this->getProductTypeName($productTypeId);
            if (!$productTypeName) {
                return response()->json(['success' => false, 'error' => 'Invalid product type.'], 400);
            }

            // Find record
            $record = PreferredDate::where('dates', $dbDate)
                ->where('product_type', $productTypeName)
                ->first();

            if (!$record) {
                return response()->json(['success' => false, 'error' => 'No record found.'], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'meeting_link' => $record->meeting_link,
                    'capacity' => $record->capacity,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getPreferredDateDetails: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Server error.'], 500);
        }
    }
    public function getDatesByProductType(Request $request)
    {
        try {
            $productTypeId = $request->input('product_type_id');
            if (!$productTypeId) {
                return response()->json(['success' => false, 'error' => 'Product type ID required.'], 400);
            }

            $selectedProductTypeName = $this->getProductTypeName($productTypeId);
            if (!$selectedProductTypeName) {
                return response()->json(['success' => false, 'error' => 'Invalid product type.'], 400);
            }

            // Get the saved date for the selected product type (only one, and only if future)
            $savedDate = PreferredDate::where('product_type', $selectedProductTypeName)
                ->where('dates', '>=', now()->format('d-m-Y')) // Only future dates
                ->value('dates');

            $savedDates = $savedDate ? [$this->convertDateToYmd($savedDate)] : [];

            return response()->json([
                'success' => true,
                'savedDates' => $savedDates, // Only one date for the selected type
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getDatesByProductType: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Server error.'], 500);
        }
    }

    private function convertDateToYmd($date)
    {
        if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $date)) {
            $parts = explode('-', $date);
            return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        }
        return $date;
    }

    public function SavePreferredDates(Request $request)
    {
        try {
            $datesJson = $request->input('dates');
            $productType = $request->input('product_type');
            $meetingLink = $request->input('meeting_link');
            $action = $request->input('action', 'save');

            // Decode dates
            $dates = json_decode($datesJson, true);
            if (!is_array($dates) || empty($dates)) {
                return response()->json(['success' => false, 'message' => 'Invalid date selected.'], 400);
            }

            // ============ DELETE ACTION ============
            if ($action === 'delete') {
                $request->validate(['product_type' => 'required|numeric']);
                $dateToDelete = $dates[0];
                $productTypeName = $this->getProductTypeName($productType);
                if (!$productTypeName) {
                    return response()->json(['success' => false, 'message' => 'Invalid product type.'], 400);
                }

                $dateObj = \DateTime::createFromFormat('Y-m-d', $dateToDelete);
                if (!$dateObj) {
                    return response()->json(['success' => false, 'message' => 'Invalid date format.'], 400);
                }
                $readableDateFormat = $dateObj->format('d-m-Y');

                $record = PreferredDate::where('dates', $readableDateFormat)
                    ->where('product_type', $productTypeName)
                    ->first();

                if ($record) {
                    $record->delete();
                    return response()->json(['success' => true, 'message' => 'Date deleted successfully.']);
                } else {
                    return response()->json(['success' => false, 'message' => 'No matching record found to delete.'], 404);
                }
            }

            // ============ SAVE ACTION ============
            $request->validate([
                'product_type' => 'required|numeric',
                'meeting_link' => 'required|url',
                'capacity' => 'required|numeric|min:1',
            ], [
                'meeting_link.url' => 'Please enter a valid meeting link URL (e.g., https://www.google.com)',
                'capacity.required' => 'Capacity is required.',
                'capacity.min' => 'Capacity must be at least 1.',
            ]);

            // Get product type name first
            $productTypeName = $this->getProductTypeName($productType);
            if (!$productTypeName) {
                return response()->json(['success' => false, 'message' => 'Invalid product type.'], 400);
            }

            // Get the first date from the array
            $dateToSave = $dates[0];
            $dateObj = \DateTime::createFromFormat('Y-m-d', $dateToSave);
            if (!$dateObj) {
                return response()->json(['success' => false, 'message' => 'Invalid date format.'], 400);
            }
            $readableDateFormat = $dateObj->format('d-m-Y');

            // NEW: Check if the product type already has a future date (one per type rule)
            $existingForType = PreferredDate::where('product_type', $productTypeName)
                ->where('dates', '>=', now()->format('d-m-Y'))
                ->where('dates', '!=', $readableDateFormat) // Allow updating the same date
                ->exists();

            if ($existingForType) {
                return response()->json(['success' => false, 'message' => 'This product type already has a future date. You can only have one date per product type.'], 400);
            }

            // No conflict check for other product types (allow same date for different types)

            $existingRecord = PreferredDate::where('dates', $readableDateFormat)
                ->where('product_type', $productTypeName)
                ->first();

            // Define $dataToSave with all fields including capacity
            $dataToSave = [
                'dates' => $readableDateFormat,
                'product_type' => $productTypeName,
                'meeting_link' => $meetingLink,
                'capacity' => $request->input('capacity'),
            ];

            if ($existingRecord) {
                $existingRecord->update($dataToSave);
                $message = 'Date updated successfully.';
            } else {
                PreferredDate::create($dataToSave);
                $message = 'Date saved successfully.';
            }

            return response()->json(['success' => true, 'message' => $message]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            $errorMessages = [];

            if (isset($errors['meeting_link'])) {
                $errorMessages[] = implode(', ', $errors['meeting_link']);
            }
            if (isset($errors['capacity'])) {
                $errorMessages[] = implode(', ', $errors['capacity']);
            }

            $message = !empty($errorMessages) ? 'Validation error: ' . implode(' ', $errorMessages) : 'Validation error: Invalid input.';

            return response()->json(['success' => false, 'message' => $message], 422);
        } catch (\Exception $e) {
            \Log::error('Error in SavePreferredDates: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.'], 500);
        }
    }
    private function getProductTypeName($productTypeId)
    {
        $productType = ProductType::find($productTypeId);
        return $productType ? $productType->product_type_name : $productTypeId;
    }
}
