<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Form Submission</title>
    <link rel="stylesheet" href="{{asset('css/email/request_training.css')}}">
</head>
<body>
    <div class="container">
        <div class="header">
            📄 Request Training Form
        </div>
        <div class="content">
            <h1>Form Submission Details</h1>
            <ul>
                @foreach($formData as $key => $value)
                    <li>
                        <span class="icon">📝</span>
                        <strong>{{ ucfirst($key) }}:</strong> {{ $value }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>
