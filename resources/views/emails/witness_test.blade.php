<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/email/witness_test1.css') }}" rel="stylesheet" />
    <title>Witness Form Submission</title>
</head>

<body>
    <div class="container">
        <div class="header">
            📄 Witness Form Submission
        </div>
        <div class="content">
            <h3>Submission Details</h3>
            <p><span class="icon">👤</span><strong>Name:</strong> {{ $formData['username'] }}</p>
            <p><span class="icon">📧</span><strong>Email:</strong> {{ $formData['email'] }}</p>
            <p><span class="icon">📱</span><strong>Phone:</strong> {{ $formData['phone'] }}</p>
            <p><span class="icon">📦</span><strong>Product Type:</strong> {{ $formData['product_type'] }}</p>
            <p><span class="icon">📅</span><strong>Preferred Date:</strong> {{
                \Carbon\Carbon::parse($formData['preferred_date'])->format('d-M-Y') }}</p>

            <!-- Meeting Link Section -->
            <p>
                <span class="icon">🔗</span><strong>Meeting Link:</strong>
                @if(!empty($formData['meeting_link']) && $formData['meeting_link'] !== 'Not provided')
                <br>
                <a href="{{ $formData['meeting_link'] }}" class="meeting-link" target="_blank">
                    Join Meeting
                </a>
                <br>
                <small style="color: #666;">{{ $formData['meeting_link'] }}</small>
                @else
                <span class="no-link">Not provided</span>
                @endif
            </p>

            <p><span class="icon">📝</span><strong>Additional Notes:</strong> {{ $formData['additional_notes'] ?? 'N/A'
                }}</p>
        </div>
        <div class="footer">
            © {{ date('Y') }} Dubai Production Tool. All rights reserved.
        </div>
    </div>
</body>

</html>