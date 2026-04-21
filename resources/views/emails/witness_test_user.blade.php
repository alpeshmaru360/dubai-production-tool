<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witness Test Registration Confirmation</title>
    <link href="{{ asset('css/email/witness_test_user.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📄 Witness Registration Confirmed</h1>
        </div>
        
        <div class="content">
            <p class="greeting">Hello {{ $formData['username'] }},</p>
            
            <p class="intro-text">
                Thank you for registering for the Witness Test! Your submission has been received successfully. 
                Below are the details of your registration:
            </p>

            <div class="details-section">
                <h3>📋 Your Registration Details</h3>
                
                <div class="detail-item">
                    <span class="icon">👤</span>
                    <div>
                        <strong>Name:</strong><br>
                        {{ $formData['username'] }}
                    </div>
                </div>

                <div class="detail-item">
                    <span class="icon">📧</span>
                    <div>
                        <strong>Email:</strong><br>
                        {{ $formData['email'] }}
                    </div>
                </div>

                <div class="detail-item">
                    <span class="icon">📱</span>
                    <div>
                        <strong>Phone:</strong><br>
                        {{ $formData['phone'] }}
                    </div>
                </div>

                <div class="detail-item">
                    <span class="icon">📦</span>
                    <div>
                        <strong>Product Type:</strong><br>
                        {{ $formData['product_type'] }}
                    </div>
                </div>

                <div class="detail-item">
                    <span class="icon">📅</span>
                    <div>
                        <strong>Scheduled Date:</strong><br>
                        {{ \Carbon\Carbon::parse($formData['preferred_date'])->format('l, d F Y') }}
                    </div>
                </div>

                @if(!empty($formData['additional_notes']))
                <div class="divider"></div>
                <div class="detail-item">
                    <span class="icon">📝</span>
                    <div>
                        <strong>Your Notes:</strong><br>
                        {{ $formData['additional_notes'] }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Meeting Link Section -->
            @if(!empty($formData['meeting_link']) && $formData['meeting_link'] !== 'Not provided')
            <div class="meeting-section">
                <h3>🔗 Join Your Meeting</h3>
                <p style="margin: 10px 0; color: #555;">
                    Use the link below to join the witness test meeting on your scheduled date:
                </p>
                <a href="{{ $formData['meeting_link'] }}" class="meeting-link" target="_blank">
                    Join Meeting
                </a>
                <div class="meeting-url">
                    {{ $formData['meeting_link'] }}
                </div>
            </div>

            <div class="important-note">
                <p>
                    <strong>⚠️ Important:</strong> Please save this meeting link and join at your scheduled date. 
                </p>
            </div>
            @else
            <div class="important-note">
                <p>
                    <strong>ℹ️ Note:</strong> The meeting link is not yet available.
                </p>
            </div>
            @endif

        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Dubai Production Tool. All rights reserved.</p>
        </div>
    </div>
</body>

</html>