<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Email; // Ensure your Email model exists
use Illuminate\Support\Facades\Validator;
use App\Models\FeedbackForm; // Make sure to import your model
use App\Mail\FeedbackTestMail; // Import the new Mailable class
use Illuminate\Support\Facades\Mail;

class FeedbackFormController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Request Data:', $request->all());

        // Validation rules
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'suggestions' => 'required|string|max:500',
        ]);

        // If validation fails, return JSON response with errors
        if ($validator->fails()) {
            Log::error('Validation Errors:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create a new FeedbackForm instance and save data to the database
        try {
            $feedback = FeedbackForm::create([
                'username' => $request->username,
                'phone' => $request->phone,
                'email' => $request->email,
                'suggestions' => $request->suggestions,
            ]);
            Log::info('Form submitted successfully and data saved to the database');

            // Prepare email data
            $emailData = [
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'suggestions' => $request->suggestions,
            ];

            // Fetch the 'value' field where 'lable' is 'witness_test'
            $FeedbackEmails = Email::where('lable', 'feedback_form')->value('value') ?? [];

            // Ensure the result is an array (it should be due to the casting)
            $recipients = is_array($FeedbackEmails) ? $FeedbackEmails : [];


            // Send email to both recipients
            Mail::to($recipients)->send(new FeedbackTestMail($emailData));

            return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
        } catch (\Exception $e) {
            Log::error('Database Insertion Error:', [$e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Could not save data, please try again later.'], 500);
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
        if ($request->has('suggestions')) {
            $rules['suggestions'] = 'required|string|max:500';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json(['success' => true]);
    }
}
