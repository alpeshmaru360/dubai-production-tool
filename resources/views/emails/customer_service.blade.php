<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form Submission</title>
    <link rel="stylesheet" href="{{asset('css/email/customer_service.css')}}">
</head>
<body>
    <div class="container">
        <div class="header">
            💬 Contact Us Form Details
        </div>
        <div class="content">
            <h3>Submission Details</h3>
            <p><span class="icon">👤</span><strong>Name:</strong> {{ $formData['username'] }}</p>
            <p><span class="icon">📧</span><strong>Email:</strong> {{ $formData['email'] }}</p>
            <p><span class="icon">📱</span><strong>Phone:</strong> {{ $formData['phone'] }}</p>
            <p><span class="icon">💡</span><strong>Message:</strong> {{ $formData['message'] }}</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Dubai Production Tool. All rights reserved.
        </div>
    </div>
</body>
</html>
