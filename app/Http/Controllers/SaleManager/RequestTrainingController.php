<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\RequestForm; // Ensure you import your model
use App\Mail\requesttrainingmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Email;

class RequestTrainingController extends Controller
{
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'training_type' => 'required|string',
            'description' => 'required|string|max:500',
        ]);

        // If validation fails, return JSON response with errors
        if ($validator->fails()) {
            Log::error('Validation Errors:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create a new RequestForm instance and save data to the database
        try {
            // Save the form data
            $requestForm = RequestForm::create([
                'username' => $request->username,
                'phone' => $request->phone, // Save to 'ph_number' column
                'email' => $request->email,
                'training_type' => $request->training_type,
                'description' => $request->description,
            ]);

            // Prepare the email data
            $emailData = [
                'name' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone, // You might want to adjust this
                'training_type' => $request->training_type, // You might want to adjust this
                'description' => $request->description, // You might want to adjust this
            ];

            // Fetch the 'value' field where 'lable' is 'witness_test'
            $Request_trainingEmails = Email::where('lable', 'requesting_mail')->value('value') ?? [];

            // Ensure the result is an array (it should be due to the casting)
            $recipients = is_array($Request_trainingEmails) ? $Request_trainingEmails : [];


            // Send email to both recipients
            Mail::to($recipients)->send(new RequestTrainingMail($emailData));

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
        if ($request->has('description')) {
            $rules['description'] = 'required|string|max:500';
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
