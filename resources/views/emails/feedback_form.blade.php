<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form Submission</title>
    <link rel="stylesheet" href="{{asset('css/email/feedback_form.css')}}">
</head>
<body>
    <div class="container">
        <div class="header">
            💬 Feedback Form Submission
        </div>
        <div class="content">
            <h3>Submission Details</h3>
            <p><span class="icon">👤</span><strong>Name:</strong> {{ $formData['username'] }}</p>
            <p><span class="icon">📧</span><strong>Email:</strong> {{ $formData['email'] }}</p>
            <p><span class="icon">📱</span><strong>Phone:</strong> {{ $formData['phone'] }}</p>
            <p><span class="icon">💡</span><strong>Suggestions:</strong> {{ $formData['suggestions'] }}</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>
