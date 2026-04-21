<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting List Entry</title>
    <link href="{{ asset('css/email/witness_waiting_list.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="header">
            ⏳ Witness Waiting List Entry
        </div>
        <div class="content">
            <div class="notice">
                <p>
                    <strong>⚠️ Notice:</strong> A user attempted to register for a fully booked session and has been added to the waiting list.
                </p>
            </div>

            <div class="status-full">
                🚫 Registration slots are full for this date and product type
            </div>

            <h3>Waiting List Entry Details</h3>
            
            <div class="details-box">
                <p><span class="icon">👤</span><strong>Name:</strong> {{ $formData['username'] }}</p>
                <p><span class="icon">📧</span><strong>Email:</strong> {{ $formData['email'] }}</p>
                <p><span class="icon">📱</span><strong>Phone:</strong> {{ $formData['phone'] }}</p>
                <p><span class="icon">📦</span><strong>Product Type:</strong> {{ $formData['product_type'] }}</p>
                <p><span class="icon">📅</span><strong>Requested Date:</strong> {{
                    \Carbon\Carbon::parse($formData['preferred_date'])->format('d-M-Y') }}</p>
                <p><span class="icon">📝</span><strong>Additional Notes:</strong> {{ $formData['additional_notes'] ?? 'N/A' }}</p>
            </div>

            <div class="notice">
                <p>
                    <strong>📋 Action Required:</strong> This user is now on the waiting list. Please contact them if a slot becomes available or consider scheduling an additional session.
                </p>
            </div>
        </div>
        <div class="footer">
            © {{ date('Y') }} Dubai Production Tool. All rights reserved.
        </div>
    </div>
</body>

</html>